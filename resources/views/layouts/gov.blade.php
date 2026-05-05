<!DOCTYPE html>
<html class="scroll-smooth" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مدرك 4')</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        :root {
            --gov-navy: #0f172a;
            --gov-navy-light: #334155;
            --gov-bg: #eff8f8;
            --gov-bg-deep: #e4f2f3;
            --gov-surface: #ffffff;
            --gov-surface-muted: #f6fbfb;
            --gov-border: #dce8e9;
            --gov-muted: #64748b;
            --gov-accent: #189399;
            --gov-accent-hover: #147a80;
            --gov-accent-soft: #e5f5f6;
            --gov-accent-muted: #4d8288;
            --gov-gold: #7a918f;
            --gov-shadow: 0 1px 3px rgba(15, 23, 42, 0.05), 0 10px 32px rgba(24, 147, 153, 0.07);
        }
        html {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        body {
            line-height: 1.65;
            letter-spacing: 0;
            background: linear-gradient(180deg, var(--gov-bg) 0%, var(--gov-bg-deep) 45%, var(--gov-bg) 100%);
        }
        button,
        input,
        select,
        textarea,
        optgroup {
            font-family: inherit;
            line-height: inherit;
        }
        .app-header-glass {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gov-border);
        }
        .app-nav-link {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gov-navy-light);
            transition:
                background 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                color 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .app-nav-link:hover {
            background: var(--gov-accent-soft);
            color: var(--gov-navy);
        }
        .app-nav-link.is-active {
            background: var(--gov-accent-soft);
            color: var(--gov-accent);
        }
        [data-reveal] {
            opacity: 0;
            transform: translateY(14px);
            transition:
                opacity 0.55s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
        }
        [data-reveal].is-visible { opacity: 1; transform: translateY(0); }
        [data-reveal-bounce] {
            opacity: 0;
            transform: translateY(10px);
            transition:
                opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        [data-reveal-bounce].is-visible { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
            [data-reveal], [data-reveal-bounce] { opacity: 1; transform: none; transition: none; }
        }
    </style>
    @stack('head')
</head>
<body class="min-h-screen text-slate-800 antialiased">
    <header class="app-header-glass medrek-motion-header sticky top-0 z-50">
        <div class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-3 px-4 py-3 sm:px-6 md:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] md:gap-4 md:py-3.5">
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-2.5 text-[var(--gov-navy)] md:justify-start">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-white to-[var(--gov-accent-soft)] text-[var(--gov-accent)] shadow-sm ring-1 ring-[var(--gov-border)]">
                    <x-medrek-icon name="bulb" class="h-5 w-5" />
                </span>
                <span class="text-lg font-bold tracking-tight">مدرك <span class="font-extrabold text-[var(--gov-accent)]">4</span></span>
            </a>
            <nav class="flex flex-wrap items-center justify-center gap-1">
                <a href="{{ route('home') }}" class="app-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">الرئيسية</a>
                <a href="{{ route('registration') }}" class="app-nav-link {{ request()->routeIs('registration') ? 'is-active' : '' }}">التسجيل</a>
                @auth
                    <a href="{{ route('account.settings.edit') }}" class="app-nav-link {{ request()->routeIs('account.settings.*') ? 'is-active' : '' }}">الحساب</a>
                @endauth
            </nav>
            <div class="hidden items-center justify-end gap-2 md:flex">
                @guest
                    <span class="text-xs text-[var(--gov-muted)]">جمعية كفاءات لبناء قدرات الشباب</span>
                @endguest
                @auth
                    <a href="{{ route('account.settings.edit') }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-[var(--gov-border)] bg-white text-[var(--gov-navy)] shadow-sm transition hover:border-[var(--gov-accent)] hover:text-[var(--gov-accent)]" title="الإعدادات">
                        <x-medrek-icon name="cog" class="h-5 w-5" />
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="medrek-motion-page min-h-[calc(100vh-12rem)]">
        @yield('content')
    </main>

    <footer class="medrek-motion-footer mt-auto border-t border-[var(--gov-border)] bg-white/90 py-8 backdrop-blur-sm">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 text-center md:flex-row md:text-start">
            <p class="text-xs text-[var(--gov-muted)]">© {{ date('Y') }} جمعية كفاءات لبناء قدرات الشباب — ملتقى مدرك 4</p>
            <div class="flex flex-wrap items-center justify-center gap-4 text-xs font-normal text-[var(--gov-navy-light)]">
                <a href="{{ route('home') }}#about" class="transition hover:text-[var(--gov-accent)]">نبذة</a>
                <a
                    href="https://wa.me/966537527747"
                    class="transition hover:text-[var(--gov-accent)]"
                    target="_blank"
                    rel="noopener noreferrer"
                >تواصل</a>
                <a href="{{ route('registration') }}" class="transition hover:text-[var(--gov-accent)]">التسجيل</a>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.querySelectorAll('[data-reveal], [data-reveal-bounce]').forEach(function (el) { el.classList.add('is-visible'); });
                return;
            }
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (!e.isIntersecting) return;
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                });
            }, { rootMargin: '0px 0px -5% 0px', threshold: 0.06 });
            document.querySelectorAll('[data-reveal], [data-reveal-bounce]').forEach(function (el) { io.observe(el); });
        })();
    </script>
    @stack('scripts')
</body>
</html>
