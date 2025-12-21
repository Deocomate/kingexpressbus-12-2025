{{-- ===== resources/views/client/contact/index.blade.php ===== --}}
<x-client.layout :title="$title" :description="$description" body-class="bg-gray-50 overflow-x-hidden">

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            /* Prevent horizontal scroll */
            html,
            body {
                overflow-x: hidden;
            }

            /* Hero Background */
            .hero-contact-bg {
                background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.85), rgba(30, 41, 59, 0.8)), url('/client/images/city_imgs/ha-noi.jpg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            @media (max-width: 768px) {
                .hero-contact-bg {
                    background-attachment: scroll;
                }
            }

            /* Contact Card Hover */
            .contact-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .contact-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
            }

            .contact-card:hover .contact-icon {
                transform: scale(1.1) rotate(-5deg);
            }

            .contact-icon {
                transition: transform 0.3s ease;
            }

            /* FAQ Accordion */
            .faq-item {
                transition: all 0.3s ease;
            }

            .faq-item:hover {
                background-color: #fefce8;
            }

            /* Office Card */
            .office-card {
                transition: all 0.3s ease;
            }

            .office-card:hover {
                border-color: #fbbf24;
                background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
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

            /* Map Container */
            .map-container {
                position: relative;
                padding-bottom: 50%;
                height: 0;
                overflow: hidden;
                border-radius: 1rem;
            }

            .map-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 0;
            }

            /* Pulse Effect */
            .pulse-dot {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
                }
            }
        </style>
    @endpush

    {{-- Hero Section --}}
    <section
        class="relative min-h-[350px] md:min-h-[400px] hero-contact-bg flex flex-col justify-center items-center px-4 py-16 pt-24 md:py-20 overflow-hidden">
        <div class="container relative z-10 w-full max-w-4xl text-center" data-aos="fade-up" data-aos-duration="800">
            {{-- Badge --}}
            <span
                class="inline-block py-1.5 px-4 rounded-full bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 text-xs md:text-sm font-semibold tracking-wider mb-3 md:mb-4 backdrop-blur-sm"
                data-aos="fade-up" data-aos-delay="100">
                <i class="fa-solid fa-headset mr-2"></i>{{ __('client.contact.hero.badge') }}
            </span>

            {{-- Hero Title --}}
            <h1
                class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight drop-shadow-lg mb-3 md:mb-4">
                {{ __('client.contact.hero.title') }}
            </h1>

            {{-- Subtitle --}}
            <p class="text-base md:text-lg lg:text-xl text-gray-200 max-w-2xl mx-auto px-2" data-aos="fade-up"
                data-aos-delay="150">
                {{ __('client.contact.hero.subtitle') }}
            </p>

            {{-- Quick Contact Buttons --}}
            <div class="flex flex-wrap justify-center gap-3 md:gap-4 mt-6 md:mt-8" data-aos="fade-up"
                data-aos-delay="200">
                @if($webProfile->hotline ?? null)
                    <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->hotline) }}"
                        class="inline-flex items-center gap-2 px-5 md:px-6 py-2.5 md:py-3 bg-yellow-400 text-gray-900 rounded-full font-bold text-sm md:text-base hover:bg-yellow-300 transform hover:scale-105 transition-all shadow-lg">
                        <i class="fa-solid fa-phone"></i>
                        {{ $webProfile->hotline }}
                    </a>
                @endif
                @if($webProfile->zalo_url ?? null)
                    <a href="{{ $webProfile->zalo_url }}" target="_blank"
                        class="inline-flex items-center gap-2 px-5 md:px-6 py-2.5 md:py-3 bg-blue-500 text-white rounded-full font-bold text-sm md:text-base hover:bg-blue-400 transform hover:scale-105 transition-all shadow-lg">
                        <i class="fa-solid fa-comment-dots"></i>
                        Chat Zalo
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Support Channels Section --}}
    <section class="py-12 md:py-16 bg-white relative -mt-6 md:-mt-8 z-20 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl md:rounded-3xl shadow-2xl p-6 md:p-8 lg:p-12 border border-gray-100"
                data-aos="fade-up">
                {{-- Section Header --}}
                <div class="text-center mb-8 md:mb-10">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2 md:mb-3">
                        {{ __('client.contact.headings.support_channels') }}
                    </h2>
                    <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto">
                        {{ __('client.contact.support_desc') }}</p>
                </div>

                {{-- Support Channels Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    {{-- Hotline --}}
                    @if($webProfile->hotline ?? null)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->hotline) }}"
                            class="contact-card group flex items-center p-4 md:p-5 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl md:rounded-2xl border border-yellow-200 hover:border-yellow-400"
                            data-aos="fade-up" data-aos-delay="0">
                            <div
                                class="contact-icon flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-yellow-400 to-orange-500 text-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-phone text-lg md:text-xl"></i>
                            </div>
                            <div class="ml-3 md:ml-4 min-w-0">
                                <p class="font-bold text-base md:text-lg text-gray-900">
                                    {{ __('client.contact.channels.hotline') }}</p>
                                <p class="text-yellow-600 font-semibold text-sm md:text-base truncate">
                                    {{ $webProfile->hotline }}</p>
                            </div>
                            <div class="ml-auto shrink-0">
                                <span class="w-2.5 h-2.5 md:w-3 md:h-3 bg-green-500 rounded-full block pulse-dot"></span>
                            </div>
                        </a>
                    @endif

                    {{-- Phone --}}
                    @if($webProfile->phone ?? null)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->phone) }}"
                            class="contact-card group flex items-center p-4 md:p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl md:rounded-2xl border border-blue-200 hover:border-blue-400"
                            data-aos="fade-up" data-aos-delay="50">
                            <div
                                class="contact-icon flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-headset text-lg md:text-xl"></i>
                            </div>
                            <div class="ml-3 md:ml-4 min-w-0">
                                <p class="font-bold text-base md:text-lg text-gray-900">
                                    {{ __('client.contact.channels.care') }}</p>
                                <p class="text-blue-600 font-semibold text-sm md:text-base truncate">
                                    {{ $webProfile->phone }}</p>
                            </div>
                        </a>
                    @endif

                    {{-- Email --}}
                    @if($webProfile->email ?? null)
                        <a href="mailto:{{ $webProfile->email }}"
                            class="contact-card group flex items-center p-4 md:p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl md:rounded-2xl border border-green-200 hover:border-green-400"
                            data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="contact-icon flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-regular fa-envelope text-lg md:text-xl"></i>
                            </div>
                            <div class="ml-3 md:ml-4 min-w-0">
                                <p class="font-bold text-base md:text-lg text-gray-900">
                                    {{ __('client.contact.channels.email') }}</p>
                                <p class="text-green-600 font-semibold text-xs md:text-sm truncate">{{ $webProfile->email }}
                                </p>
                            </div>
                        </a>
                    @endif

                    {{-- Facebook --}}
                    @if($webProfile->facebook_url ?? null)
                        <a href="{{ $webProfile->facebook_url }}" target="_blank"
                            class="contact-card group flex items-center p-4 md:p-5 bg-gradient-to-br from-blue-50 to-sky-50 rounded-xl md:rounded-2xl border border-blue-200 hover:border-blue-400"
                            data-aos="fade-up" data-aos-delay="150">
                            <div
                                class="contact-icon flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-brands fa-facebook-f text-lg md:text-xl"></i>
                            </div>
                            <div class="ml-3 md:ml-4 min-w-0">
                                <p class="font-bold text-base md:text-lg text-gray-900">
                                    {{ __('client.contact.channels.facebook') }}</p>
                                <p class="text-blue-600 text-xs md:text-sm">Facebook Fanpage</p>
                            </div>
                        </a>
                    @endif

                    {{-- Zalo --}}
                    @if($webProfile->zalo_url ?? null)
                        <a href="{{ $webProfile->zalo_url }}" target="_blank"
                            class="contact-card group flex items-center p-4 md:p-5 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl md:rounded-2xl border border-blue-200 hover:border-blue-400"
                            data-aos="fade-up" data-aos-delay="200">
                            <div
                                class="contact-icon flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-500 to-cyan-500 text-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-comment-dots text-lg md:text-xl"></i>
                            </div>
                            <div class="ml-3 md:ml-4 min-w-0">
                                <p class="font-bold text-base md:text-lg text-gray-900">
                                    {{ __('client.contact.channels.zalo') }}</p>
                                <p class="text-blue-600 text-xs md:text-sm">Chat ngay</p>
                            </div>
                        </a>
                    @endif

                    {{-- WhatsApp --}}
                    @if($webProfile->whatsapp ?? null)
                        <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $webProfile->whatsapp) }}" target="_blank"
                            class="contact-card group flex items-center p-4 md:p-5 bg-gradient-to-br from-green-50 to-lime-50 rounded-xl md:rounded-2xl border border-green-200 hover:border-green-400"
                            data-aos="fade-up" data-aos-delay="250">
                            <div
                                class="contact-icon flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-brands fa-whatsapp text-xl md:text-2xl"></i>
                            </div>
                            <div class="ml-3 md:ml-4 min-w-0">
                                <p class="font-bold text-base md:text-lg text-gray-900">WhatsApp</p>
                                <p class="text-green-600 text-xs md:text-sm truncate">{{ $webProfile->whatsapp }}</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Working Hours & Offices Section --}}
    <section class="py-12 md:py-16 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-6 md:gap-8">
                {{-- Working Hours --}}
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg p-6 md:p-8 border border-gray-100"
                    data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center gap-3 md:gap-4 mb-4 md:mb-6">
                        <div
                            class="w-12 h-12 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg">
                            <i class="fa-regular fa-clock text-xl md:text-2xl"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900">
                            {{ __('client.contact.headings.working_hours') }}
                        </h3>
                    </div>

                    <div class="space-y-3 md:space-y-4">
                        <div
                            class="flex items-center justify-between p-3 md:p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg md:rounded-xl border border-green-100">
                            <div class="flex items-center gap-2 md:gap-3">
                                <span class="w-2.5 h-2.5 md:w-3 md:h-3 bg-green-500 rounded-full pulse-dot"></span>
                                <span
                                    class="font-semibold text-gray-800 text-sm md:text-base">{{ __('client.contact.hours.weekday_label') }}</span>
                            </div>
                            <span class="text-green-600 font-bold text-sm md:text-base">07:00 - 22:00</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-3 md:p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg md:rounded-xl border border-blue-100">
                            <div class="flex items-center gap-2 md:gap-3">
                                <span class="w-2.5 h-2.5 md:w-3 md:h-3 bg-blue-500 rounded-full"></span>
                                <span
                                    class="font-semibold text-gray-800 text-sm md:text-base">{{ __('client.contact.hours.weekend_label') }}</span>
                            </div>
                            <span class="text-blue-600 font-bold text-sm md:text-base">08:00 - 21:00</span>
                        </div>

                        <div
                            class="mt-4 md:mt-6 p-3 md:p-4 bg-yellow-50 rounded-lg md:rounded-xl border border-yellow-200">
                            <p class="text-xs md:text-sm text-yellow-800">
                                <i class="fa-solid fa-info-circle mr-2"></i>
                                {{ __('client.contact.hours.note') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Offices --}}
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg p-6 md:p-8 border border-gray-100"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center gap-3 md:gap-4 mb-4 md:mb-6">
                        <div
                            class="w-12 h-12 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg">
                            <i class="fa-solid fa-location-dot text-xl md:text-2xl"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900">
                            {{ __('client.contact.headings.offices') }}</h3>
                    </div>

                    <div class="space-y-2 md:space-y-3 max-h-[280px] md:max-h-[350px] overflow-y-auto pr-2">
                        @forelse ($offices as $office)
                            <div
                                class="office-card p-3 md:p-4 bg-gray-50 rounded-lg md:rounded-xl border border-gray-200 transition-all">
                                <div class="flex items-start gap-2 md:gap-3">
                                    <div
                                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                        <i class="fa-solid fa-building text-xs md:text-sm"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-gray-900 text-sm md:text-base truncate">{{ $office->name }}
                                        </p>
                                        <p class="text-xs md:text-sm text-gray-600 line-clamp-2">
                                            {{ $office->address }}, {{ $office->district_name }},
                                            {{ $office->province_name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-6 md:py-8 text-sm md:text-base">
                                {{ __('client.contact.no_offices') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-12 md:py-16 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                {{-- Section Header --}}
                <div class="text-center mb-8 md:mb-12" data-aos="fade-up">
                    <span
                        class="inline-block py-1.5 px-4 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 font-semibold text-xs md:text-sm border border-blue-200 mb-3 md:mb-4">
                        <i class="fa-solid fa-circle-question mr-2"></i>FAQ
                    </span>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-gray-900">
                        {{ __('client.contact.headings.faq') }}
                    </h2>
                </div>

                {{-- FAQ Accordion --}}
                <div class="space-y-3 md:space-y-4" x-data="{ openFaq: null }">
                    @foreach(__('client.contact.faq_items') as $index => $faq)
                        <div class="faq-item bg-white rounded-xl md:rounded-2xl border border-gray-200 overflow-hidden shadow-sm"
                            data-aos="fade-up" data-aos-delay="{{ min($index * 50, 200) }}">
                            <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                                class="w-full flex items-center justify-between p-4 md:p-5 text-left"
                                :class="openFaq === {{ $index }} ? 'bg-yellow-50' : ''">
                                <span
                                    class="font-bold text-gray-900 pr-3 md:pr-4 text-sm md:text-base">{{ $faq['question'] }}</span>
                                <span
                                    class="shrink-0 w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center transition-all"
                                    :class="openFaq === {{ $index }} ? 'bg-yellow-400 text-gray-900 rotate-180' : 'bg-gray-100 text-gray-500'">
                                    <i class="fa-solid fa-chevron-down text-xs md:text-sm"></i>
                                </span>
                            </button>
                            <div x-show="openFaq === {{ $index }}" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="px-4 md:px-5 pb-4 md:pb-5 text-gray-600 leading-relaxed border-t border-gray-100">
                                <p class="pt-3 md:pt-4 text-sm md:text-base">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    @if($webProfile->map_embedded ?? null)
        <section class="py-12 md:py-16 bg-gray-50 overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto" data-aos="fade-up">
                    <div class="text-center mb-6 md:mb-8">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2 md:mb-3">
                            {{ __('client.contact.headings.map') }}</h2>
                        <p class="text-gray-500 text-sm md:text-base">{{ __('client.contact.map_desc') }}</p>
                    </div>

                    <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl p-3 md:p-4 border border-gray-100">
                        <div class="map-container rounded-xl md:rounded-2xl overflow-hidden">
                            {!! $webProfile->map_embedded !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-12 md:py-16 bg-gradient-to-r from-yellow-400 via-yellow-500 to-orange-500 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 md:gap-8 text-center md:text-left"
                data-aos="fade-up">
                <div class="space-y-2 md:space-y-3 max-w-xl">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                        {{ __('client.contact.cta.title') }}
                    </h2>
                    <p class="text-gray-800/80 text-base md:text-lg">
                        {{ __('client.contact.cta.subtitle') }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 w-full md:w-auto">
                    <a href="{{ route('client.home') }}"
                        class="inline-flex items-center justify-center gap-2 md:gap-3 px-6 md:px-8 py-3 md:py-4 bg-gray-900 text-white rounded-full font-bold text-base md:text-lg hover:bg-gray-800 transform hover:scale-105 transition-all shadow-xl">
                        <i class="fa-solid fa-ticket"></i>
                        {{ __('client.contact.cta.book_button') }}
                    </a>
                    @if($webProfile->hotline ?? null)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->hotline) }}"
                            class="inline-flex items-center justify-center gap-2 md:gap-3 px-6 md:px-8 py-3 md:py-4 bg-white text-gray-900 rounded-full font-bold text-base md:text-lg hover:bg-gray-100 transform hover:scale-105 transition-all shadow-xl">
                            <i class="fa-solid fa-phone"></i>
                            {{ __('client.contact.cta.call_button') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                AOS.init({
                    once: true,
                    offset: 50,
                    duration: 600,
                    easing: 'ease-out-cubic',
                    disable: window.innerWidth < 768 ? 'mobile' : false
                });
            });
        </script>
    @endpush

</x-client.layout>