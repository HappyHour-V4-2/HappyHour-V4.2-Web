<?php
require_once './core/init.php';
$mydate = getdate(date("U"));

function template_header($title)
{
  echo <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="author" content="Inforsen">
  <meta name="theme-color" content="#fff">
  <meta name="msapplication-TileColor" content="#fff">
  <meta name="msapplication-navbutton-color" content="#fff">
  <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
  <meta http-equiv="Content-Language" content="en">
  <link rel="canonical" href="">
  <link rel="alternate" hreflang="en-ke" href="http://.com/">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.css">
  <link rel="icon" type="image/png" href="images/icons/Logo.png">
  <link rel="stylesheet" href="assets/css/style.min.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="assets/css/responsive.min.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="layerslider/css/layerslider.css?v=<?php echo time() ?>">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="twitter:card" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="images/icons/logo.png">
  <meta name="twitter:image:alt" content="">
  <meta property="og:url" content="">
  <meta property="og:type" content="article">
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:image" content="images/icons/Logo.png">
  <script src="https://kit.fontawesome.com/a313665787.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    window.console = window.console || function(o) {}
  </script>
</head>
<body>
  <header id="menu-area">
    <div class="container">
      <div class="logo_container">
        <div class="logo_img">
          <img src="images/Logo.png">
        </div>
        <div class="banner_none">
          <span id="menuApp" onclick="opeNav()">
            <i class="fa fa-sliders"></i>
          </span>
        </div>
        <div class="logo_menu" id="Demo">
          <ul>
            <li class="active login">
              <a href="/HappyHour-web/admin/login.php/">Login</a>
            </li>
            <li class="register">
              <a href="/HappyHour-web/admin/register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
EOT;
}
?>
