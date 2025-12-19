{{-- ===== resources/views/client/contact/index.blade.php ===== --}}
<x-client.layout :title="$title" :description="$description">

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            /* Hero Background */
            .hero-contact-bg {
                background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.85), rgba(30, 41, 59, 0.8)), url('/client/images/city_imgs/ha-noi.jpg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
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
    <section class="relative min-h-[400px] hero-contact-bg flex flex-col justify-center items-center px-4 py-20">
        <div class="container relative z-10 w-full max-w-4xl text-center" data-aos="fade-up" data-aos-duration="1000">
            {{-- Badge --}}
            <span
                class="inline-block py-1.5 px-4 rounded-full bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 text-sm font-semibold tracking-wider mb-4 backdrop-blur-sm"
                data-aos="fade-down" data-aos-delay="200">
                <i class="fa-solid fa-headset mr-2"></i>{{ __('client.contact.hero.badge') }}
            </span>

            {{-- Hero Title --}}
            <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight drop-shadow-lg mb-4">
                {{ __('client.contact.hero.title') }}
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                {{ __('client.contact.hero.subtitle') }}
            </p>

            {{-- Quick Contact Buttons --}}
            <div class="flex flex-wrap justify-center gap-4 mt-8" data-aos="fade-up" data-aos-delay="400">
                @if($webProfile->hotline ?? null)
                    <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->hotline) }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 rounded-full font-bold hover:bg-yellow-300 transform hover:scale-105 transition-all shadow-lg">
                        <i class="fa-solid fa-phone"></i>
                        {{ $webProfile->hotline }}
                    </a>
                @endif
                @if($webProfile->zalo_url ?? null)
                    <a href="{{ $webProfile->zalo_url }}" target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-full font-bold hover:bg-blue-400 transform hover:scale-105 transition-all shadow-lg">
                        <i class="fa-solid fa-comment-dots"></i>
                        Chat Zalo
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Support Channels Section --}}
    <section class="py-16 bg-white relative -mt-8 z-20">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100" data-aos="fade-up">
                {{-- Section Header --}}
                <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                        {{ __('client.contact.headings.support_channels') }}
                    </h2>
                    <p class="text-gray-500 max-w-xl mx-auto">{{ __('client.contact.support_desc') }}</p>
                </div>

                {{-- Support Channels Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Hotline --}}
                    @if($webProfile->hotline ?? null)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->hotline) }}"
                            class="contact-card group flex items-center p-5 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border border-yellow-200 hover:border-yellow-400"
                            data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="contact-icon flex-shrink-0 w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-500 text-white rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-phone text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-lg text-gray-900">{{ __('client.contact.channels.hotline') }}</p>
                                <p class="text-yellow-600 font-semibold">{{ $webProfile->hotline }}</p>
                            </div>
                            <div class="ml-auto">
                                <span class="w-3 h-3 bg-green-500 rounded-full block pulse-dot"></span>
                            </div>
                        </a>
                    @endif

                    {{-- Phone --}}
                    @if($webProfile->phone ?? null)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->phone) }}"
                            class="contact-card group flex items-center p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 hover:border-blue-400"
                            data-aos="fade-up" data-aos-delay="150">
                            <div
                                class="contact-icon flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-headset text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-lg text-gray-900">{{ __('client.contact.channels.care') }}</p>
                                <p class="text-blue-600 font-semibold">{{ $webProfile->phone }}</p>
                            </div>
                        </a>
                    @endif

                    {{-- Email --}}
                    @if($webProfile->email ?? null)
                        <a href="mailto:{{ $webProfile->email }}"
                            class="contact-card group flex items-center p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200 hover:border-green-400"
                            data-aos="fade-up" data-aos-delay="200">
                            <div
                                class="contact-icon flex-shrink-0 w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-regular fa-envelope text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-lg text-gray-900">{{ __('client.contact.channels.email') }}</p>
                                <p class="text-green-600 font-semibold text-sm">{{ $webProfile->email }}</p>
                            </div>
                        </a>
                    @endif

                    {{-- Facebook --}}
                    @if($webProfile->facebook_url ?? null)
                        <a href="{{ $webProfile->facebook_url }}" target="_blank"
                            class="contact-card group flex items-center p-5 bg-gradient-to-br from-blue-50 to-sky-50 rounded-2xl border border-blue-200 hover:border-blue-400"
                            data-aos="fade-up" data-aos-delay="250">
                            <div
                                class="contact-icon flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-brands fa-facebook-f text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-lg text-gray-900">{{ __('client.contact.channels.facebook') }}</p>
                                <p class="text-blue-600 text-sm">Facebook Fanpage</p>
                            </div>
                        </a>
                    @endif

                    {{-- Zalo --}}
                    @if($webProfile->zalo_url ?? null)
                        <a href="{{ $webProfile->zalo_url }}" target="_blank"
                            class="contact-card group flex items-center p-5 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl border border-blue-200 hover:border-blue-400"
                            data-aos="fade-up" data-aos-delay="300">
                            <div
                                class="contact-icon flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 text-white rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-comment-dots text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-lg text-gray-900">{{ __('client.contact.channels.zalo') }}</p>
                                <p class="text-blue-600 text-sm">Chat ngay</p>
                            </div>
                        </a>
                    @endif

                    {{-- WhatsApp --}}
                    @if($webProfile->whatsapp ?? null)
                        <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $webProfile->whatsapp) }}" target="_blank"
                            class="contact-card group flex items-center p-5 bg-gradient-to-br from-green-50 to-lime-50 rounded-2xl border border-green-200 hover:border-green-400"
                            data-aos="fade-up" data-aos-delay="350">
                            <div
                                class="contact-icon flex-shrink-0 w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-lg text-gray-900">WhatsApp</p>
                                <p class="text-green-600 text-sm">{{ $webProfile->whatsapp }}</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Working Hours & Offices Section --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8">
                {{-- Working Hours --}}
                <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100" data-aos="fade-right">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg">
                            <i class="fa-regular fa-clock text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ __('client.contact.headings.working_hours') }}
                        </h3>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 bg-green-500 rounded-full pulse-dot"></span>
                                <span
                                    class="font-semibold text-gray-800">{{ __('client.contact.hours.weekday_label') }}</span>
                            </div>
                            <span class="text-green-600 font-bold">07:00 - 22:00</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                <span
                                    class="font-semibold text-gray-800">{{ __('client.contact.hours.weekend_label') }}</span>
                            </div>
                            <span class="text-blue-600 font-bold">08:00 - 21:00</span>
                        </div>

                        <div class="mt-6 p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                            <p class="text-sm text-yellow-800">
                                <i class="fa-solid fa-info-circle mr-2"></i>
                                {{ __('client.contact.hours.note') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Offices --}}
                <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100" data-aos="fade-left">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ __('client.contact.headings.offices') }}</h3>
                    </div>

                    <div class="space-y-3 max-h-[350px] overflow-y-auto pr-2">
                        @forelse ($offices as $office)
                            <div class="office-card p-4 bg-gray-50 rounded-xl border border-gray-200 transition-all">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-1">
                                        <i class="fa-solid fa-building text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $office->name }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $office->address }}, {{ $office->district_name }},
                                            {{ $office->province_name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">{{ __('client.contact.no_offices') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                {{-- Section Header --}}
                <div class="text-center mb-12" data-aos="fade-up">
                    <span
                        class="inline-block py-1.5 px-4 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 font-semibold text-sm border border-blue-200 mb-4">
                        <i class="fa-solid fa-circle-question mr-2"></i>FAQ
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                        {{ __('client.contact.headings.faq') }}
                    </h2>
                </div>

                {{-- FAQ Accordion --}}
                <div class="space-y-4" x-data="{ openFaq: null }">
                    @foreach(__('client.contact.faq_items') as $index => $faq)
                        <div class="faq-item bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm"
                            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                                class="w-full flex items-center justify-between p-5 text-left"
                                :class="openFaq === {{ $index }} ? 'bg-yellow-50' : ''">
                                <span class="font-bold text-gray-900 pr-4">{{ $faq['question'] }}</span>
                                <span class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-all"
                                    :class="openFaq === {{ $index }} ? 'bg-yellow-400 text-gray-900 rotate-180' : 'bg-gray-100 text-gray-500'">
                                    <i class="fa-solid fa-chevron-down text-sm"></i>
                                </span>
                            </button>
                            <div x-show="openFaq === {{ $index }}" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="px-5 pb-5 text-gray-600 leading-relaxed border-t border-gray-100">
                                <p class="pt-4">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    @if($webProfile->map_embedded ?? null)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto" data-aos="fade-up">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-900 mb-3">{{ __('client.contact.headings.map') }}</h2>
                        <p class="text-gray-500">{{ __('client.contact.map_desc') }}</p>
                    </div>

                    <div class="bg-white rounded-3xl shadow-xl p-4 border border-gray-100">
                        <div class="map-container rounded-2xl overflow-hidden">
                            {!! $webProfile->map_embedded !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-yellow-400 via-yellow-500 to-orange-500">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left"
                data-aos="fade-up">
                <div class="space-y-3 max-w-xl">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ __('client.contact.cta.title') }}
                    </h2>
                    <p class="text-gray-800/80 text-lg">
                        {{ __('client.contact.cta.subtitle') }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('client.home') }}"
                        class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-full font-bold text-lg hover:bg-gray-800 transform hover:scale-105 transition-all shadow-xl">
                        <i class="fa-solid fa-ticket"></i>
                        {{ __('client.contact.cta.book_button') }}
                    </a>
                    @if($webProfile->hotline ?? null)
                        <a href="tel:{{ preg_replace('/[^\d+]/', '', $webProfile->hotline) }}"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-white text-gray-900 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all shadow-xl">
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
                    offset: 80,
                    duration: 800,
                    easing: 'ease-out-cubic',
                });
            });
        </script>
    @endpush

</x-client.layout>