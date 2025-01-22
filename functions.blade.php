@extends('fresns::app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">主题设置</h1>
        
        <form action="{{ route('fresns.theme.functions', ['fskey' => 'CosplayHub']) }}" method="post">
            @csrf
            
            <!-- 主题色设置 -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">基础设置</h2>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        主题色
                    </label>
                    <input type="color" 
                        name="theme_color" 
                        value="{{ $config['theme_color'] ?? '#6B46C1' }}"
                        class="w-20 h-10">
                </div>
            </div>

            <!-- 多语言设置 -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">多语言设置</h2>
                
                <!-- 中文设置 -->
                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-800 mb-4">简体中文</h3>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            站点名称
                        </label>
                        <input type="text" 
                            name="site_name[zh-Hans]" 
                            value="{{ $config['site_name']['zh-Hans'] ?? 'Cosplay Hub' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            站点描述
                        </label>
                        <textarea 
                            name="site_description[zh-Hans]" 
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">{{ $config['site_description']['zh-Hans'] ?? '专注于 Cosplay 爱好者的交流社区' }}</textarea>
                    </div>
                </div>

                <!-- 英文设置 -->
                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-800 mb-4">English</h3>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Site Name
                        </label>
                        <input type="text" 
                            name="site_name[en]" 
                            value="{{ $config['site_name']['en'] ?? 'Cosplay Hub' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Site Description
                        </label>
                        <textarea 
                            name="site_description[en]" 
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">{{ $config['site_description']['en'] ?? 'A community for Cosplay enthusiasts' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    保存设置
                </button>
            </div>
        </form>
    </div>
@endsection 