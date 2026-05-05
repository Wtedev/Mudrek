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
    </style>
    @stack('head')
</head>
<body class="min-h-dvh text-slate-800 antialiased">
    @yield('content')
    @stack('scripts')
</body>
</html>
