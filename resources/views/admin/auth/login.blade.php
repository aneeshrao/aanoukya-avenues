<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login | Aanoukya Avenues</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="mesh-backdrop flex min-h-screen items-center justify-center px-5">
        <div class="panel w-full max-w-md p-8">
            <p class="font-serif text-3xl text-[var(--color-ink-soft)]">Admin Sign In</p>
            <p class="mt-2 text-sm">Use your admin credentials to manage content.</p>

            @if($errors->any())
                <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="mt-6 grid gap-4">
                @csrf
                <div>
                    <label for="email" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
                </div>

                <div>
                    <label for="password" class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-500">Password</label>
                    <input id="password" name="password" type="password" required class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-[var(--color-accent)] focus:outline-none">
                </div>

                <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
                    Remember me
                </label>

                <button type="submit" class="btn-primary">Sign in</button>
            </form>
        </div>
    </body>
</html>
