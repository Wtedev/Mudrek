@extends('layouts.gov')

@section('title', 'الرئيسية — مدرك 4')

@push('head')
<style>
    .home-landing .medrek-hero-stage {
        position: relative;
        min-height: auto;
        top: 0;
    }

    .home-landing .medrek-card-layer {
        margin-top: -0.9rem;
    }

    @media (min-width: 768px) {
        .home-landing .medrek-card-layer {
            margin-top: -1.15rem;
        }
    }

</style>
@endpush

@section('content')
<div class="home-landing medrek-premium-shell">
    <section id="about" class="medrek-hero-stage instant-above-fold px-0 py-0">
        <div class="mx-auto w-full max-w-6xl overflow-hidden rounded-b-[2.5rem] bg-[#eef4f6]">
            <div class="px-5 pb-7 pt-6 text-center sm:px-8 sm:pt-7">
                <p class="mx-auto mb-3 max-w-xl text-sm font-light leading-relaxed text-[var(--gov-muted)]/85 sm:text-base">
                    جمعية كفاءات الأهلية<br>لبناء قدرات الشباب
                </p>
                <p class="mx-auto mt-4 max-w-xl px-2 text-base font-semibold leading-relaxed text-[var(--gov-accent)] sm:mt-5 sm:px-4 sm:text-lg">
                    نرافقك من المرحلة الثانوية لاكتشاف التخصصات، وفهم الحياة الجامعية، وبناء مسارك الأكاديمي بإرشاد نخبة من الأكاديميين.
                </p>
                <p class="mt-4">
                    <span class="inline-flex items-center rounded-full bg-[var(--gov-accent-soft)] px-3 py-1 text-xs font-extrabold text-[var(--gov-accent)] ring-1 ring-[var(--gov-accent)]/20 sm:text-sm">
                        خطوة بخطوة نحو مستقبلك
                    </span>
                </p>

                <div class="hero-image-wrap relative mx-auto -mb-6 mt-5 w-full max-w-[22rem] sm:max-w-[24rem]">
                    <img
                        src="{{ asset('images/assests/hero-md.webp') }}"
                        srcset="{{ asset('images/assests/hero-sm.webp') }} 697w, {{ asset('images/assests/hero-md.webp') }} 1257w, {{ asset('images/assests/hero-main.webp') }} 1950w"
                        sizes="(max-width: 639px) 22rem, (max-width: 1023px) 24rem, 24rem"
                        alt="صورة طالب"
                        width="1950"
                        height="1597"
                        fetchpriority="high"
                        loading="eager"
                        decoding="async"
                        onload="this.classList.add('is-loaded'); this.closest('.hero-image-wrap')?.classList.add('is-loaded');"
                        class="hero-image mx-auto h-auto w-full object-contain"
                    >
                    <a href="{{ route('registration') }}" class="absolute bottom-8 left-1/2 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-[var(--gov-accent)] px-10 py-2.5 text-lg font-extrabold text-white shadow-[0_12px_30px_-12px_rgba(24,147,153,0.55)] transition hover:bg-[var(--gov-accent-hover)]">
                        سجل الآن
                    </a>
                </div>
            </div>

            <div class="h-1 bg-transparent"></div>
        </div>
    </section>

    <div class="medrek-card-layer px-3 pb-10 sm:px-5 md:px-8 md:pb-14">
        <div class="medrek-main-card mx-auto max-w-[min(94vw,82rem)] overflow-hidden rounded-[2rem] border border-[var(--gov-border)]/80 bg-[var(--gov-surface)]/96 shadow-[0_24px_70px_-24px_rgba(15,23,42,0.28)] backdrop-blur-sm sm:rounded-[2.25rem] md:rounded-[2.75rem]">
            <section id="event-details" class="event-details scroll-mt-24 bg-transparent py-8 md:py-10" aria-labelledby="details-heading">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 [font-family:inherit]">
                    <h2 id="details-heading" class="text-center text-base text-[var(--gov-navy)] md:text-lg" data-reveal>تفاصيل الملتقى</h2>
                    <div class="mt-5 grid grid-cols-4 gap-x-2 gap-y-6 sm:mt-6 sm:gap-x-3 sm:gap-y-0 md:gap-x-5 lg:gap-x-6" data-reveal>
                        @foreach ([
                        ['label' => 'المكان', 'value' => 'القصيم، بريدة', 'value_secondary' => 'مدارس قيم التعليمية', 'icon' => 'map-pin', 'title' => null],
                        ['label' => 'المدة', 'value' => 'يوم واحد', 'value_secondary' => null, 'icon' => 'clock', 'title' => null],
                        ['label' => 'التاريخ', 'value' => '17 مايو', 'value_secondary' => null, 'icon' => 'calendar', 'title' => null],
                        ['label' => 'الوقت', 'value' => '4 م - 9 م', 'value_secondary' => null, 'icon' => 'sun', 'title' => 'من 4 مساء إلى 9 مساء'],
                        ] as $card)
                        <div @if (! empty($card['title'])) title="{{ $card['title'] }}" @endif class="flex min-h-0 w-full min-w-0 flex-col items-center gap-2.5 text-center sm:gap-3">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-[var(--gov-accent-soft)] text-[var(--gov-accent)] sm:h-12 sm:w-12">
                                <x-medrek-icon :name="$card['icon']" class="h-4 w-4 sm:h-[1.125rem] sm:w-[1.125rem]" />
                            </span>
                            <p class="flex w-full min-w-0 max-w-full flex-col items-center gap-0.5 text-center sm:gap-1">
                                <span class="sr-only">
                                    {{ $card['label'] }}:
                                    {{ $card['value'] }}@if (! empty($card['value_secondary'])). {{ $card['value_secondary'] }}@endif
                                </span>
                                @if (! empty($card['value_secondary']))
                                <span aria-hidden="true" class="block w-full min-w-0 whitespace-nowrap text-[10px] font-normal leading-tight text-[var(--gov-navy)] sm:text-[11px] sm:leading-tight md:text-sm">{{ $card['value'] }}</span>
                                <span aria-hidden="true" class="block max-w-full text-pretty text-[9px] font-light leading-snug text-[var(--gov-accent-muted)]/80 sm:text-[10px] md:text-[11px]">{{ $card['value_secondary'] }}</span>
                                @else
                                <span aria-hidden="true" class="block w-full max-w-full text-pretty text-[11px] font-normal leading-snug text-[var(--gov-navy)] sm:text-sm sm:leading-snug md:text-[0.9375rem]">{{ $card['value'] }}</span>
                                @endif
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="border-y border-[var(--gov-border)]/70 bg-transparent py-9 md:py-11 [font-family:inherit]" aria-labelledby="features-heading">
                <div class="mx-auto max-w-5xl px-4 sm:px-6">
                    <div class="text-center" data-reveal>
                        <p class="text-[10px] font-semibold text-[var(--gov-muted)] sm:text-[11px]">تجربة الملتقى</p>
                        <h2 id="features-heading" class="mt-1 text-base font-bold text-[var(--gov-navy)] md:text-lg">ماذا ينتظرك في مدرك</h2>
                    </div>
                    @php
                    $programItems = [
                    ['title' => 'برامج تدريبية', 'icon' => 'film'],
                    ['title' => 'ورش عمل', 'icon' => 'briefcase'],
                    ['title' => 'جلسات حوارية', 'icon' => 'chat'],
                    ['title' => 'استشارات أكاديمية', 'icon' => 'book'],
                    ['title' => 'فهم التخصصات', 'icon' => 'magnify'],
                    ['title' => 'الاستعداد للحياة الجامعية', 'icon' => 'academic'],
                    ['title' => 'لقاءات توجيهية', 'icon' => 'target'],
                    ];
                    $firstRow = array_slice($programItems, 0, 4);
                    $secondRow = array_slice($programItems, 4);
                    @endphp
                    <div class="mx-auto mt-4 max-w-4xl space-y-2" role="list" data-reveal>
                        <div class="flex flex-nowrap items-center justify-center gap-1.5 px-4 sm:px-6">
                            @foreach ($firstRow as $item)
                            <a href="#event-details" class="group inline-flex h-[2.05rem] w-fit shrink-0 items-center justify-center gap-1 rounded-md border border-slate-200/80 bg-white px-1.5 py-0.5 text-center shadow-[0_1px_2px_rgba(15,23,42,0.04)] transition-[border-color,box-shadow,background-color] duration-200 hover:border-[var(--gov-accent)]/30 hover:bg-[var(--gov-accent-soft)]/40 hover:shadow-[0_2px_8px_rgba(24,147,153,0.08)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)]/30 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--gov-surface-muted)]" role="listitem">
                                <span class="grid h-5 w-5 shrink-0 place-items-center overflow-hidden rounded-md bg-[var(--gov-accent-soft)]/50 text-[var(--gov-accent)] ring-1 ring-[var(--gov-accent)]/10 transition-[opacity,background-color] group-hover:bg-[var(--gov-accent-soft)] group-hover:opacity-100">
                                    <x-medrek-icon :name="$item['icon']" class="h-[0.72rem] w-[0.72rem]" />
                                </span>
                                <span class="whitespace-nowrap text-center text-[8px] font-semibold leading-snug text-[var(--gov-navy)] sm:text-[9px]">{{ $item['title'] }}</span>
                            </a>
                            @endforeach
                        </div>

                        <div class="flex flex-nowrap items-center justify-center gap-1.5 px-4 sm:px-6">
                            @foreach ($secondRow as $item)
                            <a href="#event-details" class="group inline-flex h-[2.05rem] w-fit shrink-0 items-center justify-center gap-1 rounded-md border border-slate-200/80 bg-white px-1.5 py-0.5 text-center shadow-[0_1px_2px_rgba(15,23,42,0.04)] transition-[border-color,box-shadow,background-color] duration-200 hover:border-[var(--gov-accent)]/30 hover:bg-[var(--gov-accent-soft)]/40 hover:shadow-[0_2px_8px_rgba(24,147,153,0.08)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)]/30 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--gov-surface-muted)]" role="listitem">
                                <span class="grid h-5 w-5 shrink-0 place-items-center overflow-hidden rounded-md bg-[var(--gov-accent-soft)]/50 text-[var(--gov-accent)] ring-1 ring-[var(--gov-accent)]/10 transition-[opacity,background-color] group-hover:bg-[var(--gov-accent-soft)] group-hover:opacity-100">
                                    <x-medrek-icon :name="$item['icon']" class="h-[0.72rem] w-[0.72rem]" />
                                </span>
                                <span class="whitespace-nowrap text-center text-[8px] font-semibold leading-snug text-[var(--gov-navy)] sm:text-[9px]">{{ $item['title'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <section class="border-y border-[var(--gov-border)]/70 bg-transparent py-10 md:py-14" aria-labelledby="topics-heading">
                <div class="mx-auto max-w-4xl px-4 sm:px-6">
                    <div class="text-center" data-reveal>
                        <p class="text-xs font-semibold text-[var(--gov-muted)] sm:text-sm">البرنامج التفصيلي</p>
                        <h2 id="topics-heading" class="mt-2 text-2xl font-bold text-[var(--gov-navy)] md:text-3xl">الأنشطة الرئيسية للملتقى</h2>
                        <p class="mx-auto mt-2 max-w-2xl text-sm leading-relaxed text-[var(--gov-muted)]">برنامج متكامل يجمع بين الفقرات التفاعلية والجلسات المتخصصة لإثراء تجربتك خلال الملتقى.</p>
                    </div>

                    <div class="mt-7 space-y-3 [font-family:inherit]" data-reveal>
                        @php
                        $activities = [
                        ['type' => 'featured', 'title' => 'قياس الميول التخصصية', 'subtitle' => 'فقرة رئيسية'],
                        ['type' => 'axis', 'axis' => 1, 'title' => 'طريق التغيير وصناعة الأولويات', 'presenter' => 'م. عبدالسلام الصغير'],
                        ['type' => 'axis', 'axis' => 2, 'title' => 'كيفية اختيار التخصص الجامعي', 'presenter' => 'أ. فارس الحميد'],
                        ['type' => 'axis', 'axis' => 3, 'title' => 'الحياة الجامعية', 'presenter' => 'د. ياسر البطي'],
                        ['type' => 'axis', 'axis' => 4, 'title' => 'تحديات السنة الجامعية الأولى', 'presenter' => 'د. عبدالله الضحيان'],
                        ['type' => 'axis', 'axis' => 5, 'title' => 'مسارات مهنية', 'presenter' => 'أ. محمد اليحيى'],
                        ['type' => 'axis', 'axis' => 6, 'title' => 'الأنظمة والقوانين الجامعية', 'presenter' => 'د. عادل السعوي'],
                        ['type' => 'axis', 'axis' => 7, 'title' => 'مسارات مختلفة', 'presenter' => null],
                        ['type' => 'featured', 'title' => 'معرض الاستشارات الأكاديمية', 'subtitle' => 'فقرة رئيسية'],
                        ];
                        @endphp

                        @foreach ($activities as $activity)
                        <article class="group rounded-xl border transition-all duration-200 {{ $activity['type'] === 'featured' ? 'border-[var(--gov-accent)]/30 bg-gradient-to-r from-[var(--gov-accent-soft)]/70 via-[var(--gov-accent-soft)]/35 to-white shadow-[0_6px_24px_-18px_rgba(24,147,153,0.55)]' : 'border-slate-200/80 bg-white shadow-[0_2px_10px_-8px_rgba(15,23,42,0.20)] hover:border-[var(--gov-accent)]/25 hover:shadow-[0_8px_22px_-14px_rgba(24,147,153,0.32)]' }}">
                            <div class="flex items-center gap-3 p-3 sm:gap-4 sm:p-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg {{ $activity['type'] === 'featured' ? 'bg-[var(--gov-accent)] text-white' : 'bg-[var(--gov-accent-soft)] text-[var(--gov-accent)]' }}">
                                    @if ($activity['type'] === 'featured')
                                    <x-medrek-icon name="sparkles" class="h-5 w-5" />
                                    @else
                                    <span class="text-sm font-extrabold">{{ $activity['axis'] }}</span>
                                    @endif
                                </span>

                                <div class="min-w-0 flex-1">
                                    @if ($activity['type'] === 'featured')
                                    <span class="inline-flex rounded-full bg-white/85 px-2 py-0.5 text-[10px] font-bold text-[var(--gov-accent)] ring-1 ring-[var(--gov-accent)]/20 sm:text-[11px]">{{ $activity['subtitle'] }}</span>
                                    @else
                                    <span class="block text-[11px] font-semibold text-[var(--gov-muted)]">محور {{ $activity['axis'] }}</span>
                                    @endif
                                    <h3 class="mt-0.5 text-sm font-semibold leading-snug text-[var(--gov-navy)] sm:text-[0.95rem]">{{ $activity['title'] }}</h3>
                                    @if ($activity['type'] === 'axis' && ! empty($activity['presenter']))
                                    <p class="mt-1 text-xs font-medium text-[var(--gov-accent-muted)] sm:text-[13px]">{{ $activity['presenter'] }}</p>
                                    @endif
                                </div>

                                @if ($activity['type'] === 'featured')
                                <span class="hidden text-[var(--gov-accent)] sm:inline-flex">
                                    <x-medrek-icon name="star" class="h-5 w-5" />
                                </span>
                                @endif
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="program-perks" class="scroll-mt-24 border-y border-[var(--gov-border)]/70 bg-transparent py-10 md:py-12 [font-family:inherit]" aria-labelledby="perks-heading">
                <div class="mx-auto max-w-3xl px-4 sm:px-6">
                    <div class="text-center" data-reveal>
                        <p class="text-xs font-semibold text-[var(--gov-muted)] sm:text-sm">إضافات تثري تجربتك</p>
                        <h2 id="perks-heading" class="mt-1 text-xl font-bold text-[var(--gov-navy)] md:text-2xl">مميزات الملتقى</h2>
                    </div>
                    <div class="mx-auto mt-6" data-reveal>
                        <div class="flex flex-col gap-4 rounded-2xl border border-[var(--gov-border)] bg-gradient-to-b from-[var(--gov-accent-soft)]/35 to-white p-5 shadow-[0_1px_3px_rgba(15,23,42,0.08)] sm:flex-row sm:items-center sm:gap-5 sm:p-6">
                            <span class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[var(--gov-accent-soft)] text-[var(--gov-accent)] sm:mx-0 sm:h-14 sm:w-14">
                                <x-medrek-icon name="chart-up" class="h-6 w-6 sm:h-7 sm:w-7" />
                            </span>
                            <p class="min-w-0 flex-1 text-center text-sm font-semibold leading-relaxed text-[var(--gov-navy)] sm:text-start sm:text-base">
                                خصومات خاصة للاشتراك بدورة القدرات العامة
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            @php
            $partnerLogoFiles = [
            'Full Logo WB.png',
            'masarat-1.png',
            'moe_logo.png',
            'Qyem.png',
            'ccaf5315-373d-477c-9781-9252b0511311.png',
            ];
            @endphp
            <section class="py-14 md:py-16 [font-family:inherit]" aria-labelledby="partners-heading">
                <div class="mx-auto max-w-6xl px-4 sm:px-6">
                    <p class="text-center text-xs font-semibold text-[var(--gov-muted)] sm:text-sm">بالتعاون مع</p>
                    <h2 id="partners-heading" class="mt-1 text-center text-2xl font-bold text-[var(--gov-navy)] md:text-3xl">جهات ساهمت في صناعة الأثر</h2>

                    {{-- dir=ltr على الحاوية: حركة translateX لا نهائية متسقة داخل الصفحة dir=rtl --}}
                    <div class="medrek-partners-viewport relative mx-auto mt-8 overflow-hidden py-4" role="region" aria-label="شعارات الشركاء — تمرير تلقائي" dir="ltr">
                        <div class="medrek-partners-track medrek-partners-track--paused">
                            @foreach ([0, 1, 2] as $loopPart)
                            <div class="medrek-partners-set" @if ($loopPart> 0) aria-hidden="true" @endif
                                >
                                @foreach ($partnerLogoFiles as $logoFile)
                                {{-- ثلاث نسخ متطابقة + translate(-33.333%) لحلقة بلا ثغرة وحشو أفضل على الشاشات الضيقة --}}
                                <div class="medrek-partner-slot shrink-0">
                                    <img src="{{ asset('images/partners/'.rawurlencode($logoFile)) }}" alt="" width="200" height="64" loading="lazy" decoding="async" draggable="false" class="medrek-partner-img" />
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
