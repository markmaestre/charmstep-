<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/boxicons/2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/clock.css') }}">
    <style>
    
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar header {
            text-align: center;
            padding: 20px 0;
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .menu-links {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        .menu-links li {
            margin-bottom: 10px;
        }
        .menu-links li a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }
        .menu-links li a:hover {
            background-color: #495057;
        }
        .menu-links li a .bx {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .search-box {
            margin-bottom: 10px;
        }
        .search-box input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .bottom-content {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px;
            background-color: #343a40;
            color: #fff;
            border-top: 1px solid #495057;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .bottom-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }
        .bottom-content ul li {
            margin-bottom: 10px;
        }
        .btn-logout {
            width: 100%;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }

   
        .notification-area {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            display: none;
            z-index: 1100;
        }
        .notification-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .notification-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .notification-item {
            padding: 5px 0;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
    
</head>
<body>

<div class="container">
    <nav class="sidebar">
        <header>
            <div class="logo-text">Charmstep</div>
        </header>
        <div class="menu-bar">
            <ul class="menu-links">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" id="searchInput" oninput="filterMenu()" placeholder="Search...">
                </li>
                <li class="nav-link">
                    <a href="profile">
                        <i class='bx bx-edit icon'></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/seller/product">
                        <i class='bx bx-cart icon'></i>
                        <span>Product</span>
                    </a>
                </li>
            
                <li class="nav-link">
                    <a href="/seller/checkouts">
                        <i class='bx bx-history icon'></i>
                        <span>Order History</span>
                    </a>
                </li>
      
            </ul>
        </div>
        <div class="bottom-content">
            <ul>
                <li>
                    @auth
                        @if(Auth::user()->role == 'seller')
                            <span>Logged in as Seller: {{ Auth::user()->name }}</span>
                        @else
                            <span>Logged in as User: {{ Auth::user()->name }}</span>
                        @endif
                    @endauth
                </li>
                <li>
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-logout">Logout</button>
                        </form>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>

    <div class="notification-area" id="notificationArea">
        <div class="notification-header">
            <i class='bx bxs-bell icon'></i>
            <span>Notifications</span>
            <i class='bx bx-x close-icon' onclick="toggleNotificationArea()"></i>
        </div>
        <ul class="notification-list" id="notificationList"></ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-logout').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                $('#logout-form').submit();
            }
        });
    });
</script>

</body>
</html>
