<x-client.layout title="Đăng ký tài khoản" description="Tạo tài khoản King Express Bus để trải nghiệm dịch vụ tốt hơn.">
    @php
        $redirectTarget = $redirectTo ?? route('client.profile.index');
    @endphp

    <section
        class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 bg-slate-900 pointer-events-none z-0">
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('/userfiles/files/kingexpressbus/cabin/3.jpg'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/90 to-blue-900/40"></div>
        </div>

        <!-- Main Container -->
        <div
            class="relative z-10 w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center animate-fade-in-up">

            <!-- Left Side: Welcome Info (Hidden on Mobile) -->
            <div class="hidden lg:block text-white space-y-8 pr-10">
                <div class="animate-fade-in delay-100">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500 text-white uppercase tracking-wide shadow-lg shadow-blue-500/20">
                        <i class="fa-solid fa-gift mr-2"></i> Đăng ký thành viên
                    </span>
                    <h1 class="mt-6 text-5xl font-extrabold leading-tight tracking-tight">
                        Bắt đầu hành trình <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-400">cùng
                            King Express</span>
                    </h1>
                    <p class="mt-4 text-lg text-slate-300 font-light">
                        Tạo tài khoản ngay hôm nay để tích điểm, đổi vé và nhận vô vàn ưu đãi hấp dẫn trên mọi chuyến
                        đi.
                    </p>
                </div>

                <div class="grid gap-5 mt-10 animate-fade-in delay-200">
                    <div
                        class="flex items-start gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                        <div
                            class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg shadow-yellow-500/30">
                            <i class="fa-solid fa-coins text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Tích điểm đổi quà</h3>
                            <p class="text-sm text-slate-400 mt-1">Mỗi chuyến đi đều mang lại điểm thưởng để quy đổi
                                thành vé miễn phí.</p>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                        <div
                            class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white shadow-lg shadow-purple-500/30">
                            <i class="fa-solid fa-tags text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Ưu đãi độc quyền</h3>
                            <p class="text-sm text-slate-400 mt-1">Nhận thông báo sớm nhất về các chương trình khuyến
                                mãi và giảm giá sâu.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Register Form -->
            <div
                class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 w-full max-w-lg mx-auto lg:ml-auto relative overflow-hidden group">
                <!-- Decorative top border -->
                <div
                    class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500">
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Tạo tài khoản</h2>
                    <p class="text-slate-500 mt-2 text-sm">Điền thông tin của bạn để đăng ký thành viên</p>
                </div>

                <form action="{{ route('client.register.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{{ $redirectTarget }}">

                    <!-- Name Input -->
                    <div class="group/input relative">
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Họ và
                            tên</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input id="name" name="name" type="text"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-slate-800 placeholder:text-slate-400"
                                placeholder="Nguyễn Văn A" value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name')
                            <p class="text-sm text-red-500 mt-1.5 ml-1 animate-pulse"><i
                                    class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="group/input relative">
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input id="email" name="email" type="email"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-slate-800 placeholder:text-slate-400"
                                placeholder="email@example.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <p class="text-sm text-red-500 mt-1.5 ml-1 animate-pulse"><i
                                    class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Input -->
                    <div class="group/input relative">
                        <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Số điện
                            thoại</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input id="phone" name="phone" type="tel"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-slate-800 placeholder:text-slate-400"
                                placeholder="0912 345 678" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <p class="text-sm text-red-500 mt-1.5 ml-1 animate-pulse"><i
                                    class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Password Input -->
                        <div class="group/input relative">
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Mật
                                khẩu</label>
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

                        <!-- Confirm Password Input -->
                        <div class="group/input relative">
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Xác nhận</label>
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium text-slate-800 placeholder:text-slate-400"
                                    placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="w-full mt-4 relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transform transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed group/btn">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-user-plus text-sm"></i>
                            <span>Đăng ký tài khoản</span>
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
                            Đã là thành viên?
                            <a href="{{ route('client.login', ['redirect_to' => $redirectTarget]) }}"
                                class="font-bold text-blue-600 hover:text-blue-700 transition-colors relative inline-block group/link">
                                Đăng nhập ngay
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