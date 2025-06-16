<div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 pl-10 space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <!-- User Info -->
        <div onclick="window.location.href='{{ route('profile.show', ['user' => $idea->user->id]) }}'" class="flex items-center space-x-3 cursor-pointer">
            <img
                class="w-12 h-12 rounded-full object-cover"
                src="{{ $idea->user->avatar_url }}"
                alt="{{ $idea->user->name }} Avatar"
            />
            <h5 class="text-lg font-semibold text-gray-800 hover:text-blue-600 transition-colors">
                {{ $idea->user->name }}
            </h5>
        </div>

        <!-- Actions -->
        <div class="flex space-x-2">
            @if (auth()->check() && auth()->id() === $idea->user_id)
                <form method="get" action="{{ url('/idea/' . $idea->id . '/edit') }}">
                    @csrf
                    <button class="text-green-600 hover:text-green-800 text-sm p-1 rounded hover:bg-green-50 transition-colors"><i class="fa-solid fa-pencil"></i></button>
                </form>
            @endif

            <form method="get" action="{{ url('/idea', $idea->id) }}">
                @csrf
                <button class="text-blue-600 hover:text-blue-800 text-sm p-1 rounded hover:bg-blue-50 transition-colors"><i class="fa-solid fa-eye"></i></button>
            </form>

            @if (auth()->check() && auth()->id() === $idea->user_id)
                <form method="POST" action="{{ url('/idea', $idea->id) }}" onsubmit="return confirm('Are you sure you want to delete this idea?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:text-red-800 text-sm p-1 rounded hover:bg-red-50 transition-colors" type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
                @endif
        </div>
    </div>

    <!-- Body -->
    <div>
        @if ($edit ?? false)
            <form action="{{ url('/idea/' . $idea->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4" id="edit-form">
                @csrf
                @method('PUT')

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea
                        name="content"
                        id="content"
                        rows="4"
                        class="w-full p-3 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                        required
                    >{{ old('content', $idea->content) }}</textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Media -->
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-700">Current Media</h3>
                    <div id="media-container" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($idea->media as $media)
                            <div class="relative group media-item" data-id="{{ $media->id }}">
                                <input type="hidden" name="existing_media_ids[]" value="{{ $media->id }}">
                                <input type="hidden" name="media_replace[{{ $media->id }}]" value="0" class="media-replace-flag">

                                <div class="aspect-video bg-black overflow-hidden rounded-md relative media-preview">
                                    @if($media->type === 'image')
                                        <img src="{{ asset('storage/'.$media->file_path) }}" alt="Current Image" class="w-full h-full object-cover" id="preview-{{ $media->id }}">
                                    @else
                                        <video class="w-full h-full object-cover" id="preview-{{ $media->id }}" muted playsinline>
                                            <source src="{{ asset('storage/'.$media->file_path) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>

                                <div class="absolute top-1 right-1 flex space-x-1">
                                    <button type="button" onclick="removeMedia(this)" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">×</button>
                                </div>

                                <div class="mt-2">
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Replace</label>
                                    <input
                                        type="file"
                                        name="media[{{ $media->id }}]"
                                        accept="image/*,video/*"
                                        onchange="replaceMediaPreview(this, {{ $media->id }})"
                                        class="text-xs"
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add new media button -->
                    <div class="mt-4">
                        <button type="button" onclick="addNewMedia()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            ➕ Add new media
                        </button>
                    </div>
                    @error('media')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit button -->
                <div class="pt-2 flex justify-end space-x-2">
                    <button
                        type="button"
                        onclick="cancelEdit()"
                        class="px-4 py-2 border border-gray-300 rounded text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors"
                    >
                        Update
                    </button>
                </div>
            </form>

        @else
            <div class="relative speech-bubble mb-4">
                <p class="text-gray-700 leading-relaxed">{!! $idea->formatted_content !!}</p>
            </div>

            <!-- Hiển thị media -->
            @if($idea->media->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 items-center">
                    @foreach($idea->media as $media)
                        @if($media->type === 'image')
                            <div class="relative group">
                                <img
                                    src="{{ asset('storage/' . $media->file_path) }}"
                                    alt="Image"
                                    class="rounded-lg w-full h-auto object-cover cursor-pointer hover:opacity-90 transition-opacity"
                                    onclick="openImageModal(this.src)"
                                >
                            </div>
                        @elseif($media->type === 'video')
                            <div class="video-container">
                                <video
                                    class="w-full h-64 object-cover rounded-lg"
                                    controls
                                    playsinline
                                    data-poster="{{ asset('storage/' . str_replace(['mp4', 'webm', 'ogg'], 'jpg', $media->file_path)) }}"
                                >
                                    <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                                    <p class="text-center text-gray-500 p-4">
                                        Your browser doesn't support HTML5 video.
                                        <a href="{{ asset('storage/' . $media->file_path) }}" class="text-blue-600 hover:underline">Download the video</a> instead.
                                    </p>
                                </video>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
    </div>

    <!-- Footer -->
    <div class="flex justify-between items-center text-sm text-gray-500 pt-4 border-t border-gray-100">
        <div class="flex items-center space-x-4">
            @auth
                <form method="POST" action="{{ url('/idea/' . $idea->id . '/like') }}" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="flex items-center space-x-2 hover:text-red-600 transition-colors group"
                    >
                        <span class="fas fa-heart {{ $idea->isLikedByUser(auth()->id()) ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' }}"></span>
                        <span class="font-medium">{{ $idea->likes }}</span>
                    </button>
                </form>
            @else
                <span class="flex items-center space-x-2">
                    <span class="fas fa-heart text-gray-400"></span>
                    <span class="font-medium">{{ $idea->likes }}</span>
                </span>
            @endauth

            <span class="flex items-center space-x-2">
                <span class="fas fa-comment text-gray-400"></span>
                <span class="font-medium">{{ $idea->comments_count ?? 0 }}</span>
            </span>
        </div>

        <div class="flex items-center space-x-2">
            <span class="fas fa-clock text-gray-400"></span>
            <span>{{ $idea->created_at->diffForHumans() }}</span>
        </div>
    </div>

    @include("shared.comment_box")
</div>

<script>
    function openImageModal(src) {
        // Create modal for image viewing
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75';
        modal.innerHTML = `
        <div class="relative max-w-4xl max-h-full p-4">
            <img src="${src}" class="max-w-full max-h-full object-contain rounded-lg" alt="Full size image">
            <button onclick="this.parentElement.parentElement.remove()" class="absolute top-2 right-2 text-white hover:text-gray-300 text-2xl">×</button>
        </div>
    `;
        modal.onclick = (e) => {
            if (e.target === modal) modal.remove();
        };
        document.body.appendChild(modal);
    }

    const maxFileSize = 10 * 1024 * 1024; // 10MB
    const maxMediaCount = 5;
    let newMediaIndex = {{ $idea->media->count() }};

    // Hàm thêm media mới
    function addNewMedia() {
        const container = document.getElementById('media-container');
        if (container.children.length >= maxMediaCount) {
            alert('Maximum 5 media allowed.');
            return;
        }

        const div = document.createElement('div');
        div.className = 'relative group media-item new-media';
        div.innerHTML = `
            <div class="aspect-video bg-gray-100 border border-dashed border-gray-300 rounded-md flex items-center justify-center overflow-hidden media-preview">
                <span class="text-gray-400 text-sm text-center px-2">Click to upload</span>
            </div>
            <div class="absolute top-1 right-1 flex space-x-1">
                <button type="button" onclick="removeMedia(this)" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">×</button>
            </div>
            <div class="mt-2">
                <label class="block text-xs font-medium text-gray-700 mb-1">Upload</label>
                <input type="file" name="new_media[]" accept="image/*,video/*" onchange="previewNewMedia(this, ${newMediaIndex})" class="text-xs">
            </div>
        `;
        container.appendChild(div);
        newMediaIndex++;
    }

    // Hàm xóa media
    function removeMedia(button) {
        const mediaItem = button.closest('.media-item');
        const existingId = mediaItem.dataset.id;

        if (existingId) {
            // Nếu là media đã tồn tại, thêm input đánh dấu xóa
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'deleted_media_ids[]';
            deleteInput.value = existingId;
            mediaItem.appendChild(deleteInput);

            // Ẩn media item nhưng vẫn giữ trong form để xử lý
            mediaItem.style.display = 'none';
        } else {
            // Nếu là media mới, xóa hoàn toàn
            mediaItem.remove();
        }
    }

    // Hàm thay thế media preview
    function replaceMediaPreview(input, mediaId) {
        const file = input.files[0];
        if (!file) return;

        // Validate file type and size
        if (!validateFile(file)) {
            input.value = '';
            return;
        }

        // Đánh dấu file sẽ được thay thế
        const replaceFlag = document.querySelector(`.media-replace-flag[value="${mediaId}"]`);
        if (replaceFlag) {
            replaceFlag.value = "1";
        }

        // Cập nhật preview
        const previewElement = document.getElementById(`preview-${mediaId}`);
        updatePreview(previewElement, file);
    }

    // Hàm preview media mới
    function previewNewMedia(input, index) {
        const file = input.files[0];
        if (!file) return;

        // Validate file
        if (!validateFile(file)) {
            input.value = '';
            return;
        }

        // Cập nhật preview
        const previewDiv = input.closest('.media-item').querySelector('.media-preview');
        previewDiv.innerHTML = '';

        const previewElement = document.createElement(file.type.startsWith('image/') ? 'img' : 'video');
        previewElement.className = 'w-full h-full object-cover';

        if (previewElement.tagName === 'VIDEO') {
            previewElement.muted = true;
            previewElement.playsInline = true;
        }

        previewDiv.appendChild(previewElement);
        updatePreview(previewElement, file);
    }

    // Hàm validate file
    function validateFile(file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4'];

        if (!validTypes.includes(file.type)) {
            alert('Only JPG, PNG, GIF images or MP4 videos are allowed.');
            return false;
        }

        if (file.size > maxFileSize) {
            alert('File must be less than 10MB.');
            return false;
        }

        return true;
    }

    // Hàm cập nhật preview
    function updatePreview(element, file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            if (element.tagName === 'IMG') {
                element.src = e.target.result;
            } else if (element.tagName === 'VIDEO') {
                element.innerHTML = '';
                const source = document.createElement('source');
                source.src = e.target.result;
                source.type = file.type;
                element.appendChild(source);
            }
        };

        reader.readAsDataURL(file);
    }

    // Hàm hủy chỉnh sửa
    function cancelEdit() {
        window.location.reload();
    }

</script>
