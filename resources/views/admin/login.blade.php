<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Parlemen IKKB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0a1a4a 0%, #1a3a8f 50%, #2355c9 100%);
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
            top: -100px; right: -100px;
        }
        body::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
            bottom: -80px; left: -80px;
        }
        .login-box {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-logo .script {
            font-family: 'Dancing Script', cursive;
            color: rgba(255,255,255,0.85);
            font-size: 1.4rem;
        }
        .login-logo h1 {
            color: white;
            font-size: 1.6rem;
            font-weight: 900;
            letter-spacing: -0.02em;
        }
        .login-logo .badge {
            display: inline-block;
            background: rgba(212,168,67,0.2);
            border: 1px solid rgba(212,168,67,0.4);
            color: #f0c96a;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            padding: 0.2rem 0.8rem;
            border-radius: 100px;
            margin-top: 0.5rem;
        }
        .divider { width: 40px; height: 2px; background: rgba(255,255,255,0.2); margin: 1.5rem auto; }
        .form-group { margin-bottom: 1.2rem; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: rgba(255,255,255,0.7);
            margin-bottom: 0.5rem;
        }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
        }
        .form-group input {
            width: 100%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            color: white;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus { border-color: rgba(255,255,255,0.4); }
        .form-group input::placeholder { color: rgba(255,255,255,0.3); }
        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #2355c9, #4a7de8);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #1a3a8f, #2355c9);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .alert-error {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-size: 0.83rem;
            margin-bottom: 1rem;
        }
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .back-link a {
            color: rgba(255,255,255,0.5);
            font-size: 0.82rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link a:hover { color: rgba(255,255,255,0.8); }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <div class="script">Parlemen</div>
        <h1>IKKB</h1>
        <div class="badge"><i class="fas fa-shield-halved"></i> ADMIN PANEL</div>
    </div>
    <div class="divider"></div>

    @if($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="admin@parlemen.id" value="{{ old('email') }}" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-wrap">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
        </div>
        <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard
        </button>
    </form>

    <div class="back-link">
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
    </div>
</div>
</body>
</html>
