{{-- ===== resources/views/client/routes/index.blade.php ===== --}}
<x-client.layout :web-profile="$web_profile ?? null" :main-menu="$mainMenu ?? []" :title="$title ?? 'Tìm kiếm tuyến xe'"
    :description="$description ?? ''">

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            /* Hero Background Animation */
            .hero-routes-bg {
                background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.5)), url('/userfiles/files/city_imgs/sapa.jpg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            /* Typing Cursor */
            .typing-cursor {
                animation: blink 1s step-end infinite;
            }

            @keyframes blink {
                50% {
                    opacity: 0;
                }
            }

            /* Route Card Hover Effects */
            .route-card {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .route-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }

            .route-card:hover .route-card-image {
                transform: scale(1.15);
            }

            .route-card:hover .route-card-overlay {
                opacity: 0.5;
            }

            .route-card:hover .route-card-cta {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }

            .route-card-cta {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.5);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Floating Animation */
            .float-animation {
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            /* Stats Counter Animation */
            .stat-number {
                font-variant-numeric: tabular-nums;
            }

            /* Feature Card Hover */
            .feature-card {
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateX(10px);
            }

            .feature-card:hover .feature-icon {
                transform: scale(1.1) rotate(-5deg);
            }

            .feature-icon {
                transition: transform 0.3s ease;
            }

            /* Badge Bounce */
            @keyframes bounce-slow {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-8px);
                }
            }

            .animate-bounce-slow {
                animation: bounce-slow 2s ease-in-out infinite;
            }

            /* Glass Effect */
            .glass-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            /* Pulse Ring */
            .pulse-ring {
                animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse-ring {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }
            }
        </style>
    @endpush

    {{-- Hero Section with Search --}}
    <section class="relative min-h-[600px] hero-routes-bg flex flex-col justify-center items-center px-4 py-24 lg:py-28"
        x-data="routesHeroTypewriter">

        <div class="container relative z-10 w-full max-w-5xl space-y-6 text-center" data-aos="fade-up"
            data-aos-duration="1000">
            {{-- Badge --}}
            <span
                class="inline-block py-1.5 px-4 rounded-full bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 text-sm font-semibold tracking-wider mb-2 backdrop-blur-sm"
                data-aos="fade-down" data-aos-delay="200">
                <i
                    class="fa-solid fa-route mr-2"></i>{{ __('client.routes.index.badge', ['default' => 'TÌM TUYẾN XE']) }}
            </span>

            {{-- Hero Title with Typing Effect --}}
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight drop-shadow-lg min-h-[80px]">
                <span x-text="text"></span><span class="typing-cursor text-yellow-400">|</span>
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto drop-shadow-md" data-aos="fade-up"
                data-aos-delay="400">
                {{ __('client.routes.index.hero_subtitle', ['default' => 'Hơn 100+ tuyến đường chất lượng cao đang chờ đón bạn']) }}
            </p>

            {{-- Search Bar Wrapper - Fixed Alignment --}}
            <div class="mt-10 w-full text-left" data-aos="fade-up" data-aos-delay="500">
                <x-client.search-bar :search-data="$searchData"
                    :submit-label="__('client.route_show.search_submit_label', ['default' => 'Tìm chuyến'])" />
            </div>
        </div>

        {{-- Scroll Down Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce text-white/70">
            <i class="fa-solid fa-chevron-down text-2xl"></i>
        </div>
    </section>

    {{-- Stats Bar --}}
    <section class="py-8 bg-white border-b border-gray-100 relative -mt-8 z-20">
        <div class="container mx-auto px-4">
            <div class="glass-card rounded-2xl shadow-xl p-6 md:p-8 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8"
                data-aos="fade-up" data-aos-offset="-100">
                <div class="text-center" x-data="statsCounter(100, 2, 30)">
                    <p class="text-3xl md:text-4xl font-extrabold text-yellow-500 stat-number"><span
                            x-text="displayCount">0</span>+</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ __('client.routes.index.stat_routes', ['default' => 'Tuyến đường']) }}
                    </p>
                </div>
                <div class="text-center" x-data="statsCounter(50, 1, 40)">
                    <p class="text-3xl md:text-4xl font-extrabold text-blue-500 stat-number"><span
                            x-text="displayCount">0</span>+</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ __('client.routes.index.stat_companies', ['default' => 'Nhà xe đối tác']) }}
                    </p>
                </div>
                <div class="text-center" x-data="statsCounter(10000, 200, 30, true)">
                    <p class="text-3xl md:text-4xl font-extrabold text-green-500 stat-number"><span
                            x-text="displayCount">0</span>+</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ __('client.routes.index.stat_customers', ['default' => 'Khách hàng mỗi năm']) }}
                    </p>
                </div>
                <div class="text-center" x-data="statsCounter(98, 2, 30)">
                    <p class="text-3xl md:text-4xl font-extrabold text-purple-500 stat-number"><span
                            x-text="displayCount">0</span>%</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ __('client.routes.index.stat_satisfaction', ['default' => 'Hài lòng']) }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Popular Routes Section --}}
    @if(isset($popularRoutes) && $popularRoutes->isNotEmpty())
        <section class="py-16 md:py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                {{-- Section Header --}}
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-4"
                    data-aos="fade-right">
                    <div class="space-y-2">
                        <h2 class="text-2xl md:text-4xl font-bold text-gray-900">
                            {{ __('client.routes.index.popular_title', ['default' => 'Tuyến đường']) }}
                            <span
                                class="text-yellow-500">{{ __('client.routes.index.popular_highlight', ['default' => 'Phổ biến']) }}</span>
                        </h2>
                        <p class="text-gray-500 text-sm md:text-base">
                            {{ __('client.routes.index.popular_subtitle', ['default' => 'Các tuyến đường được khách hàng yêu thích nhất.']) }}
                        </p>
                    </div>
                    <a href="{{ route('client.routes.search') }}"
                        class="hidden md:inline-flex items-center gap-2 text-yellow-600 font-semibold hover:text-yellow-700 transition hover:translate-x-1 duration-300">
                        {{ __('client.routes.index.view_all', ['default' => 'Xem tất cả']) }} <i
                            class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                {{-- Routes Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($popularRoutes as $route)
                        @php
                            $minPrice = $route->min_price ?? 0;
                            $priceDisplay = $minPrice > 0 ? number_format($minPrice) . 'đ' : __('client.common.contact_price', ['default' => 'Liên hệ']);
                        @endphp
                        <a href="{{ route('client.routes.show', ['slug' => $route->slug]) }}"
                            class="route-card group block h-full bg-white rounded-2xl overflow-hidden shadow-sm border border-transparent hover:border-yellow-200 relative"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                            {{-- Image --}}
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $route->thumbnail_url ?? '/userfiles/files/city_imgs/ha-noi.jpg' }}"
                                    alt="{{ $route->name }}"
                                    class="route-card-image w-full h-full object-cover transition-transform duration-700">
                                <div
                                    class="route-card-overlay absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-70 transition-opacity duration-300">
                                </div>

                                {{-- Route Info on Image --}}
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <div class="flex justify-between items-end">
                                        <div>
                                            <p
                                                class="text-xs font-bold uppercase tracking-wider text-yellow-400 mb-1 flex items-center gap-1">
                                                <i class="fa-solid fa-bus"></i>
                                                {{ $route->company_count ?? 0 }}
                                                {{ __('client.routes.index.companies', ['default' => 'nhà xe']) }}
                                            </p>
                                            <h3
                                                class="text-lg font-bold truncate pr-2 group-hover:text-yellow-200 transition-colors">
                                                {{ $route->name }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                                {{-- Hover CTA Button --}}
                                <div class="route-card-cta absolute top-1/2 left-1/2">
                                    <span
                                        class="w-12 h-12 rounded-full bg-yellow-400 text-gray-900 flex items-center justify-center text-xl shadow-lg">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5">
                                <div class="flex justify-between items-center mb-4">
                                    <span
                                        class="text-sm text-gray-500 bg-gray-100 px-2.5 py-1 rounded-md flex items-center gap-1">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $route->duration ?? 'N/A' }}
                                    </span>
                                    <span
                                        class="text-sm text-gray-500 bg-gray-100 px-2.5 py-1 rounded-md flex items-center gap-1">
                                        <i class="fa-solid fa-bus"></i>
                                        {{ $route->company_count ?? 0 }}
                                        {{ __('client.routes.index.companies', ['default' => 'nhà xe']) }}
                                    </span>
                                </div>
                                <div
                                    class="pt-4 border-t border-gray-100 flex justify-between items-center group-hover:border-yellow-100 transition-colors">
                                    <span class="text-xs text-gray-500 group-hover:text-yellow-600 transition-colors">
                                        {{ __('client.routes.index.from', ['default' => 'Giá chỉ từ']) }}
                                    </span>
                                    <span class="text-lg font-bold text-blue-600 group-hover:text-yellow-500 transition-colors">
                                        {{ $priceDisplay }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Mobile View All Button --}}
                <div class="mt-8 text-center md:hidden">
                    <a href="{{ route('client.routes.search') }}"
                        class="inline-block px-6 py-3 bg-white border border-gray-300 rounded-full font-semibold text-gray-700 hover:bg-gray-50 transition w-full shadow-sm">
                        {{ __('client.routes.index.view_all_routes', ['default' => 'Xem tất cả tuyến đường']) }}
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- SEO Content (Optimized) --}}
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-50/30 via-white to-blue-50/30 -z-10"></div>

        {{-- Decorative Elements --}}
        <div
            class="absolute top-20 right-10 w-64 h-64 bg-yellow-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 float-animation">
        </div>
        <div class="absolute bottom-20 left-10 w-64 h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"
            style="animation: float 4s ease-in-out infinite 1s;"></div>

        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                {{-- SEO Text Content --}}
                <div class="space-y-8" data-aos="fade-right" data-aos-duration="1000">
                    <div class="space-y-4">
                        <span
                            class="inline-block py-1.5 px-4 rounded-full bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-700 font-semibold text-sm border border-yellow-200">
                            <i
                                class="fa-solid fa-award mr-2"></i>{{ __('client.about.subtitle', ['default' => 'Về King Express Bus']) }}
                        </span>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                            {{ __('client.about.title', ['default' => 'Tại sao nên chọn chúng tôi?']) }}
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ __('client.about.description', ['default' => 'King Express Bus cam kết mang đến trải nghiệm hành trình an toàn, tiện nghi và đẳng cấp nhất cho quý khách hàng.']) }}
                        </p>
                    </div>

                    <ul class="space-y-6">
                        <li class="feature-card flex items-start gap-4 p-4 rounded-xl hover:bg-yellow-50/50 transition-colors"
                            data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="feature-icon w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center text-white shrink-0 shadow-lg">
                                <i class="fa-solid fa-star text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ __('client.about.feature_1_title', ['default' => 'Dịch vụ 5 sao']) }}
                                </h4>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('client.about.feature_1_desc', ['default' => 'Hệ thống xe cabin VIP và limousine đời mới, được trang bị đầy đủ tiện nghi hiện đại.']) }}
                                </p>
                            </div>
                        </li>
                        <li class="feature-card flex items-start gap-4 p-4 rounded-xl hover:bg-blue-50/50 transition-colors"
                            data-aos="fade-up" data-aos-delay="200">
                            <div
                                class="feature-icon w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center text-white shrink-0 shadow-lg">
                                <i class="fa-solid fa-shield-halved text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ __('client.about.feature_2_title', ['default' => 'An toàn tuyệt đối']) }}
                                </h4>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('client.about.feature_2_desc', ['default' => 'Đội ngũ tài xế chuyên nghiệp, giàu kinh nghiệm. Kiểm tra kỹ thuật xe nghiêm ngặt trước mỗi chuyến đi.']) }}
                                </p>
                            </div>
                        </li>
                        <li class="feature-card flex items-start gap-4 p-4 rounded-xl hover:bg-green-50/50 transition-colors"
                            data-aos="fade-up" data-aos-delay="300">
                            <div
                                class="feature-icon w-14 h-14 rounded-2xl bg-gradient-to-br from-green-400 to-green-500 flex items-center justify-center text-white shrink-0 shadow-lg">
                                <i class="fa-solid fa-headset text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ __('client.about.feature_3_title', ['default' => 'Hỗ trợ 24/7']) }}
                                </h4>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('client.about.feature_3_desc', ['default' => 'Tổng đài chăm sóc khách hàng hoạt động 24/7, sẵn sàng giải đáp mọi thắc mắc và hỗ trợ đặt vé.']) }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- SEO Image --}}
                <div class="relative" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                        <img src="/userfiles/files/city_imgs/sapa.jpg"
                            alt="{{ __('client.about.image_alt', ['default' => 'Nội thất xe King Express Bus']) }}"
                            class="w-full object-cover aspect-[4/3] group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                        </div>

                        {{-- Play Button Overlay (Optional for video) --}}
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div
                                class="w-20 h-20 rounded-full bg-white/90 flex items-center justify-center shadow-2xl pulse-ring">
                                <i class="fa-solid fa-play text-yellow-500 text-2xl ml-1"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Floating Badge --}}
                    <div
                        class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl hidden md:block float-animation z-10">
                        <div class="flex items-center gap-3">
                            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 p-3 rounded-full text-white">
                                <i class="fa-solid fa-thumbs-up text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-semibold">
                                    {{ __('client.about.badge_subtitle', ['default' => 'Hài lòng']) }}
                                </p>
                                <p class="text-lg font-bold text-gray-900">98% Review 5★</p>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Badge --}}
                    <div class="absolute -top-4 -right-4 bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-2xl shadow-xl hidden md:block text-white"
                        style="animation: float 3s ease-in-out infinite 0.5s;">
                        <div class="text-center">
                            <p class="text-2xl font-extrabold">7+</p>
                            <p class="text-xs font-medium opacity-90">
                                {{ __('client.about.years_experience', ['default' => 'Năm kinh nghiệm']) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-12 md:py-16 bg-gradient-to-r from-yellow-400 via-yellow-500 to-orange-500">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left"
                data-aos="fade-up">
                <div class="space-y-2">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                        {{ __('client.routes.index.cta_title', ['default' => 'Sẵn sàng cho chuyến đi tiếp theo?']) }}
                    </h2>
                    <p class="text-gray-800/80">
                        {{ __('client.routes.index.cta_subtitle', ['default' => 'Đặt vé ngay hôm nay để nhận ưu đãi hấp dẫn']) }}
                    </p>
                </div>
                <a href="#top"
                    class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-full font-bold text-lg hover:bg-gray-800 transform hover:scale-105 transition-all shadow-xl">
                    <i class="fa-solid fa-ticket"></i>
                    {{ __('client.routes.index.cta_button', ['default' => 'Đặt vé ngay']) }}
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                // Stats Counter Component with IntersectionObserver
                Alpine.data('statsCounter', (target, step = 1, speed = 30, formatNumber = false) => ({
                    count: 0,
                    target: target,
                    step: step,
                    speed: speed,
                    formatNumber: formatNumber,
                    started: false,
                    get displayCount() {
                        return this.formatNumber ? this.count.toLocaleString() : this.count;
                    },
                    init() {
                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting && !this.started) {
                                    this.started = true;
                                    this.animate();
                                }
                            });
                        }, { threshold: 0.5 });
                        observer.observe(this.$el);
                    },
                    animate() {
                        const interval = setInterval(() => {
                            if (this.count < this.target) {
                                this.count = Math.min(this.count + this.step, this.target);
                            } else {
                                clearInterval(interval);
                            }
                        }, this.speed);
                    }
                }));

                // Hero Typewriter Component
                Alpine.data('routesHeroTypewriter', () => ({
                    text: '',
                    textArray: [
                        '{{ __("client.routes.index.typing_1", ["default" => "Vi vu khắp Việt Nam"]) }}',
                        '{{ __("client.routes.index.typing_2", ["default" => "Hà Nội - Sa Pa"]) }}',
                        '{{ __("client.routes.index.typing_3", ["default" => "100+ tuyến đường"]) }}',
                        '{{ __("client.routes.index.typing_4", ["default" => "Xe chất lượng cao"]) }}'
                    ],
                    textIndex: 0,
                    charIndex: 0,
                    typeSpeed: 80,
                    eraseSpeed: 40,
                    newTextDelay: 2500,
                    init() {
                        setTimeout(() => this.type(), 800);
                    },
                    type() {
                        if (this.charIndex < this.textArray[this.textIndex].length) {
                            this.text += this.textArray[this.textIndex].charAt(this.charIndex);
                            this.charIndex++;
                            setTimeout(() => this.type(), this.typeSpeed);
                        } else {
                            setTimeout(() => this.erase(), this.newTextDelay);
                        }
                    },
                    erase() {
                        if (this.charIndex > 0) {
                            this.text = this.textArray[this.textIndex].substring(0, this.charIndex - 1);
                            this.charIndex--;
                            setTimeout(() => this.erase(), this.eraseSpeed);
                        } else {
                            this.textIndex++;
                            if (this.textIndex >= this.textArray.length) this.textIndex = 0;
                            setTimeout(() => this.type(), this.typeSpeed + 800);
                        }
                    }
                }))
            })

            document.addEventListener('DOMContentLoaded', function () {
                AOS.init({
                    once: true,
                    offset: 80,
                    duration: 800,
                    easing: 'ease-out-cubic',
                });
            });
        </script>
    @endpush

</x-client.layout>