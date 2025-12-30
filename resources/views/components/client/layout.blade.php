@php
    // === SEO FALLBACK LOGIC ===
    // Priority: 1. Page-specific → 2. WebProfile → 3. Default

    $appName = config('app.name', 'King Express Bus');
    $defaultDescription = __('client.seo.default_description', ['default' => 'Đặt vé xe khách trực tuyến - Kết nối hàng nghìn chuyến xe chất lượng cao trên khắp Việt Nam. Đặt vé dễ dàng, thanh toán an toàn.']);
    $defaultKeywords = __('client.seo.default_keywords', ['default' => 'đặt vé xe khách, xe limousine, xe giường nằm, Hà Nội Sa Pa, King Express Bus, vé xe online']);

    // Title: page-specific → webProfile → app name
    $pageTitle = $title ?? data_get($webProfile, 'title', $appName);

    // Description: page-specific → webProfile → default
    $pageDescription = $description ?? data_get($webProfile, 'description', $defaultDescription);

    // Keywords: page-specific → default
    $pageKeywords = $keywords ?? $defaultKeywords;

    // Favicon: page-specific → webProfile → default
    $faviconUrl = $favicon ?? data_get($webProfile, 'favicon_url', '/client/icons/logo.ico');

    // Body class
    $bodyClassName = trim($bodyClass ?? '') !== '' ? trim($bodyClass) : 'bg-slate-50';

    // URLs
    $currentUrl = $canonicalUrl ?? url()->current();
    $baseUrl = url('/');

    // Images
    $logoUrl = data_get($webProfile, 'logo_url', '/client/images/web information/logo.jpg');
    $shareImage = $ogImage ?? data_get($webProfile, 'share_image_url', $logoUrl);
    $shareImageAlt = $ogImageAlt ?? $pageTitle;

    // Site info
    $siteNameValue = $siteName ?? data_get($webProfile, 'profile_name', $appName);
    $localeValue = $locale ?? (str_replace('-', '_', app()->getLocale()) . '_VN');
    $robotsMeta = $robots ?? 'index, follow';
    $ogTypeValue = $ogType ?? 'website';

    // Contact info for structured data
    $contactPhone = data_get($webProfile, 'hotline', data_get($webProfile, 'phone', ''));
    $contactEmail = data_get($webProfile, 'email', '');
    $contactAddress = data_get($webProfile, 'address', '');
    $facebookUrl = data_get($webProfile, 'facebook_url', '');

    // Auth user for nav
    $authUser = auth()->user();
    $customerNavLinks = [];
    if ($authUser && ($authUser->role ?? null) === 'customer') {
        $customerNavLinks = [
            [
                'label' => __('client.layout.profile'),
                'url' => route('client.profile.index'),
                'icon' => 'fa-solid fa-user',
            ],
            [
                'label' => __('client.layout.my_bookings'),
                'url' => route('client.profile.index') . '#history',
                'icon' => 'fa-solid fa-ticket',
            ],
        ];
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Primary SEO Meta Tags --}}
    <title>{{ $pageTitle }}</title>
    <meta name="title" content="{{ $pageTitle }}">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta name="author" content="{{ $siteNameValue }}">
    <meta name="robots" content="{{ $robotsMeta }}">
    <link rel="canonical" href="{{ $currentUrl }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="{{ $ogTypeValue }}">
    <meta property="og:site_name" content="{{ $siteNameValue }}">
    <meta property="og:locale" content="{{ $localeValue }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:image" content="{{ asset($shareImage) }}">
    <meta property="og:image:secure_url" content="{{ asset($shareImage) }}">
    <meta property="og:image:alt" content="{{ $shareImageAlt }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@kingexpressbus">
    <meta name="twitter:creator" content="@kingexpressbus">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ asset($shareImage) }}">
    <meta name="twitter:image:alt" content="{{ $shareImageAlt }}">

    {{-- Additional SEO Meta --}}
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#EAB308">
    <meta name="msapplication-TileColor" content="#EAB308">
    <link rel="alternate" hreflang="{{ app()->getLocale() }}" href="{{ $currentUrl }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/x-icon">

    {{-- JSON-LD Structured Data --}}
    @php
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $siteNameValue,
            'url' => $baseUrl,
            'logo' => asset($logoUrl),
        ];

        if ($contactPhone) {
            $structuredData['contactPoint'] = [
                '@type' => 'ContactPoint',
                'telephone' => $contactPhone,
                'contactType' => 'customer service',
                'availableLanguage' => ['Vietnamese', 'English'],
            ];
        }

        if ($facebookUrl) {
            $structuredData['sameAs'] = [$facebookUrl];
        }

        $structuredData['address'] = [
            '@type' => 'PostalAddress',
            'addressCountry' => 'VN',
        ];

        if ($contactAddress) {
            $structuredData['address']['streetAddress'] = $contactAddress;
        }
    @endphp
    <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    {{-- External Resources --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #mobile-menu {
            transition: transform 0.3s ease-in-out;
        }

        .social-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .social-icon:hover {
            transform: scale(1.1);
        }

        .messenger {
            background: linear-gradient(45deg, #0099ff, #a033ff);
        }

        .zalo {
            background-color: #0068FF;
        }

        .hotline {
            background-color: #d9534f;
        }

        details[open]>summary i.fa-chevron-down {
            transform: rotate(180deg);
        }

        details>summary {
            list-style: none;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }
    </style>
    @stack('styles')
</head>

<body class="{{ $bodyClassName }}">
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave-end="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
        x-init="setTimeout(() => show = false, 10000)"
        class="fixed top-20 right-4 z-50 w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg border border-yellow-200 pointer-events-auto"
        style="display: none;">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-xl"></i>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                        {{ __('client.layout.warning_holiday_ticket') }}
                    </p>
                </div>
                <div class="ml-4 flex flex-shrink-0">
                    <button type="button" @click="show = false"
                        class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <x-client.nav-bar :web-profile="$webProfile" :main-menu="$mainMenu" :auth-user="$authUser"
        :customer-links="$customerLinks" />
    <main>
        {{ $slot }}
    </main>
    <x-client.footer :web-profile="$webProfile" />
    @if ($webProfile)
        <div class="social-float">
            @if (data_get($webProfile, 'facebook_url'))
                <a href="https://m.me/{{ basename(parse_url(data_get($webProfile, 'facebook_url'), PHP_URL_PATH) ?? '') }}"
                    target="_blank" class="social-icon messenger" aria-label="Messenger">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
            @endif
            @if (data_get($webProfile, 'zalo_url'))
                <a href="{{ data_get($webProfile, 'zalo_url') }}" target="_blank" class="social-icon zalo" aria-label="Zalo">
                    <span class="font-bold">Za</span>
                </a>
            @endif
            @if (data_get($webProfile, 'hotline'))
                <a href="tel:{{ str_replace([' ', '.'], '', data_get($webProfile, 'hotline')) }}" class="social-icon hotline"
                    aria-label="Hotline">
                    <i class="fas fa-phone-alt"></i>
                </a>
            @endif
            @if (data_get($webProfile, 'whatsapp'))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', data_get($webProfile, 'whatsapp')) }}" target="_blank"
                    class="social-icon bg-green-500" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            @endif
        </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const closeMobileMenuButton = document.getElementById('close-mobile-menu');

            function toggleMenu() {
                mobileMenu.classList.toggle('-translate-x-full');
                mobileMenuOverlay.classList.toggle('hidden');
            }

            if (mobileMenuButton) mobileMenuButton.addEventListener('click', toggleMenu);
            if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', toggleMenu);
            if (closeMobileMenuButton) closeMobileMenuButton.addEventListener('click', toggleMenu);
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            };
            @if (session('success'))
                toastr.success('{{ addslashes(session('success')) }}');
            @endif
            @if (session('error'))
                toastr.error('{{ addslashes(session('error')) }}');
            @endif
            @if (session('warning'))
                toastr.warning('{{ addslashes(session('warning')) }}');
            @endif
            @if (session('info'))
                toastr.info('{{ addslashes(session('info')) }}');
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ addslashes($error) }}');
                @endforeach
            @endif
    });
    </script>
    @stack('scripts')
</body>

</html>