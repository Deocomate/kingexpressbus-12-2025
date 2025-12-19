<x-client.layout title="Đăng nhập King Express Bus"
    description="Đăng nhập để theo dõi hành trình, đặt vé nhanh và quản lý thông tin cá nhân của bạn.">
    @php
        $redirectTarget = $redirectTo ?? route('client.profile.index');
    @endphp

    <section
        class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 bg-slate-900 pointer-events-none z-0">
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('/userfiles/files/kingexpressbus/cabin/1.jpg'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-slate-900/40"></div>
        </div>

        <!-- Main Container -->
        <div
            class="relative z-10 w-full max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center animate-fade-in-up">

            <!-- Left Side: Welcome Info (Hidden on Mobile, Visible on LG scerens) -->
            <div class="hidden lg:block text-white space-y-8 pr-10">
                <div class="animate-fade-in delay-100">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-400 text-slate-900 uppercase tracking-wide">
                        <i class="fa-solid fa-star mr-2"></i> Thành viên ưu đãi
                    </span>
                    <h1 class="mt-6 text-5xl font-extrabold leading-tight tracking-tight">
                        Chào mừng trở lại <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">King
                            Express Bus</span>
                    </h1>
                    <p class="mt-4 text-lg text-slate-300 font-light">
                        Đăng nhập để quản lý vé, xem lịch sử chuyến đi và nhận các ưu đãi độc quyền dành riêng cho bạn.
                    </p>
                </div>

                <div class="space-y-6 mt-10 animate-fade-in delay-200">
                    <div
                        class="flex items-start gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                        <div
                            class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                            <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Quản lý chuyến đi</h3>
                            <p class="text-sm text-slate-400 mt-1">Xem lại lịch sử đặt vé và trạng thái thanh toán theo
                                thời gian thực.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div
                class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 w-full max-w-md mx-auto lg:ml-auto relative overflow-hidden group">
                <!-- Decorative top border -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Đăng nhập</h2>
                    <p class="text-slate-500 mt-2 text-sm">Điền thông tin tài khoản của bạn để tiếp tục</p>
                </div>

                <form action="{{ route('client.login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{{ $redirectTarget }}">

                    <div class="space-y-5">
                        <!-- Login Input -->
                        <div class="group/input relative">
                            <label for="login" class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email hoặc
                                Số điện thoại</label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                                    <i class="fa-regular fa-envelope"></i>
                                </span>
                                <input id="login" name="login" type="text"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-slate-800 placeholder:text-slate-400"
                                    placeholder="example@gmail.com" value="{{ old('login') }}" required autofocus>
                            </div>
                            @error('login')
                                <p class="text-sm text-red-500 mt-1.5 ml-1 animate-pulse"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="group/input relative">
                            <div class="flex justify-between items-center mb-1.5 ml-1">
                                <label for="password" class="block text-sm font-semibold text-slate-700">Mật
                                    khẩu</label>
                                {{-- <a href="#"
                                    class="text-xs font-medium text-blue-600 hover:text-blue-700 hover:underline">Quên
                                    mật khẩu?</a> --}}
                            </div>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input id="password" name="password" type="password"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-slate-800 placeholder:text-slate-400"
                                    placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <p class="text-sm text-red-500 mt-1.5 ml-1 animate-pulse"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2.5 cursor-pointer group/check">
                            <div class="relative flex items-center">
                                <input type="checkbox" name="remember" value="1" class="peer sr-only">
                                <div
                                    class="w-5 h-5 border-2 border-slate-300 rounded peer-checked:bg-blue-600 peer-checked:border-blue-600 transition-all">
                                </div>
                                <div
                                    class="absolute inset-0 flex items-center justify-center text-white opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none">
                                    <i class="fa-solid fa-check text-xs"></i>
                                </div>
                            </div>
                            <span
                                class="text-sm font-medium text-slate-600 group-hover/check:text-slate-800 transition-colors">Lưu
                                đăng nhập</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transform transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed group/btn">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <span>Đăng nhập</span>
                            <i class="fa-solid fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </span>
                    </button>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-500">Hoặc</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-slate-600">
                            Bạn chưa có tài khoản?
                            <a href="{{ route('client.register', ['redirect_to' => $redirectTarget]) }}"
                                class="font-bold text-blue-600 hover:text-blue-700 transition-colors relative inline-block group/link">
                                Đăng ký ngay
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover/link:w-full"></span>
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Inline Styles for specific animations not in utility classes yet -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 20px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }
    </style>
</x-client.layout>