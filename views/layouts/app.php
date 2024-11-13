<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="description">
    <meta name="keywords" content="keyword">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Home page</title>
    <link rel="stylesheet" href="/css/main.css">

</head>

<body>
  <div class="app" id="home-page">
    <aside class="app-nav">
      <header class="app-nav-header">
        <span class="app-nav-header--title">Navigation</span>
        <span class="app-nav--hide">
          <button class="icon-button icon-button--dark">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </span>
      </header>

     <nav-component></nav-component>
    </aside>
    <div class="app-main">
      <header class="app-main-header">
        <span class="app-nav-show">
          <button class="icon-button" id="hamburger">
            <i class="fa-solid fa-bars"></i>
          </button>
        </span>

        <h1 class="app-main-header-title">
          <em class="app-main-header-title--emphasis">Shopaholic</em>
          <span>in action</span>
        </h1>
        <nav class="app-main-header-links">
          <a href="#" class="app-main-header-link">
            <span class="icon-button">
              <i class="fa-solid fa-heart"></i>
            </span>
          </a>
          <a href="cart.html" class="app-main-header-link">
            <span class="icon-button fa-solid fa-cart-shopping"> 
            (<span id="total-in-cart">0</span>)</span>
          </a>
          <a href="#!" class="sign-in app-main-header-link">
            <span class="icon-button">
              <i class="fa-solid fa-user"></i>
            </span>
          </a>
        </nav> 
      </header>

      <section class="hero bg-cover bg-center py-5 mt-5" style="background: url(images/bg-banner.jpg);">
        <div class="container py-5 px-4">
            <p>New Inspiration 2024</p>
            <h1>15% off on new season</h1>
            <a href="" class="btn btn-hero">Browse collection</a>
        </div>
      </section>
      <div class="app-main-content">
          <div class="app-content">
            <main class="content">
              <section class="Section" data-section="card">           
               <carousel-component url = 'https://my-json-server.typicode.com/coachjanus/db' site_url="https://coachjanus.github.io"></carousel-component>

                <div class="responsive-container">
                {{ content }}
                </div>
              </section>
            </main>
          </div>
      </div>
      <section class="divider bg-cover bg-center bg-fixed py-5 mt-5" style="background: url(./images/divider-bg.jpg)">
        <div class="divider-container py-5 px-4">
            <p>New actions and events</p>
            <h2>Notify me for events please </h2>
            <a href="" class="btn btn-hero">Subscribe</a>
        </div>
      </section>
    </div>
  </div>
   <div class="app-footer">
    <footer-component></footer-component>
   </div>
    <login-component></login-component>
    <script type="module" src="/js/main.js"></script>
</body>
</html>
