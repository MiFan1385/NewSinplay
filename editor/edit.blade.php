@extends('fresns::app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-8">
                {{ request('pid') ? '编辑帖子' : '发布新帖子' }}
            </h1>

            <form action="{{ fs_route(route('fresns.editor.post.store')) }}" method="post" enctype="multipart/form-data">
                @csrf
                
                @if(request('pid'))
                    <input type="hidden" name="pid" value="{{ request('pid') }}">
                @endif

                <!-- 标题 -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">标题</label>
                    <input type="text" 
                        name="title" 
                        value="{{ old('title', $post->title ?? '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>
                </div>

                <!-- 内容 -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">内容</label>
                    <textarea 
                        name="content" 
                        rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>{{ old('content', $post->content ?? '') }}</textarea>
                </div>

                <!-- 图片上传 -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">上传图片</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                        <input type="file" 
                            name="images[]" 
                            multiple 
                            accept="image/*"
                            onchange="handleImagePreview(event)"
                            class="hidden" 
                            id="image-upload">
                        <label for="image-upload" class="cursor-pointer">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">点击或拖拽图片到此处上传</p>
                                <p class="text-sm text-gray-400">支持 JPG、PNG 格式，单张不超过 5MB</p>
                            </div>
                        </label>
                        <div id="image-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
                    </div>
                </div>

                <!-- 话题标签 -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">添加话题</label>
                    <div class="flex flex-wrap gap-2">
                        <input type="text" 
                            name="topic" 
                            placeholder="输入话题名称"
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <div id="topic-list" class="flex flex-wrap gap-2">
                            @foreach($post->topics ?? [] as $topic)
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full">
                                    #{{ $topic->name }}
                                    <button type="button" class="ml-1 text-sm">&times;</button>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 按钮 -->
                <div class="flex justify-between">
                    <button type="button" 
                        class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50"
                        onclick="saveDraft()">
                        保存草稿
                    </button>
                    <button type="submit" 
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        发布
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // 保存草稿
        async function saveDraft() {
            const form = document.querySelector('form');
            const formData = new FormData(form);
            formData.append('is_draft', true);
            
            try {
                const response = await axios.post('{{ fs_route(route("fresns.editor.post.draft")) }}', formData);
                if (response.data.code === 0) {
                    alert('草稿保存成功');
                }
            } catch (error) {
                console.error('保存草稿失败:', error);
                alert('保存草稿失败');
            }
        }
    </script>
    @endpush
@endsection 