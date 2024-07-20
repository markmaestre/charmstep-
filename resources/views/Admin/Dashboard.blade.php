<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <style>
        /* Your existing styles */
        .sidebar {
            /* Style your sidebar */
        }
        .user-section {
            text-align: center;
            margin-top: auto;
            padding-bottom: 20px;
        }
        .user-section p {
            margin-bottom: 10px;
            font-weight: bold;
        }
        .nav-links {
            padding: 0;
            margin: 0;
        }
        .nav-links li {
            list-style: none;
        }
        .nav-links li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            padding: 10px;
            transition: all 0.3s ease;
        }
        .nav-links li a:hover {
            background-color: #f0f0f0;
        }
        .nav-links li a .bx {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <section class="sidebar expand">
        <div class="nav-header">
            <p class="logo">Charmstep</p>
            <i class="bx bx-menu btn-menu"></i>
        </div>
        <ul class="nav-links">
            <li>
                <i class="bx bx-search search-btn"></i>
                <input type="text" placeholder="Search..." />
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="/admin/customer">
                    <i class="bx bx-user"></i>
                    <span class="title">User</span>
                </a>
            </li>
            <li>
                <a href="/admin/products">
                    <i class="bx bx-add-to-queue"></i>
                    <span class="title">Product</span>
                </a>
            </li>
            <li>
                <a href="/admin/brands">
                    <i class="bx bx-barcode"></i>
                    <span class="title">Brand Shoes</span>
                </a>
            </li>
            <li>
                <a href="/admin/confirmations/completed">
                    <i class="bx bx-cart"></i>
                    <span class="title">Cart History</span>
                </a>
            </li>
            <li>
                <a href="/admin/charts">
                    <i class="bx bx-dollar"></i>
                    <span class="title">Sales</span>
                </a>
            </li>
            <li>
                <a href="/admin/confirmations">
                    <i class="bx bx-credit-card"></i>
                    <span class="title">Payment</span>
                </a>
            </li>
            <li>
                <a href="/admin/reviews">
                    <i class="bx bx-star"></i>
                    <span class="title">Reviews & Ratings</span>
                </a>
            </li>
            <li>
                <a href="/admin/wishlists">
                    <i class="bx bx-heart"></i>
                    <span class="title">Wishlist</span>
                </a>
            </li>
            <li class="user-section">
                @auth
                    <p>Logged in as: {{ Auth::user()->name }}</p>
                @endauth
            </li>
            <li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="logout-link">
                    <i class="bx bx-log-out"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
        <div class="theme-wrapper">
            <i class="bx bxs-moon theme-icon"></i>
            <p>Dark Theme</p>
            <div class="theme-btn">
                <span class="theme-ball"></span>
            </div>
        </div>
    </section>
    <section class="home">
        <!-- Your home section content -->
    </section>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Your existing script for toggling theme
        const btn_theme = document.querySelector(".theme-btn");
        const theme_ball = document.querySelector(".theme-ball");

        const localData = localStorage.getItem("theme");

        if (localData == null) {
            localStorage.setItem("theme", "light");
        }

        if (localData == "dark") {
            document.body.classList.add("dark-mode");
            theme_ball.classList.add("dark");
        } else if (localData == "light") {
            document.body.classList.remove("dark-mode");
            theme_ball.classList.remove("dark");
        }

        btn_theme.addEventListener("click", function () {
            document.body.classList.toggle("dark-mode");
            theme_ball.classList.toggle("dark");
            if (document.body.classList.contains("dark-mode")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.setItem("theme", "light");
            }
        });

        // Confirm logout using jQuery
        $(document).ready(function() {
            $('.logout-link').click(function(e) {
                e.preventDefault();
                var logoutConfirmed = confirm("Are you sure you want to logout?");
                if (logoutConfirmed) {
                    $('#logout-form').submit();
                }
            });
        });
    </script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
