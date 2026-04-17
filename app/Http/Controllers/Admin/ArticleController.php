<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $berita = Article::where('category', 'berita')->orderBy('sort_order')->get();
        $acara  = Article::where('category', 'acara')->orderBy('sort_order')->get();
        $angket = Article::where('category', 'angket')->orderBy('sort_order')->get();
        return view('admin.articles.index', compact('berita', 'acara', 'angket'));
    }

    public function create()
    {
        return view('admin.articles.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'image'      => 'nullable|image|max:5120',
            'link'       => 'nullable|url|max:500',
            'category'   => 'required|in:berita,angket,acara',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'content', 'link', 'category', 'sort_order']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'image'      => 'nullable|image|max:5120',
            'link'       => 'nullable|url|max:500',
            'category'   => 'required|in:berita,angket,acara',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'content', 'link', 'category', 'sort_order']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($article->image && \Storage::disk('public')->exists($article->image)) {
                \Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->image && \Storage::disk('public')->exists($article->image)) {
            \Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }
}
