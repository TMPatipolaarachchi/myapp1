<!DOCTYPE html>
<html>
<head>
    <title>Add New Food</title>
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

        .image-preview {
            margin-top: 1rem;
        }

        .image-preview-box {
            border: 2px dashed #ff6b35;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            background: #f9f9f9;
            transition: all 0.3s ease;
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

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
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
            <h2>➕ Add New Food Item</h2>
            <p>Create a delicious new menu item</p>
        </div>

        <form method="POST" action="{{ route('admin.foods.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div>
                <label for="name">Food Name</label>
                <input type="text" id="name" name="name" required placeholder="e.g., Biryani, Butter Chicken, Naan" value="{{ old('name') }}">
                <p class="form-help-text">Enter an attractive name for your dish</p>
            </div>
            
            <div>
                <label for="price">Price (Rs)</label>
                <input type="number" id="price" name="price" step="0.01" required placeholder="e.g., 250.00" value="{{ old('price') }}">
                <p class="form-help-text">Set the selling price for this item</p>
            </div>
            
            <div>
                <label for="image">Food Image</label>
                <div class="image-preview-box" id="preview-box">
                    <label for="image" class="file-input-label">
                        <div>
                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📷</div>
                            <p style="color: #666; margin: 0;">Click to upload image or drag & drop</p>
                            <p style="color: #999; font-size: 0.85rem; margin: 0.5rem 0 0 0;">Recommended: JPG, PNG (max 5MB)</p>
                        </div>
                    </label>
                    <input type="file" id="image" name="image" required accept="image/*">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 2rem; padding: 1.1rem;">✨ Create Food Item</button>
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
