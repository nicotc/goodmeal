<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="GoodMeal">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#FF18A6">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>GoodMeal</title>

    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="css/app.css">

    <!-- Web App Manifest -->
    <link rel="manifest" href="manifest.json">
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
      <div class="container">
        <!-- Header Content -->
        <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
          <!-- Logo Wrapper -->
          <div class="logo-wrapper"><a href="/home">GoodMeal</a></div>
        </div>
        <!-- # Header Five Layout End -->
      </div>
    </div>
    <div class="page-content-wrapper py-3">
      <div class="container p-3">
        <div class="minimal-tab">
          <ul class="nav nav-tabs mb-3" id="tabsHome" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="btn active" id="instock-tab" data-bs-toggle="tab" data-bs-target="#instock" type="button" role="tab" aria-controls="instock" aria-selected="true">Con stock</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn" id="outstock-tab" data-bs-toggle="tab" data-bs-target="#outstock" type="button" role="tab" aria-controls="outstock" aria-selected="false">Sin stock</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn" id="favorites-tab" data-bs-toggle="tab" data-bs-target="#favorites" type="button" role="tab" aria-controls="favorites" aria-selected="false">Favoritos</button>
            </li>
          </ul>
          <div class="tab-content rounded-lg" id="tabsHomeContent">
            <div class="tab-pane fade show active" id="instock" role="tabpanel" aria-labelledby="instock-tab">
              <div class="card position-relative shadow">
                <div class="position-relative">
                  <img class="card-img-top" src="img/bg-img/1.jpg">
                  <div class="badge bg-primary text-white position-absolute card-badge">Hoy 09:00 - 21:00 hrs</div>
                  <div class="badge bg-secondary text-primary position-absolute card-badge top-2">Retiro o delivery</div>
                  <img class="position-absolute logo-company rounded-circle top-50" src="img/logo.png">
                </div>
                <div id="cardMarket" class="card-body direction-rtl card-market position-relative">
                  <h2>GoodMeal Market</h2>
                  <h3 class="text-primary">Desde $2.400 <span class="text-secondary">$680</span></h3>
                  <ul>
                    <li><i class="bi bi-map-fill"></i> 45 min</li>
                    <li><i class="bi bi-geo-alt-fill"></i> 3.83 km</li>
                  </ul>
                  <div class="position-absolute addcart">
                    10+
                    <i class="bi bi-bag-fill"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="outstock" role="tabpanel" aria-labelledby="outstock-tab">

            </div>
            <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer Nav -->
    @include('partials.footer')
    <!-- All JavaScript Files -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/internet-status.js"></script>
    <script src="js/index.js"></script>
    <script src="js/active.js"></script>

    <!-- PWA -->
    <script src="js/pwa.js"></script>

    <script>
      document.getElementById('cardMarket').addEventListener('click', function () {
        location.href = '/products';
      });
    </script>
  </body>
</html>
