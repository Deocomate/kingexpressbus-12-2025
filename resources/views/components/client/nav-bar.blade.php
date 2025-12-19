@php
    $brandTitle = data_get($webProfile, 'title', config('app.name'));
    $brandLogo = data_get($webProfile, 'logo_url');
    $hotline = data_get($webProfile, 'hotline');
    $hotlineTel = $hotline ? preg_replace('/[^\d+]/', '', $hotline) : '';
    $authUser = $authUser ?? null;
    $isCustomer = $authUser && ($authUser->role ?? null) === 'customer';
    $customerLinks = $customerLinks ?? [];
    $currentLocale = app()->getLocale();
    $languageOptions = [
        ['code' => 'vi', 'label' => 'Tiếng Việt', 'flag' => asset('/client/icons/vn-flag.svg')],
        ['code' => 'en', 'label' => 'English', 'flag' => asset('/client/icons/en-flag.svg')],
    ];
    $currentLanguage = collect($languageOptions)->firstWhere('code', $currentLocale);
@endphp

<header class="bg-white/95 shadow-sm sticky top-0 z-50 backdrop-blur-lg border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            {{-- Brand Logo --}}
            <a href="{{ route('client.home') }}" class="flex-shrink-0 flex items-center gap-2"
                aria-label="{{ __('client.nav.home_aria') }}">
                @if ($brandLogo)
                    <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-10 w-auto">
                @else
                    <span
                        class="text-2xl font-extrabold bg-gradient-to-r from-yellow-500 to-orange-500 bg-clip-text text-transparent">{{ $brandTitle }}</span>
                @endif
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1">
                @foreach ($mainMenu ?? [] as $item)
                    @php
                        $isActive = $item->isActive ?? false;
                        $hasChildren = !empty($item->children);
                    @endphp

                    @if (!$hasChildren)
                        {{-- Simple menu item without dropdown --}}
                        <a href="{{ url($item->url) }}"
                            class="font-semibold transition-all duration-200 px-4 py-2 rounded-lg whitespace-nowrap {{ $isActive ? 'bg-yellow-50 text-yellow-600' : 'text-slate-700 hover:bg-slate-100 hover:text-yellow-600' }}">
                            {{ $item->name }}
                        </a>
                    @else
                        {{-- Super Menu with dropdown - parent is also clickable --}}
                        <div class="relative group">
                            <a href="{{ url($item->url) }}"
                                class="flex items-center gap-1.5 font-semibold transition-all duration-200 px-4 py-2 rounded-lg whitespace-nowrap {{ $isActive || ($item->isParentOfActive ?? false) ? 'bg-yellow-50 text-yellow-600' : 'text-slate-700 hover:bg-slate-100 hover:text-yellow-600' }}">
                                <span>{{ $item->name }}</span>
                                <i
                                    class="fa-solid fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                            </a>
                            <div
                                class="absolute left-0 mt-0 pt-2 w-72 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div
                                    class="bg-white border border-slate-100 rounded-xl shadow-xl py-2 max-h-80 overflow-y-auto">
                                    @foreach ($item->children as $child)
                                        <a href="{{ url($child->url) }}"
                                            class="block px-4 py-2.5 text-sm rounded-md mx-1 {{ ($child->isActive ?? false) ? 'bg-yellow-50 text-yellow-700 font-semibold' : 'text-slate-600 hover:bg-yellow-50 hover:text-yellow-700' }}">
                                            <span class="flex items-center gap-2">
                                                <i class="fa-solid fa-route text-xs text-yellow-500"></i>
                                                {{ $child->name }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </nav>

            {{-- Desktop Actions --}}
            <div class="hidden lg:flex items-center gap-3">
                {{-- Language Switcher --}}
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-100 transition-colors">
                        @if($currentLanguage && $currentLanguage['flag'])
                            <img src="{{ $currentLanguage['flag'] }}" alt="{{ $currentLanguage['label'] }}"
                                class="w-5 h-5 rounded-full object-cover">
                        @endif
                        <span
                            class="font-semibold text-sm text-slate-700 uppercase">{{ $currentLanguage['code'] }}</span>
                        <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-40 bg-white border border-slate-100 rounded-xl shadow-xl py-1.5 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                        @foreach ($languageOptions as $language)
                            <a href="{{ route('client.locale.switch', ['locale' => $language['code']]) }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-slate-100 {{ $currentLocale === $language['code'] ? 'font-bold text-yellow-600' : 'text-slate-700' }}">
                                <img src="{{ $language['flag'] }}" alt="{{ $language['label'] }}"
                                    class="w-5 h-5 rounded-full object-cover">
                                <span>{{ $language['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Hotline --}}
                @if ($hotline)
                    <a href="tel:{{ $hotlineTel }}"
                        class="flex items-center gap-2 text-green-600 font-bold px-3 py-2 rounded-lg hover:bg-green-50 transition-colors duration-200">
                        <i class="fas fa-phone-alt text-sm animate-pulse"></i>
                        <span class="text-sm">{{ $hotline }}</span>
                    </a>
                @endif

                {{-- Auth Section --}}
                @if ($isCustomer)
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-100 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($authUser->name, 0, 1)) }}
                            </div>
                            <span
                                class="font-semibold text-sm text-slate-800 max-w-[100px] truncate">{{ $authUser->name }}</span>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-64 bg-white border border-slate-100 rounded-xl shadow-xl py-2 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="font-semibold text-slate-900">{{ $authUser->name }}</p>
                                <p class="text-sm text-slate-500 truncate">{{ $authUser->email ?? $authUser->phone }}</p>
                            </div>
                            <div class="py-2">
                                @foreach ($customerLinks as $link)
                                    <a href="{{ $link['url'] }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-yellow-600">
                                        <i class="{{ $link['icon'] }} w-4 text-center text-slate-400"></i>
                                        <span>{{ $link['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                            <form method="POST" action="{{ route('client.logout') }}"
                                class="pt-2 border-t border-slate-100">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                                    <span>{{ __('client.nav.logout') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('client.login') }}"
                            class="text-sm font-semibold text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-100 transition-colors">
                            {{ __('client.nav.login') }}
                        </a>
                        <a href="{{ route('client.register') }}"
                            class="text-sm font-semibold bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-2 rounded-lg hover:from-yellow-500 hover:to-orange-600 transition-all shadow-md">
                            {{ __('client.nav.register') }}
                        </a>
                    </div>
                @endif
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-button"
                class="lg:hidden text-2xl text-slate-700 hover:text-yellow-600 transition-colors"
                aria-label="{{ __('client.nav.open_menu') }}">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Panel --}}
    <div id="mobile-menu"
        class="lg:hidden fixed top-0 left-0 w-80 h-screen bg-white shadow-2xl z-[1000] transform -translate-x-full transition-transform duration-300"
        aria-hidden="true">
        <div class="p-5 flex flex-col h-full">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('client.home') }}" class="flex items-center gap-2"
                    aria-label="{{ __('client.nav.home_aria') }}">
                    @if ($brandLogo)
                        <img src="{{ $brandLogo }}" alt="{{ $brandTitle }}" class="h-10">
                    @else
                        <span
                            class="text-xl font-extrabold bg-gradient-to-r from-yellow-500 to-orange-500 bg-clip-text text-transparent">{{ $brandTitle }}</span>
                    @endif
                </a>
                <button id="close-mobile-menu" class="text-3xl text-slate-400 hover:text-slate-600">&times;</button>
            </div>

            {{-- Auth for Logged Out --}}
            @if (!$isCustomer)
                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('client.login') }}"
                        class="flex-1 text-center border border-slate-200 rounded-xl py-2.5 font-semibold text-slate-700 hover:bg-slate-50">
                        {{ __('client.nav.login') }}
                    </a>
                    <a href="{{ route('client.register') }}"
                        class="flex-1 text-center bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-semibold rounded-xl py-2.5">
                        {{ __('client.nav.register') }}
                    </a>
                </div>
            @endif

            {{-- Navigation --}}
            <nav class="flex-grow overflow-y-auto space-y-1">
                @foreach ($mainMenu ?? [] as $item)
                    @php
                        $isActive = $item->isActive ?? false;
                        $hasChildren = !empty($item->children);

                        // Assign appropriate icon based on menu item
                        $icon = match ($item->id ?? '') {
                            'static_home' => 'fa-solid fa-home',
                            'static_about' => 'fa-solid fa-info-circle',
                            'static_routes' => 'fa-solid fa-map-signs',
                            'static_hot_routes' => 'fa-solid fa-fire',
                            'static_contact' => 'fa-solid fa-phone',
                            default => 'fa-solid fa-link',
                        };
                    @endphp

                    @if (!$hasChildren)
                        {{-- Simple menu item --}}
                        <a href="{{ url($item->url) }}"
                            class="flex items-center gap-3 font-semibold py-3 px-4 rounded-xl transition-all duration-200 {{ $isActive ? 'bg-yellow-50 text-yellow-600' : 'text-slate-700 hover:bg-slate-100' }}">
                            <i class="{{ $icon }} w-5 text-center"></i>
                            {{ $item->name }}
                        </a>
                    @else
                        {{-- Super Menu - parent is clickable, children shown below --}}
                        <div x-data="{ open: false }">
                            {{-- Parent link with toggle --}}
                            <div class="flex items-center">
                                <a href="{{ url($item->url) }}"
                                    class="flex-1 flex items-center gap-3 font-semibold py-3 px-4 rounded-xl transition-all duration-200 {{ $isActive || ($item->isParentOfActive ?? false) ? 'bg-yellow-50 text-yellow-600' : 'text-slate-700 hover:bg-slate-100' }}">
                                    <i class="{{ $icon }} w-5 text-center"></i>
                                    {{ $item->name }}
                                </a>
                                <button @click="open = !open" class="p-3 text-slate-500 hover:text-yellow-600">
                                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                                        :class="{ 'rotate-180': open }"></i>
                                </button>
                            </div>
                            {{-- Children links --}}
                            <div x-show="open" x-collapse class="pl-8 mt-1 space-y-1 border-l-2 border-yellow-200 ml-6">
                                @foreach ($item->children as $child)
                                    <a href="{{ url($child->url) }}"
                                        class="flex items-center gap-2 font-medium py-2 px-3 rounded-lg transition-all duration-200 {{ ($child->isActive ?? false) ? 'text-yellow-600 font-semibold bg-yellow-50' : 'text-slate-600 hover:text-yellow-600 hover:bg-slate-50' }}">
                                        <i class="fa-solid fa-route text-xs text-yellow-500"></i>
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </nav>

            {{-- Footer section of mobile menu --}}
            <div class="mt-auto pt-4 border-t border-slate-200 space-y-4">
                {{-- Auth for Logged In --}}
                @if ($isCustomer)
                    <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50 space-y-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($authUser->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900 truncate">{{ $authUser->name }}</p>
                                <p class="text-sm text-slate-500 truncate">{{ $authUser->email ?? $authUser->phone }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-2 pt-3 border-t border-slate-200">
                            @foreach ($customerLinks as $link)
                                <a href="{{ $link['url'] }}"
                                    class="flex items-center gap-3 text-sm text-yellow-600 hover:text-yellow-700">
                                    <i class="{{ $link['icon'] }} w-4 text-center"></i>
                                    <span>{{ $link['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                        <form method="POST" action="{{ route('client.logout') }}" class="pt-3 border-t border-slate-200">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-start gap-3 text-sm text-red-600">
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                                <span>{{ __('client.nav.logout') }}</span>
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Language Switcher --}}
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($languageOptions as $language)
                        <a href="{{ route('client.locale.switch', ['locale' => $language['code']]) }}"
                            class="flex items-center justify-center gap-2 py-2.5 rounded-xl border text-sm font-semibold transition-all duration-200 {{ $currentLocale === $language['code'] ? 'bg-gradient-to-r from-yellow-400 to-orange-500 text-white border-yellow-400' : 'border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                            <img src="{{ $language['flag'] }}" alt="{{ $language['label'] }}"
                                class="w-5 h-5 rounded-full object-cover">
                            <span>{{ $language['label'] }}</span>
                        </a>
                    @endforeach
                </div>

                {{-- Hotline --}}
                @if ($hotline)
                    <a href="tel:{{ $hotlineTel }}"
                        class="flex items-center gap-3 bg-green-50 text-green-600 font-semibold px-4 py-3 rounded-xl border border-green-200">
                        <i class="fas fa-phone-alt animate-pulse"></i>
                        <span class="flex flex-col text-left leading-tight">
                            <span
                                class="text-xs uppercase tracking-wide text-green-500">{{ __('client.nav.hotline') }}</span>
                            <span>{{ $hotline }}</span>
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div id="mobile-menu-overlay" class="hidden lg:hidden fixed inset-0 bg-black/50 z-[999]"></div>
</header>