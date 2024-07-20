
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
 
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <link rel="stylesheet" href="css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
    rel="stylesheet">

    <style>
       body {
            margin: 0;
            padding: 0;
            background-image: url('images/courierr.jpeg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Your Preferred Font', sans-serif; 
        }

    </style>

</head>

<body>

  

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="#" class="logo">
   <h1>Charmstep</h1>

      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li>
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li>
            <a href="#featured" class="navbar-link" data-nav-link>featured</a>
          </li>

          <li>
            <a href="about_us.php" class="navbar-link" data-nav-link>About us</a>
          </li>

          <li>
            <a href="#More" class="navbar-link" data-nav-link>More</a>
          </li>

        </ul>
      </nav>

      <div class="header-actions">

      

        <a href="admin/login" class="btn" aria-labelledby="aria-label-txt">
         

          <span id="aria-label-txt">ADMIN</span>
        </a>

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
 

         <p class = "paragraph">Elevate Your Stride, Enchant Your Journey with Charmstep</p>
       
          </div>

          <div class="shoes"></div>

          

        </div>
      </section>




      <!-- 
        - #FEATURED
      -->

      <section class="section featured" id="featured">
        <div class="container">

          <div class="title-wrapper">
            <h2 style = "color:red" class="h2 section-title">Featured</h2>

            <a href="#" class="featured-shoes-link">
              <span>View more</span>

              <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
          </div>

          <ul class="featured-shoes-list">

            <li>
              <div class="featured-shoes-card">

                <figure class="card-banner">
                  <img src="images/1.png"  loading="lazy" width="440" height="300"
                    class="w-100">
                </figure>


              </div>
            </li>

            <li>
              <div class="featured-shoes-card">

                <figure class="card-banner">
                  <img src="images/2.png" loading="lazy" width="440" height="300"
                    class="w-100">
                </figure>

                <div class="card-content">

                

                

                </div>

              </div>
            </li>

            <li>
              <div class="featured-shoes-card">

                <figure class="card-banner">
                  <img src="images/3.png" loading="lazy" width="440"
                    height="300" class="w-100">
                </figure>

                <div class="card-content">

          
              

                </div>

              </div>
            </li>

            <li>
              <div class="featured-shoes-card">

                <figure class="card-banner">
                  <img src="images/4.png" loading="lazy" width="440"
                    height="300" class="w-100">
                </figure>

                <div class="card-content">

               


                </div>

              </div>
            </li>

            <li>
              <div class="featured-shoes-card">

                <figure class="card-banner">
                  <img src="images/6.png"  loading="lazy" width="440" height="300"
                    class="w-100">
                </figure>

                <div class="card-content">

                  <div class="card-title-wrapper">
                    <h3 class="h3 card-title">
         
                    </h3>

              

                </div>

              </div>
            </li>

            
            <li>
              <div class="featured-shoes-card">

                <figure class="card-banner">
                  <img src="images/5.png" loading="lazy" width="440" height="300"
                    class="w-100">
                </figure>

                <div class="card-content">

                  <div class="card-title-wrapper">
                    <h3 class="h3 card-title">
        
                    </h3>

                   


                </div>

              </div>
            </li>



          </ul>

        </div>
      </section>
      <!-- 
        - services
      -->
      <section class="section get-start" id="services">
        <div class="container">

          <h2 class="h2 section-title">SERVICES</h2>

          <ul class="get-start-list">

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-1">
                  <ion-icon name="heart"></ion-icon>
                </div>

                <h3 class="card-title">Express Document Delivery:</h3>

                <p class="card-text">
                  Swiftly transports crucial documents to specified destinations, ensuring timely and secure delivery.
                </p>

       

              </div>
            </li>

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-2">
                  <ion-icon name="footsteps-outline"></ion-icon>
                </div>

                <h3 class="card-title"> Delivery:</h3>

                <p class="card-text">
                  Conveniently delivers freshly prepared meals from local restaurants directly to customers' doorsteps, enhancing the dining experience. </p>

              </div>
            </li>

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-3">
                  <ion-icon name="bag-handle-outline"></ion-icon>
                </div>

                <h3 class="card-title">Package Shipping:

                </h3>

                <p class="card-text">
                  Efficiently ships parcels and packages to designated locations, offering reliable and secure delivery services.   </p>

              </div>
            </li>

            <li>
              <div class="get-start-card">

                <div class="card-icon icon-4">
                  <ion-icon name="card-outline"></ion-icon>
                </div>

                <h3 class="card-title">Same-Day Delivery:

                </h3>

                <p class="card-text">
                  Ensures swift receipt of products or services on the same day as the order, providing immediate access for customers in need of prompt delivery. </p>

              </div>
            </li>

          </ul>

        </div>
      </section>

      <section class="section blog" id="More">
        <div class="container">

          <h2 class="h2 section-title">Top features based on reviews</h2>

          <ul class="blog-list has-scrollbar">

            <li>
              <div class="featured-card">
                <figure class="card-banner">
                  <a href="#">
                    <img src="images/featured1.png" loading="lazy"
                      class="w-100">
                  </a>
                  <a href="#" class="btn card-badge">Sneakers</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">HELONG Men Sneakers Luxury Men Shoes Blade Fashion Men Shoes High Top Running Shoes For Men Casual Shoes Sneaker</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2020-05-26">May 26, 2020</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li>
              <div class="featured-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="images/featured2.png" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Nike Air Max 270</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">The Air Max 270 provides more responsive cushioning underfoot with the Nike Air Max cushioning.</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2021-03-14">march 25, 2021</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="233">233</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="featured-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="images/featured3.png" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Air Max </a>

                </figure>
                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Nike Skepta x Air Max Tailwind 5 'Bright Blue'</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="123">123</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="featured-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="images/featured4.png" alt="nike invicible run 3" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">nike invicible run 3</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">the Invincible 3 has our highest level of comfort underfoot.</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-04-31">april 31, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="435">435</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="featured-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="images/featured5.png" alt="Air More Uptempo 96 White Starfish sneakers" loading="lazy"
                      class="w-100">
                  </a>

                  <a href="#" class="btn card-badge">Nike</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Air More Uptempo 96 "White Starfish" sneakers</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>
s
                      <time datetime="2023-01-1">January 1, 2023</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section> 

    </article>
  </main>

  <script src="js/script.js"></script>


  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>

