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
          <div class="logo-wrapper"><a href="#">Mis Órdenes</a></div>
        </div>
        <!-- # Header Five Layout End -->
      </div>
    </div>
    <div class="page-content-wrapper py-3">
      <div class="container p-3">
        <div class="card shadow">
          <div id="cardOrder" class="card-body direction-rtl card-order">
            <h2>25/11/22</h2>
            <ul>
              <li>Tienda: Fork Bilbao</li>
              <li>Nº de orden: 466044</li>
              <li>Monto total: $30.500</li>
              <li>Horario: 09:00 - 16:00 hrs</li>
            </ul>
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
  </body>
</html>
