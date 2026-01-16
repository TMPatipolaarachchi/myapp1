<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 5rem 0;
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero-section h1 {
            color: white;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: slideDown 0.8s ease-out;
        }

        .hero-section p {
            color: #bbb;
            font-size: 1.2rem;
            margin-bottom: 2rem;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .menu-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .menu-title h2 {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .menu-title h2::after {
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

        .footer-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-top: 4rem;
        }

        .food-count {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<div class="hero-section">
    <div class="container">
        <h1>🍽️ Our Culinary Menu</h1>
        <p>Premium Quality Dishes, Crafted with Excellence</p>
        <a href="{{ route('login') }}" class="btn btn-primary" style="display: inline-block;">✨ Admin Login</a>
    </div>
</div>

<div class="container">
    <div class="menu-title">
        <h2>Explore Our Dishes</h2>
        <p class="food-count">{{ $foods->count() }} Delicious Items Available</p>
    </div>

    @if($foods->count() > 0)
        <div class="grid">
            @foreach($foods as $food)
            <div class="card">
                <img src="{{ asset('storage/'.$food->image) }}" alt="{{ $food->name }}" class="card-img">
                <div class="card-body">
                    <h3 class="card-title">{{ $food->name }}</h3>
                    <p style="color: #666; margin-bottom: 1.25rem;">Premium quality dish crafted with authentic recipes</p>
                    <p class="card-price">Rs. {{ number_format($food->price, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state" style="margin-top: 4rem;">
            <div class="empty-state-icon">🍽️</div>
            <p>No items on menu yet. Check back soon!</p>
        </div>
    @endif
</div>

<div class="footer-section">
    <div class="container">
        <p style="font-size: 1.1rem; margin-bottom: 1rem;">Experience Excellence in Every Bite</p>
        <p style="color: #bbb; font-size: 0.95rem;">© 2024 Premium Restaurant Management System</p>
    </div>
</div>

</body>
</html>
