<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mediaUpload = document.getElementById('media-upload');
        const mediaPreview = document.getElementById('media-preview');

        mediaUpload.addEventListener('change', function (e) {
            mediaPreview.innerHTML = '';
            mediaPreview.classList.add('hidden');
            if (this.files && this.files.length > 0) {
                mediaPreview.classList.remove('hidden');

                Array.from(this.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'relative group';

                        if (file.type.startsWith('image/')) {
                            previewItem.innerHTML = `
                                <img src="${event.target.result}" alt="Preview" class="w-full h-24 object-cover rounded-md">
                                <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity" onclick="removePreview(this)">
                                    &times;
                                </button>
                            `;
                        } else if (file.type.startsWith('video/')) {
                            previewItem.innerHTML = `
                                <video class="w-full h-24 object-cover rounded-md" controls>
                                    <source src="${event.target.result}" type="${file.type}">
                                </video>
                                <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity" onclick="removePreview(this)">
                                    &times;
                                </button>
                            `;
                        }

                        previewItem.querySelector('button').dataset.fileName = file.name;
                        mediaPreview.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // Drag and Drop handling
        const dropArea = document.querySelector('.border-dashed');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('border-primary-500', 'bg-blue-50');
        }

        function unhighlight() {
            dropArea.classList.remove('border-primary-500', 'bg-blue-50');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            const dataTransfer = new DataTransfer();

            // Thêm tất cả các file từ sự kiện drop vào DataTransfer
            for (let i = 0; i < files.length; i++) {
                dataTransfer.items.add(files[i]);
            }

            // Gán lại files cho input
            mediaUpload.files = dataTransfer.files;

            // Kích hoạt sự kiện change để cập nhật preview
            const event = new Event('change');
            mediaUpload.dispatchEvent(event);
        }

        dropArea.addEventListener('drop', handleDrop, false);

        window.removePreview = function (button) {
            const fileName = button.dataset.fileName;
            const input = document.getElementById('media-upload');

            // Chuyển FileList thành mảng và lọc bỏ file bị xóa
            const filesArray = Array.from(input.files).filter(file => file.name !== fileName);

            const dataTransfer = new DataTransfer();

            // Thêm lại các file còn lại vào DataTransfer
            filesArray.forEach(file => dataTransfer.items.add(file));

            // Cập nhật lại input.files
            input.files = dataTransfer.files;

            // Xóa phần tử preview
            button.parentElement.remove();

            if (input.files.length === 0) {
                mediaPreview.classList.add('hidden');
            }
        };
    });
</script>
<form action="{{ url('/idea') }}" method="POST" class="bg-white shadow-lg rounded-xl p-6 space-y-4" enctype="multipart/form-data">
    @csrf
    <h2 class="text-2xl font-semibold text-orange-700 mb-2 flex items-center">
        <i class="fa-solid fa-fire text-primary-500 mr-2"></i> Do you have a hot news?
    </h2>

    <!-- Idea Textarea -->
    <div>
        <label for="idea" class="block text-sm font-medium text-gray-700 mb-1">Your news</label>
        <textarea
            id="idea"
            name="content"
            rows="4"
            placeholder="..."
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none"
        >{{ old('content') }}</textarea>
    </div>

    <!-- Media Upload Section -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Add Media (Images/Videos)</label>

        <!-- File Input -->
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
                <div class="flex flex-wrap justify-center text-sm text-gray-600">
                    <label for="media-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none">
                        <span>Upload files</span>
                        <input id="media-upload" name="media[]" type="file" class="sr-only" multiple accept="image/*,video/*">
                    </label>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs text-gray-500">
                    PNG, JPG, GIF, MP4 up to 10MB each (max 5 files)
                </p>
            </div>
        </div>

        <!-- Preview Area -->
        <div id="media-preview" class="mt-4 grid grid-cols-3 gap-2 hidden">
            <!-- Preview items will be added here dynamically -->
        </div>
    </div>

    <!-- Submit Button -->
    <div class="text-right">
        <button type="submit"
                class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-6 rounded-lg shadow-md transition duration-200">
            <i class="fas fa-paper-plane mr-2"></i>Share
        </button>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input:</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
