<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>تحضير المشاركين — مسح QR</title>
    <style>
        :root {
            --scan-brand: #193399;
            --scan-brand-hover: #152a7a;
            --scan-brand-soft: rgba(25, 51, 153, 0.35);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="min-h-full bg-zinc-950 text-zinc-100 antialiased">
    <div
        id="attendance-scan-app"
        class="flex min-h-dvh flex-col"
        data-check-url="{{ route('admin.attendance-scan.check') }}"
        data-csrf="{{ csrf_token() }}"
    >
        <header class="shrink-0 border-b border-white/10 bg-gradient-to-l from-zinc-900 via-zinc-900 to-[#121c3d]/90 px-4 py-4 backdrop-blur-md sm:px-6">
            <div class="mx-auto flex max-w-3xl flex-col gap-1">
                <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                    تحضير المشاركين
                </h1>
                <p class="text-base text-zinc-400 sm:text-lg">
                    امسح رمز QR الخاص بالمشارك لتسجيل حضوره فورًا
                </p>
            </div>
        </header>

        <main class="mx-auto flex w-full max-w-3xl flex-1 flex-col gap-6 px-4 py-6 sm:px-6">
            <div
                class="flex min-h-[min(52vh,420px)] w-full flex-col overflow-hidden rounded-2xl border border-white/10 bg-black/40 shadow-xl ring-1 ring-white/5"
            >
                <div
                    data-reader
                    class="relative z-10 min-h-[min(48vh,380px)] w-full flex-1 bg-black/50"
                ></div>
            </div>
            <p class="-mt-2 text-center text-sm text-zinc-500">
                تظهر معاينة الكاميرا داخل الإطار أعلاه بعد فتح الكاميرا.
            </p>

            <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <button
                    type="button"
                    data-action="start"
                    class="inline-flex min-h-14 min-w-[48px] flex-1 items-center justify-center rounded-xl bg-[var(--scan-brand)] px-6 text-base font-bold text-white shadow-lg shadow-[var(--scan-brand-soft)] transition hover:bg-[var(--scan-brand-hover)] disabled:cursor-not-allowed disabled:opacity-45 sm:flex-none"
                >
                    فتح الكاميرا ومسح QR
                </button>
                <button
                    type="button"
                    data-action="stop"
                    class="inline-flex min-h-14 items-center justify-center rounded-xl border border-white/15 bg-white/5 px-6 text-base font-semibold text-white transition hover:bg-white/10 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    إيقاف الكاميرا
                </button>
                <button
                    type="button"
                    data-action="reset"
                    class="inline-flex min-h-14 items-center justify-center rounded-xl border border-white/15 bg-white/5 px-6 text-base font-semibold text-white transition hover:bg-white/10 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    مسح مشارك آخر
                </button>
            </div>

            <p class="text-center text-sm text-zinc-500">
                في حال لم تعمل الكاميرا، يمكنك إدخال الرمز يدويًا.
            </p>

            <div class="rounded-2xl border border-white/10 bg-zinc-900/60 p-4 sm:p-5">
                <label for="manual-token" class="mb-2 block text-sm font-medium text-zinc-300">إدخال يدوي</label>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <input
                        id="manual-token"
                        type="text"
                        dir="ltr"
                        autocomplete="off"
                        data-manual-input
                        placeholder="أدخل رمز QR يدويًا"
                        class="min-h-12 w-full flex-1 rounded-xl border border-white/10 bg-black/30 px-4 py-3 text-base text-white placeholder:text-zinc-600 outline-none transition focus:border-[var(--scan-brand-soft)] focus:ring-2 focus:ring-[var(--scan-brand-soft)]"
                    />
                    <button
                        type="button"
                        data-action="manual-check"
                        class="inline-flex min-h-12 shrink-0 items-center justify-center rounded-xl bg-[var(--scan-brand)] px-8 text-base font-bold text-white shadow-md shadow-[var(--scan-brand-soft)] transition hover:bg-[var(--scan-brand-hover)] disabled:cursor-not-allowed disabled:opacity-45"
                    >
                        تحضير
                    </button>
                </div>
            </div>

            <div
                data-result-card
                class="hidden rounded-2xl border px-4 py-5 sm:px-6"
                role="status"
                aria-live="polite"
            >
                <p data-result-title class="text-lg font-bold text-white"></p>
                <p data-result-body class="mt-1 text-sm text-zinc-400"></p>
                <div data-result-participant class="hidden"></div>
            </div>
        </main>

        <footer class="mt-auto shrink-0 border-t border-white/10 py-4 text-center text-xs text-zinc-600">
            <a href="{{ url('/admin') }}" class="text-[#8fa3e6] underline-offset-2 hover:text-white hover:underline">العودة إلى لوحة الإدارة</a>
        </footer>
    </div>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script src="{{ asset('js/admin/attendance-scan.js') }}" defer></script>
</body>
</html>
