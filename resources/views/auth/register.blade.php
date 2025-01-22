<x-layout>
    <div class="max-w-md mx-auto">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">注册</h2>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        用户名
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                        id="username"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        邮箱
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        密码
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                        id="password"
                        type="password"
                        name="password"
                        required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        确认密码
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required>
                </div>
                
                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
                    注册
                </button>
            </form>
            
            <p class="text-center mt-4 text-sm text-gray-600">
                已有账号？
                <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800">
                    立即登录
                </a>
            </p>
        </div>
    </div>
</x-layout> 