<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
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
            padding-top: 20px;
        }
        .sidebar header {
            text-align: center;
            padding: 10px 0;
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
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
            padding: 12px 20px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }
        .menu-links li a:hover {
            background-color: #495057;
            border-left: 4px solid #198754; /* Highlight on hover */
        }
        .menu-links li a .bx {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .search-box {
            margin-bottom: 20px;
            padding: 0 20px;
        }
        .search-box input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .bottom-content {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px 20px;
            background-color: #343a40;
            color: #fff;
            border-top: 1px solid #495057;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-logout {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        /* Notification area */
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
        <div class="search-box">
            <input type="text" id="searchInput" oninput="filterMenu()" placeholder="Search...">
        </div>
        <ul class="menu-links">
            <li>
                <a href="profile">
                    <i class='bx bx-edit icon'></i>
                    <span>Edit Profile</span>
                </a>
            </li>
            <li>
                <a href="/shop">
                    <i class='bx bx-cart icon'></i>
                    <span>Order</span>
                </a>
            </li>
            <li>
                <a href="/cart">
                    <i class='bx bx-history icon'></i>
                    <span>Order Cart</span>
                </a>
            </li>
            <li>
                <a href="/checkout/history">
                    <i class='bx bx-history icon'></i>
                    <span>Order History</span>
                </a>
            </li>
            <li>
                <a href="/reviews">
                    <i class='bx bx-star icon'></i>
                    <span>Reviews & Ratings</span>
                </a>
            </li>
            <li>
                <a href="wishlist">
                    <i class='bx bx-heart icon'></i>
                    <span>Wishlist</span>
                </a>
            </li>
        </ul>
        <div class="bottom-content">
            <div>
                @auth
                    @if(Auth::check())
                        <span>
                            Logged in as {{ Auth::user()->name }} (ID: {{ Auth::user()->id }})
                        </span>
                    @else
                        <span>Not logged in</span>
                    @endif
                @endauth
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
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
