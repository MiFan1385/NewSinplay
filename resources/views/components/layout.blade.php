<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Cosplay 交流平台' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 引入 Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-color: #6B46C1; /* 紫色主题 */
            --primary-light: #9F7AEA;
            --primary-dark: #553C9A;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- 顶部导航栏 -->
    <nav class="bg-purple-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold">Cosplay Hub</div>
                <div class="space-x-4">
                    {{ $navigation ?? '' }}
                </div>
            </div>
        </div>
    </nav>

    <!-- 主要内容区 -->
    <main class="container mx-auto px-4 py-6">
        {{ $slot }}
    </main>

    <!-- 页脚 -->
    <footer class="bg-purple-800 text-white mt-8">
        <div class="container mx-auto px-4 py-6">
            <p class="text-center">&copy; {{ date('Y') }} Cosplay Hub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html> 