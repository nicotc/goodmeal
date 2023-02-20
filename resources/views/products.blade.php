<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="GoodMeal" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="theme-color" content="#FF18A6" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <title>GoodMeal</title>

    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-icons.css" />

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="css/app.css" />

    <!-- Web App Manifest -->
    <!-- <link rel="manifest" href="manifest.json" /> -->
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
      <div class="container">
        <!-- Header Content -->
        <div
          class="header-content header-style-five position-relative d-flex align-items-center justify-content-between"
        >
          <!-- Logo Wrapper -->
          <div class="logo-wrapper">
            <a href="/home"><i class="bi bi-arrow-left"></i></a>
          </div>
        </div>
        <!-- # Header Five Layout End -->
      </div>
    </div>
    <div class="page-content-wrapper p-0">
      <div class="position-relative">
        <img class="card-img-top" src="img/bg-img/1.jpg" />
        <img class="position-absolute logo-company rounded-circle top-50" src="img/logo.png">
      </div>
      <div class="container market-detail">
        <h2>Acerca de la tienda</h2>
        <ul>
          <li><i class="bi bi-geo-alt-fill"></i> Av. nueva los leones 50</li>
          <li><i class="bi bi-clock-fill"></i> Horario de retiro: Hoy de 09:00 a 21:00 hrs.</li>
          <li>Clasificación 4.4/5.0</li>
        </ul>
        <div class="minimal-tab mt-3">
          <ul class="nav nav-tabs mb-3" id="tabsHome" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="btn active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">Ver todo</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn" id="snacks-tab" data-bs-toggle="tab" data-bs-target="#snacks" type="button" role="tab" aria-controls="snacks" aria-selected="false">Snacks</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn" id="lacteos-tab" data-bs-toggle="tab" data-bs-target="#lacteos" type="button" role="tab" aria-controls="lacteos" aria-selected="false">Lácteos y quesos</button>
            </li>
          </ul>
          <div class="tab-content rounded-lg" id="tabsHomeContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
              <div class="top-products-area">
                <div class="container">
                  <div class="row g-3">
                    <!-- Single Top Product Card -->
                    <div class="col-6 col-sm-4 col-lg-3 p-0">
                      <div class="card single-product-card">
                        <div class="card-body p-3 position-relative">
                          <a class="product-thumbnail d-block" href="page-shop-details.html"><img src="img/bg-img/p1.jpg" alt=""></a>
                          <p class="sale-price">$4.000<span>$8.000</span></p>
                          <span class="badge bg-warning">50% de dcto</span>
                          <a class="product-title d-block" href="page-shop-details.html">Pack 10 Mix Almendras Pasas y Maní</a>
                          <a class="add-product" href="#">
                            <i class="bi bi-cart-plus-fill"></i>
                          </a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="snacks" role="tabpanel" aria-labelledby="snacks-tab">

            </div>
            <div class="tab-pane fade" id="lacteos" role="tabpanel" aria-labelledby="lacteos-tab">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer Nav -->
    <div class="footer-nav-area footer-nav-area-market" id="footerNav">
      <div class="container px-0">
        <!-- Footer Content -->
        <div class="d-grid gap-2 d-md-block">
          <button class="btn btn-primary d-md-block">Comprar</button>
        </div>
      </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/internet-status.js"></script>
    <script src="js/index.js"></script>
    <script src="js/active.js"></script>

    <!-- PWA -->
    <script src="js/pwa.js"></script>
  </body>
</html>
