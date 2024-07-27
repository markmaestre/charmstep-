<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/courierr.jpeg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Nunito', sans-serif;
            color: #333;
        }
        
        .search-container {
            text-align: center;
            margin: 20px auto;
            position: relative;
            width: 100%;
            max-width: 400px;
        }
       
        #search {
            padding: 12px;
            width: 100%;
            border: 2px solid #ccc;
            border-radius: 50px;
            font-size: 16px;
            transition: border 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #search:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }
        
        #search-results {
            list-style-type: none;
            padding: 0;
            margin: 0;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background: #fff;
            position: absolute;
            z-index: 1000;
            width: 100%;
            left: 0;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            display: none;
        }
        #search-results li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background 0.2s;
        }
        #search-results li:hover {
            background-color: #f0f0f0;
        }
        #search-results li:last-child {
            border-bottom: none;
        }
        .items-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 20px; 
            padding: 20px; 
        }
        .item-card {
            background-color: #fff; 
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 250px; 
            transition: transform 0.3s;
        }
        .item-card:hover {
            transform: scale(1.02); 
        }
        .card-banner img {
            width: 100%;
            height: 200px; 
            object-fit: cover;
        }
        .card-content {
            padding: 15px; 
        }
        .card-price {
            font-weight: bold; 
            color: #007BFF; 
        }
       
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }
     
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .pagination button {
            border: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .pagination button:hover {
            background-color: #0056b3;
        }
        .pagination .active {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<header class="header" data-header>
    <div class="container">
        <div class="overlay" data-overlay></div>
        <a href="#" class="logo"><h1>Charmstep</h1></a>
        <nav class="navbar" data-navbar>
            <ul class="navbar-list">
                <li><a href="#home" class="navbar-link" data-nav-link>Home</a></li>
                <li><a href="#new-items" class="navbar-link" data-nav-link>New Items</a></li>
                <li><a href="#old-items" class="navbar-link" data-nav-link>Old Items</a></li>
                <li><a href="about_us.php" class="navbar-link" data-nav-link>About us</a></li>
                <li><a href="#More" class="navbar-link" data-nav-link>More</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <a href="admin/login" class="btn" aria-labelledby="aria-label-txt"><span id="aria-label-txt">ADMIN</span></a>
            <a href="login" class="btn user-btn" aria-label="Profile">
                <ion-icon name="person-outline"></ion-icon>
            </a>
            <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
                <span class="one"></span>
                <span class="two"></span>
                <span class="three"></span>
            </button>
        </div>
    </div>
</header>

<main>
    <article>
        <section class="section hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <h1 class="align">Charmstep</h1>
                    <p class="paragraph">Elevate Your Stride, Enchant Your Journey with Charmstep</p>
                </div>
            </div>
        </section>


        <div class="search-container">
            <input type="text" id="search" placeholder="Search for items..." />
            <ul id="search-results"></ul>
        </div>


        <section class="section new-items" id="new-items">
            <div class="container">
                <h2 class="h2 section-title" style="color:red">New Items</h2>
                <div class="items-container" id="new-items-container">
                    @foreach ($newItems as $item)
                        <div class="item-card">
                            <figure class="card-banner">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">{{ $item->product_name }}</h3>
                                <p class="card-text">{{ $item->description }}</p>
                                <p class="card-price">${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination" id="new-items-pagination"></div>
            </div>
        </section>


        <section class="section old-items" id="old-items">
            <div class="container">
                <h2 class="h2 section-title" style="color:red">Old Items</h2>
                <div class="items-container" id="old-items-container">
                    @foreach ($oldItems as $item)
                        <div class="item-card">
                            <figure class="card-banner">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">{{ $item->product_name }}</h3>
                                <p class="card-text">{{ $item->description }}</p>
                                <p class="card-price">${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination" id="old-items-pagination"></div>
            </div>
        </section>
    </article>
</main>


<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalProductName"></h2>
        <p id="modalProductDescription"></p>
        <p id="modalProductPrice"></p>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
$(document).ready(function() {
    const itemsPerPage = 4; 

    function paginateItems(containerId, paginationId) {
        const items = $(`#${containerId} .item-card`);
        const totalItems = items.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        items.hide();

      
        for (let i = 1; i <= totalPages; i++) {
            $(`#${paginationId}`).append(`<button class="page-btn" data-page="${i}">${i}</button>`);
        }

      
        showPage(1, containerId);

       
        $(`#${paginationId}`).on('click', '.page-btn', function() {
            const page = $(this).data('page');
            showPage(page, containerId);
           
            $(`#${paginationId} .page-btn`).removeClass('active');
            $(this).addClass('active');
        });
    }

    function showPage(page, containerId) {
        const items = $(`#${containerId} .item-card`);
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

   
        items.hide().slice(start, end).show();
    }

   
    paginateItems('new-items-container', 'new-items-pagination');
    paginateItems('old-items-container', 'old-items-pagination');

    $('#search').on('keyup', function() {
        let query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#search-results').empty();
                    $('#search-results').show(); 
                    $.each(data, function(index, item) {
                        $('#search-results').append(
                            `<li data-item-id="${item.item_id}" data-item-name="${item.product_name}" data-item-description="${item.description}" data-item-price="${item.price}">${item.product_name} - $${item.price}</li>`
                        );
                    });
                }
            });
        } else {
            $('#search-results').hide(); 
        }
    });

  
    $(document).on('click', '#search-results li', function() {
        const itemName = $(this).data('item-name');
        const itemDescription = $(this).data('item-description');
        const itemPrice = $(this).data('item-price');

        $('#modalProductName').text(itemName);
        $('#modalProductDescription').text(itemDescription);
        $('#modalProductPrice').text(`Price: $${itemPrice}`);
        $('#productModal').show(); 
    });

  
    $(document).click(function(event) {
        if (!$(event.target).closest('.search-container').length) {
            $('#search-results').hide();
        }
    });


    $('.close').on('click', function() {
        $('#productModal').hide();
    });

 
    $(window).on('click', function(event) {
        if ($(event.target).is('#productModal')) {
            $('#productModal').hide();
        }
    });
});
</script>
</body>
</html>
    