<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commission extends Model
{
    protected $fillable = ['name', 'description', 'sort_order'];

    public function members(): HasMany
    {
        return $this->hasMany(OrganizationMember::class)->orderBy('sort_order');
    }
}
