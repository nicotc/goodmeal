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
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center px-4"><img class="login-intro-img" src="img/logo.png" alt=""></div>
        <!-- Register Form -->
        <div class="register-form mt-4">
          <form action="/home">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Username">
            </div>
            <div class="form-group position-relative">
              <input class="form-control" id="psw-input" type="password" placeholder="Enter Password">
              <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
            </div>
            <button class="btn btn-primary w-100" type="submit">Entrar</button>
          </form>
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
