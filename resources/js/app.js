// 引入依赖
import axios from 'axios';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// CSRF Token 设置
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// 点赞功能
window.handleLike = async function(postId) {
    try {
        const response = await axios.post(`/posts/${postId}/like`);
        const button = document.querySelector(`#like-button-${postId}`);
        const count = document.querySelector(`#like-count-${postId}`);
        
        if (response.data.liked) {
            button.classList.add('text-purple-600');
            count.textContent = parseInt(count.textContent) + 1;
        } else {
            button.classList.remove('text-purple-600');
            count.textContent = parseInt(count.textContent) - 1;
        }
    } catch (error) {
        if (error.response.status === 401) {
            window.location.href = '/login';
        }
    }
}

// 关注功能
window.handleFollow = async function(userId) {
    try {
        const response = await axios.post(`/users/${userId}/follow`);
        const button = document.querySelector(`#follow-button-${userId}`);
        
        if (response.data.following) {
            button.textContent = '取消关注';
            button.classList.add('bg-gray-200');
            button.classList.remove('bg-purple-600');
        } else {
            button.textContent = '关注';
            button.classList.remove('bg-gray-200');
            button.classList.add('bg-purple-600');
        }
    } catch (error) {
        if (error.response.status === 401) {
            window.location.href = '/login';
        }
    }
}

// 图片预览
window.handleImagePreview = function(event) {
    const preview = document.querySelector('#image-preview');
    preview.innerHTML = '';
    
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('w-32', 'h-32', 'object-cover', 'rounded-lg');
            preview.appendChild(img);
        }
        reader.readAsDataURL(files[i]);
    }
} 