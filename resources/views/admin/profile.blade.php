<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .profile-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            flex-shrink: 0;
        }

        .profile-body {
            flex: 1;
        }

        .profile-card {
            max-width: 650px !important;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 2rem;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .profile-card h2 {
            text-align: center;
            color: #1a1a2e;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }

        .stat-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
            padding: 1.5rem;
            border-radius: 0.75rem;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        .action-buttons .btn {
            flex: 1;
        }

        @media (max-width: 600px) {
            .profile-stats {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="profile-wrapper">

<header>
    <div class="header-container">
        <h1>🍽️ Restaurant Admin</h1>
        <a href="{{ route('logout') }}" class="nav-link" onclick="document.getElementById('logout-form').submit(); return false;">🚪 Logout</a>
    </div>
</header>

<div class="profile-body">
    <div class="container">
        <a href="{{ route('admin.foods.index') }}" class="back-link">← Back to Foods Management</a>
        
        <div class="profile-card">
            <div class="profile-avatar">👤</div>
            <h2>{{ auth()->user()->name }}</h2>
            
            <div class="profile-stats">
                <div class="stat-box">
                    <div class="stat-label">Email</div>
                    <div class="stat-value">{{ auth()->user()->email }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Status</div>
                    <div class="stat-value" style="color: #2ec4b6;">● Active</div>
                </div>
            </div>

            <div class="profile-info">
                <div class="profile-label">📅 Member Since</div>
                <div class="profile-value">{{ auth()->user()->created_at->format('F d, Y') }}</div>
            </div>

            <div class="profile-info">
                <div class="profile-label">⏱️ Account Age</div>
                <div class="profile-value">{{ now()->diffInDays(auth()->user()->created_at) }} days</div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary">📋 Manage Foods</a>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">🚪 Logout</button>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
    @csrf
</form>

</body>
</html>
