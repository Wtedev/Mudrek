<!DOCTYPE html>
<html class="scroll-smooth" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مدرك 4')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            background: linear-gradient(180deg, #14979f 0%, #0f8e96 100%);
            color: #ffffff;
            border-bottom-left-radius: 1.75rem;
            border-bottom-right-radius: 1.75rem;
            box-shadow: 0 8px 24px -14px rgba(15, 23, 42, 0.35);
        }

        /* مقاسات الهيدر: شعار أكبر مع حدّ نسبي (svh) لتفادي القص على الشاشات القصيرة جداً */
        .app-header-inner {
            box-sizing: border-box;
            margin-inline: auto;
            max-width: 72rem;
            padding-inline: clamp(1rem, 4vw, 1.5rem);
            padding-block: clamp(0.85rem, 2.2svh, 1.65rem);
        }

        @media (min-width: 640px) {
            .app-header-inner {
                padding-inline: 1.5rem;
                padding-block: clamp(1rem, 2.5svh, 1.95rem);
            }
        }

        @media (min-width: 768px) {
            .app-header-inner {
                padding-block: clamp(1.15rem, 2.8svh, 2.2rem);
            }
        }

        .app-header-logo {
            display: block;
            margin-inline: auto;
            width: auto;
            height: clamp(3.25rem, 13svh, 4.75rem);
            max-height: min(4.75rem, 34svh);
            max-width: min(17rem, 92vw);
            object-fit: contain;
            object-position: center;
        }

        @media (min-width: 640px) {
            .app-header-logo {
                height: clamp(3.85rem, 12svh, 5.5rem);
                max-height: min(5.5rem, 30svh);
                max-width: min(18.5rem, 88vw);
            }
        }

        @media (min-width: 768px) {
            .app-header-logo {
                height: clamp(4.35rem, 11svh, 6rem);
                max-height: min(6rem, 26svh);
                max-width: min(19.5rem, 78vw);
            }
        }

        @media (min-width: 1024px) {
            .app-header-logo {
                height: clamp(4.75rem, 10svh, 6.75rem);
                max-height: min(6.75rem, 24svh);
                max-width: min(21rem, 54vw);
            }
        }
        .app-nav-link {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.88);
            transition:
                background 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                color 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .app-nav-link:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
        }
        .app-nav-link.is-active {
            background: rgba(255, 255, 255, 0.24);
            color: #ffffff;
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
<body class="flex min-h-dvh flex-col text-slate-800 antialiased">
    <header class="app-header-glass medrek-motion-header sticky top-0 z-50">
        <div class="app-header-inner">
            <a href="{{ route('home') }}" class="flex items-center justify-center outline-offset-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white/90" aria-label="ملتقى مدرك 4 — الصفحة الرئيسية">
                <img src="{{ asset('images/assests/assests-02.webp') }}" alt="شعار ملتقى مدرك" width="400" height="400" fetchpriority="high" decoding="async" class="app-header-logo" />
            </a>
        </div>
    </header>

    @php
        $organizerSliderLogos = [];
        $organizerDir = public_path('images/Organizers');
        if (is_dir($organizerDir)) {
            $organizerAllowedExt = ['png', 'jpg', 'jpeg', 'webp', 'gif'];
            foreach (scandir($organizerDir) as $organizerFile) {
                if ($organizerFile === '.' || $organizerFile === '..') {
                    continue;
                }
                $organizerExt = strtolower((string) pathinfo($organizerFile, PATHINFO_EXTENSION));
                if (! in_array($organizerExt, $organizerAllowedExt, true)) {
                    continue;
                }
                $organizerSliderLogos[] = [
                    'file' => $organizerFile,
                    'alt' => 'شعار جهة منظمة',
                ];
            }
            usort($organizerSliderLogos, fn (array $a, array $b): int => strcmp($a['file'], $b['file']));
        }
    @endphp
    @if ($organizerSliderLogos !== [])
    <section class="medrek-organizers-ticker border-b border-[var(--gov-border)]/70 bg-white/80 py-1 shadow-[0_1px_0_rgba(255,255,255,0.65)_inset] backdrop-blur-md sm:py-1.5" aria-label="الجهات المنظمة والداعمة">
        <div class="medrek-organizers-ticker__inner mx-auto max-w-6xl px-2 sm:px-4">
            {{-- dir=ltr: نفس منطق شريط الشركاء لتمرير متسق --}}
            <div class="medrek-partners-viewport relative mx-auto overflow-hidden py-1" role="region" aria-label="شعارات الجهات المنظمة — تمرير تلقائي" dir="ltr">
                <div class="medrek-partners-track medrek-partners-track--paused">
                    @foreach ([0, 1, 2] as $organizerLoopPart)
                    <div class="medrek-partners-set" @if ($organizerLoopPart > 0) aria-hidden="true" @endif>
                        @foreach ($organizerSliderLogos as $organizerSliderLogo)
                        <div class="medrek-partner-slot shrink-0">
                            <img src="{{ asset('images/Organizers/'.rawurlencode($organizerSliderLogo['file'])) }}" alt="{{ $organizerSliderLogo['alt'] }}" width="200" height="64" loading="lazy" decoding="async" draggable="false" class="medrek-partner-img" />
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <main class="medrek-motion-page w-full min-w-0">
        @yield('content')
    </main>

    <footer class="medrek-motion-footer mt-auto border-t border-[var(--gov-border)] bg-white/90 py-8 backdrop-blur-sm">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 text-center md:flex-row md:text-start">
            <p class="text-xs text-[var(--gov-muted)]">© {{ date('Y') }} جمعية كفاءات الأهلية لبناء قدرات الشباب — ملتقى مدرك 4</p>
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
