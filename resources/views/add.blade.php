{{-- <!-- resources/views/media_upload.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image and Video</title>
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        Dropzone.autoDiscover = false;
    </script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">
    <div class="max-w-2xl w-full mx-auto my-auto bg-white p-6 rounded-xl shadow-md">

@if (session('success'))

        <div 
        x-data="{ show: true }" 
        x-show="show" 
        class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded relative" 
        role="alert"
    >
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button 
            @click="show = false" 
            class="absolute top-2 right-2 text-yellow-700 hover:text-yellow-900"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
@endif

        <h2 class="text-2xl font-bold mb-4">Upload Image and Video</h2>

        <form id="mediaUploadForm" action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title') }}">

                @if ($errors->has('title'))
                    <small class="text-red-600 text-sm mt-1 block">{{ $errors->first('title') }}</small>
                @endif
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Upload Image/Video</label>
                <div id="media-dropzone" class="dropzone border-2 border-dashed border-gray-400 p-6 rounded-lg bg-gray-50"></div>

                @if ($errors->has('file'))
                    <small class="text-red-600 text-sm mt-1 block">{{ $errors->first('file') }}</small>
                @endif

                @if ($errors->has('file.*'))
                    @foreach ($errors->get('file.*') as $messages)
                        @foreach ($messages as $message)
                            <small class="text-red-600 text-sm block">{{ $message }}</small>
                        @endforeach
                    @endforeach
                @endif
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
        </form>
    </div>

    <script>
      const dropzone = new Dropzone("#media-dropzone", {
          url: "{{ route('file.store') }}",
          autoProcessQueue: false,
          uploadMultiple: true,
          parallelUploads: 5,
          maxFilesize: 100,
          acceptedFiles: "image/*,video/*",
          addRemoveLinks: true,
          paramName: "file" 
      });

    
</script>

  
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image and Video</title>
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        Dropzone.autoDiscover = false;
    </script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">
    <div class="max-w-2xl w-full mx-auto my-auto bg-white p-6 rounded-xl shadow-md">

@if (session('success'))

        <div 
        x-data="{ show: true }" 
        x-show="show" 
        class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded relative" 
        role="alert"
    >
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button 
            @click="show = false" 
            class="absolute top-2 right-2 text-yellow-700 hover:text-yellow-900"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
@endif

        <h2 class="text-2xl font-bold mb-4">Upload Image and Video</h2>

        <form id="mediaUploadForm" action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title') }}">

                @if ($errors->has('title'))
                    <small class="text-red-600 text-sm mt-1 block">{{ $errors->first('title') }}</small>
                @endif
            </div>

          
            <!-- Add this inside the <form> -->
{{-- <div>
    <label class="block text-gray-700 font-medium mb-2">Upload Image/Video</label>
    
    <!-- Hidden real input -->
    <input type="file" name="file[]" id="fileInput" multiple class="hidden" />

    <!-- Clickable drop area -->
    <div 
        id="dropzoneArea"
        class="cursor-pointer border-2 border-dashed border-gray-400 p-6 rounded-lg bg-gray-50 text-center hover:bg-gray-100"
        onclick="document.getElementById('fileInput').click()"
    >
        <span class="text-gray-500">Click to select files or drag and drop here</span>
        <div id="filePreview" class="mt-4 space-y-1 text-sm text-gray-700"></div>
    </div>

    @error('file')
        <small class="text-red-600 text-sm mt-1 block">{{ $message }}</small>
    @enderror

    @if ($errors->has('file.*'))
        @foreach ($errors->get('file.*') as $messages)
            @foreach ($messages as $message)
                <small class="text-red-600 text-sm block">{{ $message }}</small>
            @endforeach
        @endforeach
    @endif
</div> --}}

<div>
    <label class="block text-gray-700 font-medium mb-2">Upload Image/Video</label>

    <!-- Hidden file input -->
    <input type="file" name="file[]" id="fileInput" multiple class="hidden" accept="image/*,video/*" />

    <!-- Clickable dropzone -->
    <div 
        id="dropzoneArea"
        class="cursor-pointer border-2 border-dashed border-gray-400 p-6 rounded-lg bg-gray-50 text-center hover:bg-gray-100"
        onclick="document.getElementById('fileInput').click()"
    >
        <span class="text-gray-500">Click to select files or drag and drop here</span>
    </div>

    <!-- Preview Area -->
    <div id="filePreview" class="mt-4 grid grid-cols-6 gap-4"></div>

    @error('file')
        <small class="text-red-600 text-sm mt-1 block">{{ $message }}</small>
    @enderror

    @if ($errors->has('file.*'))
        @foreach ($errors->get('file.*') as $messages)
            @foreach ($messages as $message)
                <small class="text-red-600 text-sm block">{{ $message }}</small>
            @endforeach
        @endforeach
    @endif
</div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
        </form>
    </div>

    {{-- <script>
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const dropzoneArea = document.getElementById('dropzoneArea');
    
        fileInput.addEventListener('change', function () {
            filePreview.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const div = document.createElement('div');
                div.textContent = file.name;
                filePreview.appendChild(div);
            });
        });
    
        // Optional: Drag and Drop support
        dropzoneArea.addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('bg-blue-50');
        });
    
        dropzoneArea.addEventListener('dragleave', function () {
            this.classList.remove('bg-blue-50');
        });
    
        dropzoneArea.addEventListener('drop', function (e) {
            e.preventDefault();
            this.classList.remove('bg-blue-50');
            fileInput.files = e.dataTransfer.files;
    
            // Trigger change event manually
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        });
    </script> --}}


    <script>
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('filePreview');
        let filesList = [];
    
        fileInput.addEventListener('change', function (e) {
            filesList = Array.from(e.target.files);
            previewContainer.innerHTML = '';
    
            filesList.forEach((file, index) => {
                const fileURL = URL.createObjectURL(file);
                const fileType = file.type.split('/')[0]; // image or video
    
                const wrapper = document.createElement('div');
                wrapper.classList.add('relative', 'border', 'rounded', 'overflow-hidden', 'shadow');
    
                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '&times;';
                removeBtn.classList.add('absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'w-6', 'h-6', 'text-xs', 'flex', 'items-center', 'justify-center', 'z-10');
                removeBtn.addEventListener('click', function () {
                    filesList.splice(index, 1);
                    updateFileInput();
                    wrapper.remove();
                });
    
                wrapper.appendChild(removeBtn);
    
                if (fileType === 'image') {
                    const img = document.createElement('img');
                    img.src = fileURL;
                    img.classList.add('w-full', 'h-20', 'object-cover');
                    wrapper.appendChild(img);
                } else if (fileType === 'video') {
                    const video = document.createElement('video');
                    video.src = fileURL;
                    video.controls = true;
                    video.classList.add('w-full', 'h-20', 'object-cover');
                    wrapper.appendChild(video);
                } else {
                    const text = document.createElement('p');
                    text.textContent = file.name;
                    wrapper.appendChild(text);
                }
    
                previewContainer.appendChild(wrapper);
            });
    
            updateFileInput();
        });
    
        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            filesList.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }
    </script>
    
    
  
</body>
</html>


