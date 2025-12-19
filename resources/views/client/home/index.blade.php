<x-client.layout :title="__('Trang chủ - King Express Bus')" body-class="bg-gray-50">
    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            .hero-bg {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('/userfiles/files/city_imgs/sapa.jpg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
        </style>
    @endpush

    {{-- 1. HERO SECTION & SEARCH --}}
    <section class="relative min-h-[700px] hero-bg flex flex-col justify-center items-center text-center px-4 pt-20"
        x-data="heroTypewriter">

        <div class="relative z-10 w-full max-w-5xl space-y-6" data-aos="fade-up" data-aos-duration="1000">
            <span
                class="inline-block py-1 px-3 rounded-full bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 text-sm font-semibold tracking-wider mb-2 backdrop-blur-sm">
                #1 NỀN TẢNG ĐẶT VÉ XE KHÁCH
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white text-shadow leading-tight min-h-[80px]">
                <span x-text="text"></span><span class="animate-pulse text-yellow-400">|</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto drop-shadow-md">
                Kết nối hàng nghìn chuyến xe chất lượng cao trên khắp Việt Nam. Đặt vé dễ dàng, thanh toán an toàn.
            </p>

            {{-- Search Component --}}
            <div class="mt-10 w-full text-left">
                <x-client.search-bar :search-data="$searchData" submit-label="Tìm chuyến xe ngay" />
            </div>
        </div>

        {{-- Scroll Down Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce text-white/70">
            <i class="fa-solid fa-chevron-down text-2xl"></i>
        </div>
    </section>

    {{-- 1.5. BOOKING PROCESS --}}
    <section class="py-16 md:py-20 bg-gradient-to-b from-yellow-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 uppercase tracking-wide">
                    Dễ dàng đặt vé xe tại King Express Bus
                </h2>
                <div class="w-24 h-1.5 bg-yellow-400 mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                {{-- Connector Line (Desktop) --}}
                <div class="hidden md:block absolute top-[48px] left-[12.5%] right-[12.5%] h-0.5 bg-yellow-200 -z-10">
                </div>

                {{-- Step 1 --}}
                <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="0">
                    <div
                        class="w-24 h-24 rounded-full bg-yellow-100 flex items-center justify-center mb-6 shadow-lg border-4 border-white relative z-10 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-location-dot text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tìm kiếm</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-[200px]">
                        Chọn thông tin hành trình ấn “Tìm chuyến”
                    </p>
                </div>

                {{-- Step 2 --}}
                <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="150">
                    <div
                        class="w-24 h-24 rounded-full bg-yellow-100 flex items-center justify-center mb-6 shadow-lg border-4 border-white relative z-10 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-bus text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Chọn chuyến</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-[200px]">
                        Lựa chọn chuyến phù hợp và điền thông tin cá nhân
                    </p>
                </div>

                {{-- Step 3 --}}
                <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-24 h-24 rounded-full bg-yellow-100 flex items-center justify-center mb-6 shadow-lg border-4 border-white relative z-10 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-regular fa-credit-card text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Thanh toán</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-[200px]">
                        Tiến hành thanh toán online hoặc giữ chỗ trước
                    </p>
                </div>

                {{-- Step 4 --}}
                <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="450">
                    <div
                        class="w-24 h-24 rounded-full bg-yellow-100 flex items-center justify-center mb-6 shadow-lg border-4 border-white relative z-10 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-ticket text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Nhận vé</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-[200px]">
                        Nhận mã vé, xác nhận và lên xe!
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. SERVICE HIGHLIGHTS (Static Data) --}}
    <section class="py-12 md:py-20 bg-white border-b border-yellow-100/50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-16">
                
                {{-- Left: Experience Badge --}}
                <div class="flex items-center gap-6 w-full lg:w-auto justify-center lg:justify-start" data-aos="fade-right">
                    <div class="relative group">
                         <div class="absolute inset-0 bg-yellow-400 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-full animate-pulse"></div>
                        <div class="relative w-24 h-24 rounded-full border-4 border-yellow-100 bg-white flex flex-col items-center justify-center text-yellow-500 shadow-xl transform group-hover:scale-105 transition-transform duration-300">
                            <span class="text-3xl font-extrabold leading-none">07</span>
                            <span class="text-[10px] uppercase font-bold tracking-wider mt-1 text-gray-400">Năm</span>
                            <div class="absolute -bottom-3 bg-white px-2 py-0.5 rounded-full border border-yellow-100">
                                <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">07 năm kinh nghiệm</h3>
                        <p class="text-gray-500 text-sm md:text-base">Tự hào phục vụ hơn <span class="font-bold text-yellow-600">10.000+</span> lượt khách mỗi năm</p>
                    </div>
                    
                    {{-- Vertical Divider for Desktop --}}
                    <div class="hidden lg:block w-px h-16 bg-gradient-to-b from-transparent via-gray-200 to-transparent ml-6"></div>
                </div>

                {{-- Right: Features Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 w-full lg:w-auto lg:flex-1" data-aos="fade-left">
                    {{-- Item 1 --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-yellow-50 to-white border border-yellow-100/50 hover:shadow-md hover:border-yellow-200 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl shrink-0 group-hover:bg-yellow-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 group-hover:text-yellow-600 transition-colors">Hỗ trợ tận tâm 24/7</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Luôn sẵn sàng giải đáp</p>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-yellow-50 to-white border border-yellow-100/50 hover:shadow-md hover:border-yellow-200 transition-all duration-300 group">
                         <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl shrink-0 group-hover:bg-yellow-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 group-hover:text-yellow-600 transition-colors">Hành trình đa dạng</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Kết nối mọi miền</p>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-yellow-50 to-white border border-yellow-100/50 hover:shadow-md hover:border-yellow-200 transition-all duration-300 group">
                         <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl shrink-0 group-hover:bg-yellow-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 group-hover:text-yellow-600 transition-colors">Đảm bảo chất lượng</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Dịch vụ tiêu chuẩn 5 sao</p>
                        </div>
                    </div>

                    {{-- Item 4 --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-yellow-50 to-white border border-yellow-100/50 hover:shadow-md hover:border-yellow-200 transition-all duration-300 group">
                         <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl shrink-0 group-hover:bg-yellow-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 group-hover:text-yellow-600 transition-colors">Tối ưu chi phí</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Giá vé cạnh tranh nhất</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. POPULAR ROUTES (Dynamic Data) --}}
    @if($popularRoutes->isNotEmpty())
        <section class="py-12 md:py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-end mb-10" data-aos="fade-right">
                    <div class="space-y-2">
                        <h2 class="text-2xl md:text-4xl font-bold text-gray-900">Tuyến đường <span class="text-yellow-500">Phổ
                                biến</span></h2>
                        <p class="text-gray-500 text-sm md:text-base">Các tuyến đường được khách hàng yêu thích nhất.</p>
                    </div>
                    <a href="{{ route('client.routes.search') }}"
                        class="hidden md:inline-flex items-center gap-2 text-yellow-600 font-semibold hover:text-yellow-700 transition hover:translate-x-1 duration-300">
                        Xem tất cả <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($popularRoutes as $route)
                        <a href="{{ route('client.routes.show', ['slug' => $route->slug]) }}"
                            class="group block h-full bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-transparent hover:border-yellow-200 relative"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            
                            {{-- Image Container --}}
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $route->thumbnail_url ?? '/userfiles/files/city_imgs/ha-noi.jpg' }}"
                                    alt="{{ $route->name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-80 group-hover:opacity-60 transition-opacity"></div>
                                
                                {{-- Route Info on Image --}}
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <div class="flex justify-between items-end">
                                        <div>
                                            <p class="text-xs font-bold uppercase tracking-wider text-yellow-400 mb-1 flex items-center gap-1">
                                                <i class="fa-solid fa-road"></i>
                                                {{ $route->distance_km ? $route->distance_km . 'km' : 'Liên hệ' }}
                                            </p>
                                            <h3 class="text-lg font-bold truncate pr-2 group-hover:text-yellow-200 transition-colors">{{ $route->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Hover Button --}}
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all duration-500 scale-50 group-hover:scale-100">
                                    <span class="w-12 h-12 rounded-full bg-yellow-400 text-gray-900 flex items-center justify-center text-xl shadow-lg">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-md"><i class="fa-regular fa-clock mr-1"></i>
                                        {{ $route->duration ?? 'N/A' }}</span>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-md"><i class="fa-solid fa-bus mr-1"></i>
                                        {{ $route->company_count }} nhà xe</span>
                                </div>
                                <div class="pt-4 border-t border-gray-100 flex justify-between items-center group-hover:border-yellow-100 transition-colors">
                                    <span class="text-xs text-gray-500 group-hover:text-yellow-600 transition-colors">Giá chỉ từ</span>
                                    <span class="text-lg font-bold text-blue-600 group-hover:text-yellow-500 transition-colors">
                                        {{ $route->min_price > 0 ? number_format($route->min_price) . 'đ' : 'Liên hệ' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8 text-center md:hidden">
                    <a href="{{ route('client.routes.search') }}"
                        class="inline-block px-6 py-3 bg-white border border-gray-300 rounded-full font-semibold text-gray-700 hover:bg-gray-50 transition w-full shadow-sm">
                        Xem tất cả tuyến đường
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- 4. FEATURED COMPANIES (Dynamic Data) --}}
    @if($featuredCompanies->isNotEmpty())
        <section class="py-12 md:py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="zoom-in">
                    <h2 class="text-2xl md:text-4xl font-bold text-gray-900 mb-4">Đối tác <span class="text-yellow-500">Chiến
                            lược</span>
                    </h2>
                    <p class="text-gray-500 text-sm md:text-base">Hợp tác với các nhà xe uy tín hàng đầu để mang lại chuyến đi an toàn.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @foreach($featuredCompanies as $company)
                        <a href="{{ route('client.companies.show', ['slug' => $company->slug]) }}"
                            class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-yellow-200 hover:bg-white hover:shadow-lg transition-all duration-300 group"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <img src="{{ $company->thumbnail_url ?? '/userfiles/files/web%20information/logo.jpg' }}"
                                alt="{{ $company->name }}"
                                class="w-16 h-16 md:w-20 md:h-20 object-contain mb-4 grayscale group-hover:grayscale-0 transition-all duration-300">
                            <h4 class="font-semibold text-gray-900 text-center group-hover:text-yellow-600 transition text-sm md:text-base">
                                {{ $company->name }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $company->route_count }} tuyến</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 5. TESTIMONIALS (Static UI) --}}
    <section class="py-12 md:py-20 bg-blue-900 text-white relative overflow-hidden">
        {{-- Decoration --}}
        <div
            class="absolute top-0 left-0 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 translate-y-1/2">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Khách hàng nói gì về chúng tôi?</h2>
                <div class="w-20 h-1 bg-yellow-400 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10" data-aos="fade-right">
                    <div class="flex gap-1 text-yellow-400 mb-4">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-gray-200 mb-6 italic">"Trải nghiệm đặt vé rất mượt mà, giao diện dễ sử dụng. Tôi
                        thích cách hiển thị đầy đủ tiện ích của từng xe."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-bold">A
                        </div>
                        <div>
                            <h4 class="font-semibold">Nguyễn Văn An</h4>
                            <p class="text-xs text-gray-300">Khách hàng thân thiết</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10" data-aos="fade-up">
                    <div class="flex gap-1 text-yellow-400 mb-4">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-gray-200 mb-6 italic">"Xe chạy đúng giờ, tài xế thân thiện. Giá vé trên website
                        thường rẻ hơn mua trực tiếp tại bến."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center font-bold">L
                        </div>
                        <div>
                            <h4 class="font-semibold">Lê Thị Bình</h4>
                            <p class="text-xs text-gray-300">Hà Nội</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10" data-aos="fade-left">
                    <div class="flex gap-1 text-yellow-400 mb-4">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                            class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <p class="text-gray-200 mb-6 italic">"Hỗ trợ khách hàng rất nhiệt tình. Tôi từng bị nhầm ngày và
                        được hỗ trợ đổi vé nhanh chóng."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center font-bold">T
                        </div>
                        <div>
                            <h4 class="font-semibold">Trần Minh Long</h4>
                            <p class="text-xs text-gray-300">Đà Nẵng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. CALL TO ACTION --}}
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-[2rem] p-10 md:p-16 text-center shadow-2xl relative overflow-hidden"
                data-aos="zoom-in-up">
                <div class="absolute inset-0 opacity-10"></div> {{-- Removed pattern.png to fix 404 --}}
                <div class="relative z-10 space-y-6">
                    <h2 class="text-3xl md:text-5xl font-bold text-white">Sẵn sàng cho chuyến đi tiếp theo?</h2>
                    <p class="text-blue-100 text-lg max-w-2xl mx-auto">Đặt vé ngay hôm nay để nhận ưu đãi lên đến 30%
                        cho khách hàng mới.</p>
                    <div class="pt-4">
                        <a href="#top"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-yellow-400 text-gray-900 rounded-full font-bold text-lg hover:bg-yellow-300 transform hover:scale-105 transition-all shadow-lg">
                            <i class="fa-solid fa-ticket"></i> Đặt vé ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('heroTypewriter', () => ({
                    text: '',
                    textArray: ['King Express Bus & Tour', 'Hà Nội - Sa Pa', 'Nhà xe uy tín', '7 năm kinh nghiệm'],
                    textIndex: 0,
                    charIndex: 0,
                    typeSpeed: 100,
                    eraseSpeed: 50,
                    newTextDelay: 2000,
                    init() {
                        setTimeout(() => this.type(), 500);
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
                            setTimeout(() => this.type(), this.typeSpeed + 1100);
                        }
                    }
                }))
            })

            document.addEventListener('DOMContentLoaded', function () {
                AOS.init({
                    once: true,
                    offset: 100,
                    duration: 800,
                    easing: 'ease-out-cubic',
                });
            });
        </script>
    @endpush
</x-client.layout>