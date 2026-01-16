<!DOCTYPE html>
<html>
<head>
    <title>Foods Management</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 3rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: #ff6b35;
        }

        .stat-card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-card-value {
            font-size: 2rem;
            font-weight: 700;
            color: #ff6b35;
            margin-bottom: 0.5rem;
            font-family: 'Playfair Display', serif;
        }

        .stat-card-label {
            color: #999;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .foods-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .foods-header h2 {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }

            .stat-card-value {
                font-size: 1.5rem;
            }

            .foods-header {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <h1>🍽️ Restaurant Admin</h1>
        <div>
            <a href="{{ route('admin.profile') }}" class="nav-link">👤 Profile</a>
            <a href="{{ route('logout') }}" class="nav-link" onclick="document.getElementById('logout-form').submit(); return false;">🚪 Logout</a>
        </div>
    </div>
</header>

<div class="container">
    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-icon">🍽️</div>
            <div class="stat-card-value">{{ $foods->count() }}</div>
            <div class="stat-card-label">Items on Menu</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon">💰</div>
            <div class="stat-card-value">Rs. {{ number_format($foods->sum('price'), 0) }}</div>
            <div class="stat-card-label">Total Value</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon">📊</div>
            <div class="stat-card-value">{{ $foods->count() > 0 ? number_format($foods->avg('price'), 0) : 0 }}</div>
            <div class="stat-card-label">Avg Price</div>
        </div>
    </div>

    <!-- Foods List Header -->
    <div class="foods-header">
        <h2>📋 Menu Items</h2>
        <a href="{{ route('admin.foods.create') }}" class="btn btn-primary">➕ Add New Food</a>
    </div>

    <!-- Foods List -->
    @if($foods->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($foods as $food)
            <div class="food-item">
                <img src="{{ asset('storage/'.$food->image) }}" alt="{{ $food->name }}" class="food-item-img">
                <div class="food-item-content">
                    <div class="food-item-name">{{ $food->name }}</div>
                    <div class="food-item-price">Rs. {{ number_format($food->price, 2) }}</div>
                    <div class="food-item-actions">
                        <a href="{{ route('admin.foods.edit', $food) }}" class="btn btn-secondary">✏️ Edit</a>
                        <form method="POST" action="{{ route('admin.foods.destroy', $food) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">🍽️</div>
            <h3 style="color: #1a1a2e; margin-top: 1rem;">No Items Yet</h3>
            <p>Start building your menu by adding your first food item.</p>
            <a href="{{ route('admin.foods.create') }}" class="btn btn-primary" style="margin-top: 1.5rem;">➕ Create First Item</a>
        </div>
    @endif
</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
    @csrf
</form>

</body>
</html>
