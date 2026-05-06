@extends('layouts.thank-you')

@section('title', 'تم التسجيل — مدرك 4')

@push('head')
<style>
    @keyframes thank-you-check-pop {
        0% {
            transform: scale(0.4);
            opacity: 0;
        }

        70% {
            transform: scale(1.08);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes thank-you-check-draw {
        from {
            stroke-dashoffset: 22;
        }

        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes thank-you-check-glow {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(24, 147, 153, 0.38);
        }

        50% {
            box-shadow: 0 0 0 10px rgba(24, 147, 153, 0);
        }
    }

    .thank-you-check-badge {
        animation: thank-you-check-pop 0.55s cubic-bezier(0.34, 1.56, 0.64, 1) forwards, thank-you-check-glow 2.2s ease-in-out infinite 0.65s;
    }

    .thank-you-check-path {
        stroke-dasharray: 22;
        stroke-dashoffset: 22;
        animation: thank-you-check-draw 0.45s ease-out 0.18s forwards;
    }

    .thank-you-ticket-edge {
        background: linear-gradient(90deg, #189399 0%, #1faeb6 52%, #126e74 100%);
    }

</style>
@endpush

@section('content')
@php
$eventVenueLine = 'مدارس قيم التعليمية';
$eventDate = '17 مايو';
$eventTime = '4 م - 10 م';
$eventDuration = 'يوم واحد';
$whatsappGroupUrl = config('services.whatsapp.group_invite_url');
@endphp

<div class="relative flex min-h-dvh flex-col items-center justify-center bg-[#e8f2f2] px-3 py-8 sm:px-5 sm:py-10 [font-family:inherit]">
    <article class="medrek-motion-card medrek-hover-lift relative w-full max-w-[22.5rem] overflow-hidden rounded-[1.35rem] bg-white shadow-[0_20px_50px_-12px_rgba(15,23,42,0.18)] sm:max-w-md sm:rounded-3xl">
        <div class="thank-you-ticket-edge h-1 w-full shrink-0"></div>

        <div class="px-4 pb-1 pt-4 sm:px-6 sm:pt-5">
            <div class="flex items-center justify-center gap-3 border-b border-slate-100 pb-3">
                <div class="flex items-center gap-1.5 text-[11px] font-semibold text-slate-600">
                    <x-medrek-icon name="bulb" class="h-4 w-4 text-[var(--gov-accent)]" />
                    <span>ملتقى مدرك 4</span>
                </div>
            </div>

            <div class="mx-auto mt-4 flex justify-center">
                <div class="thank-you-check-badge flex h-12 w-12 items-center justify-center rounded-full bg-[var(--gov-accent)] text-white shadow-md shadow-[rgba(24,147,153,0.28)] ring-4 ring-[rgba(24,147,153,0.18)]">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path class="thank-you-check-path" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M6.75 12.75 10.5 16.5l6.75-7.5" />
                    </svg>
                </div>
            </div>

            <h1 class="mt-3 text-center text-lg font-extrabold leading-snug text-[var(--gov-navy)] sm:text-xl">
                تم تأكيد تسجيلك ({{ $participant->full_name }})
            </h1>
            <p class="mx-auto mt-1.5 max-w-xs text-pretty text-center text-[12px] leading-relaxed text-slate-500 sm:text-[13px]">
                التقط الشاشة لإبرازها عند حضورك
            </p>
        </div>

        {{-- أسفل التذكرة: واتساب + QR (آخر جزء داخل البطاقة) --}}
        <div class="mt-1 rounded-b-[1.35rem] border-t border-slate-100 bg-gradient-to-br from-slate-50 via-slate-50 to-[#e5f5f6]/95 px-4 py-4 sm:rounded-b-3xl sm:px-6 sm:py-5">
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:items-stretch">
                <div class="flex shrink-0 flex-col items-center justify-center">
                    @if (! empty($qrImageSrc))
                    <div class="rounded-xl border border-white bg-white p-1.5 shadow-md ring-1 ring-slate-200/80">
                        <img src="{{ $qrImageSrc }}" alt="رمز التحقق من الحضور" class="h-[10rem] w-[10rem] object-contain sm:h-44 sm:w-44" width="176" height="176" loading="lazy" decoding="async">
                    </div>
                    @else
                    <div class="flex h-[10rem] w-[10rem] flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-white p-2 text-center shadow-sm sm:h-44 sm:w-44">
                        <x-medrek-icon name="shield" class="h-5 w-5 text-[var(--gov-accent)]" />
                        <p class="mt-1 text-[8px] text-slate-500">QR</p>
                        <p class="mt-1 line-clamp-4 w-full break-all text-[7px] font-mono leading-tight text-slate-400" dir="ltr">{{ $checkinToken ?? $participant->checkin_token }}</p>
                    </div>
                    @endif
                    <p class="mt-1.5 max-w-[10rem] text-center text-[9px] text-slate-400 sm:max-w-[11rem]">اعرض الرمز عند الدخول</p>
                </div>

                <div class="flex min-w-0 w-full flex-1 flex-col items-center justify-center gap-2 text-center">
                    <span class="inline-flex items-center rounded-full bg-[var(--gov-accent-soft)] px-2.5 py-0.5 text-[10px] font-bold text-[var(--gov-accent)] ring-1 ring-[rgba(24,147,153,0.22)]">تنويه</span>
                    <p class="text-[12px] font-semibold leading-snug text-[var(--gov-navy)] sm:text-sm">
                        انضم لمجموعة مدرك 4 للاطلاع على تفاصيل البرنامج
                    </p>
                    @if (filled($whatsappGroupUrl))
                        <a href="{{ $whatsappGroupUrl }}" target="_blank" rel="noopener noreferrer" class="mx-auto mt-2 inline-flex w-fit max-w-full shrink-0 items-center justify-center rounded-full bg-[#0f172a] px-6 py-2.5 text-xs font-bold text-white shadow-md transition hover:bg-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50 sm:px-7 sm:py-3 sm:text-sm">
                            انضم للمجموعة
                        </a>
                    @else
                        <button type="button" disabled class="mx-auto mt-2 inline-flex w-fit max-w-full shrink-0 items-center justify-center rounded-full bg-slate-400 px-6 py-2.5 text-xs font-bold text-white opacity-80 sm:px-7 sm:py-3 sm:text-sm">
                            رابط المجموعة غير متاح حالياً
                        </button>
                    @endif
                </div>
            </div>

            <div class="my-4 h-px w-full bg-slate-200/90" role="separator" aria-hidden="true"></div>

            <section aria-labelledby="event-summary-label" class="min-w-0">
                <h2 id="event-summary-label" class="sr-only">ملخص الفعالية</h2>
                <div class="grid grid-cols-4 gap-1.5 sm:gap-3">
                    <div class="flex flex-col items-center justify-center gap-1.5 px-0.5 py-1 text-center">
                        <span class="sr-only">الموعد</span>
                        <x-medrek-icon name="calendar" class="h-4 w-4 shrink-0 text-slate-500 sm:h-5 sm:w-5" />
                        <p class="break-words text-[11px] font-extrabold leading-tight text-[var(--gov-navy)] tabular-nums sm:text-xs">{{ $eventDate }}</p>
                    </div>
                    <div class="flex flex-col items-center justify-center gap-1.5 px-0.5 py-1 text-center">
                        <span class="sr-only">الوقت</span>
                        <x-medrek-icon name="clock" class="h-4 w-4 shrink-0 text-slate-500 sm:h-5 sm:w-5" />
                        <p class="break-words text-[10px] font-bold leading-tight text-[var(--gov-navy)] sm:text-[11px]">{{ $eventTime }}</p>
                    </div>
                    <div class="flex flex-col items-center justify-center gap-1.5 px-0.5 py-1 text-center">
                        <span class="sr-only">المكان</span>
                        <x-medrek-icon name="map-pin" class="h-4 w-4 shrink-0 text-slate-500 sm:h-5 sm:w-5" />
                        <p class="break-words text-[9px] font-bold leading-tight text-[var(--gov-navy)] sm:text-[10px]">{{ $eventVenueLine }}</p>
                    </div>
                    <div class="flex flex-col items-center justify-center gap-1.5 px-0.5 py-1 text-center">
                        <span class="sr-only">المدة</span>
                        <x-medrek-icon name="sun" class="h-4 w-4 shrink-0 text-slate-500 sm:h-5 sm:w-5" />
                        <p class="break-words text-[10px] font-bold leading-tight text-[var(--gov-navy)] sm:text-[11px]">{{ $eventDuration }}</p>
                    </div>
                </div>
            </section>
        </div>
    </article>

    {{-- خارج البطاقة: التواصل + العودة --}}
    <div class="mt-5 w-full max-w-[22.5rem] shrink-0 space-y-4 px-1 pb-4 text-center sm:max-w-md">
        <div>
            <p class="mb-2.5 text-[11px] font-bold text-slate-600 sm:text-xs">تابعنا على منصات التواصل</p>
            <div class="flex flex-wrap items-center justify-center gap-2">
                <a href="https://twitter.com/KafaatBYC" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-300/80 bg-white/90 text-slate-800 shadow-sm transition hover:border-[var(--gov-accent)] hover:text-[var(--gov-accent)]" aria-label="X">
                    <x-medrek-icon name="x" class="h-4 w-4" />
                </a>
                <a href="https://www.instagram.com/kafaatbyc?igsh=MXc4MzhiNTJ6M2FtMA==" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-300/80 bg-white/90 text-pink-600 shadow-sm transition hover:border-pink-300" aria-label="إنستغرام">
                    <x-medrek-icon name="camera" class="h-4 w-4" />
                </a>
                <a href="https://www.tiktok.com/@kafaatbyc?_t=ZS-8yURjlh4To8&amp;_r=1" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-300/80 bg-white/90 text-slate-900 shadow-sm transition hover:bg-white" aria-label="تيك توك">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
                    </svg>
                </a>
                <a href="https://youtube.com/@kafaatbyc?si=Vxhs5X3vQhSFVV01" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-300/80 bg-white/90 text-red-600 shadow-sm transition hover:border-red-200" aria-label="يوتيوب">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545S4.494 3.545 2.624 5.05A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                </a>
                <a href="https://kafaat.org.sa" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-300/80 bg-white/90 text-[var(--gov-accent)] shadow-sm transition hover:border-[var(--gov-accent)]" aria-label="الموقع">
                    <x-medrek-icon name="link" class="h-4 w-4" />
                </a>
            </div>
        </div>

        <p>
            <a href="{{ route('home') }}" class="text-xs font-semibold text-[var(--gov-accent)] underline-offset-2 hover:underline">العودة للرئيسية</a>
        </p>
    </div>
</div>
@endsection
