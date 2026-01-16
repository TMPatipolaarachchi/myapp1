<!DOCTYPE html>
<html>
<head>
    <title>Edit Food</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-title h2 {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .form-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-radius: 2px;
        }

        .form-help-text {
            font-size: 0.85rem;
            color: #999;
            margin-top: 0.4rem;
        }

        .current-image {
            margin: 1rem 0;
            padding: 1rem;
            background: #f9f9f9;
            border-radius: 0.75rem;
            border-left: 4px solid #ff6b35;
        }

        .current-image-label {
            font-size: 0.85rem;
            color: #999;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .current-image-preview {
            max-width: 200px;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .image-preview-box {
            border: 2px dashed #ff6b35;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            background: #f9f9f9;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .image-preview-box:hover {
            background: #fff;
            border-color: #f7931e;
        }

        .image-preview-box.has-image {
            border-style: solid;
            padding: 0;
            overflow: hidden;
        }

        .image-preview-box.has-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <h1>🍽️ Restaurant Admin</h1>
    </div>
</header>

<div class="container">
    <a href="{{ route('admin.foods.index') }}" class="back-link">← Back to Foods</a>
    
    <div class="form-container">
        <div class="form-title">
            <h2>✏️ Edit Food Item</h2>
            <p>Update menu item details</p>
        </div>

        <form method="POST" action="{{ route('admin.foods.update', $food) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div>
                <label for="name">Food Name</label>
                <input type="text" id="name" name="name" value="{{ $food->name }}" required>
                <p class="form-help-text">Update the name of your dish</p>
            </div>
            
            <div>
                <label for="price">Price (Rs)</label>
                <input type="number" id="price" name="price" value="{{ $food->price }}" step="0.01" required>
                <p class="form-help-text">Adjust the selling price</p>
            </div>
            
            <div>
                <label>Food Image</label>
                @if($food->image)
                    <div class="current-image">
                        <div class="current-image-label">📸 Current Image</div>
                        <img src="{{ asset('storage/'.$food->image) }}" alt="{{ $food->name }}" class="current-image-preview">
                        <p style="font-size: 0.8rem; color: #666; margin-top: 0.5rem;">{{ $food->image }}</p>
                    </div>
                @endif
                
                <label for="image" style="cursor: pointer;">
                    <p style="color: #ff6b35; font-weight: 600; margin: 1rem 0 0 0;">🔄 Change Image (Optional)</p>
                </label>
                <div class="image-preview-box" id="preview-box">
                    <label for="image" style="cursor: pointer; display: block;">
                        <div>
                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📷</div>
                            <p style="color: #666; margin: 0;">Click to upload new image or drag & drop</p>
                            <p style="color: #999; font-size: 0.85rem; margin: 0.5rem 0 0 0;">Leave empty to keep current image</p>
                        </div>
                    </label>
                </div>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 2rem; padding: 1.1rem;">✨ Save Changes</button>
        </form>
    </div>
</div>

<script>
    const imageInput = document.getElementById('image');
    const previewBox = document.getElementById('preview-box');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewBox.innerHTML = '<img src="' + event.target.result + '" alt="Preview">';
                previewBox.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag & drop
    previewBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        previewBox.style.borderColor = '#f7931e';
        previewBox.style.backgroundColor = '#fff';
    });

    previewBox.addEventListener('dragleave', () => {
        previewBox.style.borderColor = '#ff6b35';
        previewBox.style.backgroundColor = '#f9f9f9';
    });

    previewBox.addEventListener('drop', (e) => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length) {
            imageInput.files = files;
            const event = new Event('change', { bubbles: true });
            imageInput.dispatchEvent(event);
        }
    });
</script>

</body>
</html>
