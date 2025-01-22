@extends('fresns::app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <div class="text-6xl text-purple-600 mb-4">404</div>
            <h1 class="text-2xl font-bold text-gray-900 mb-4">页面未找到</h1>
            <p class="text-gray-600 mb-8">抱歉，您访问的页面不存在或已被删除。</p>
            <a href="{{ route('home') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                返回首页
            </a>
        </div>
    </div>
@endsection 