<?php
require_once './core/init.php'; 
$mydate=getdate(date("U")); 
function template_header($title) {
  
echo <<<EOT
<!DOCTYPE html>
<html lang="en">
  <head>
      <title>$title</title>      
  </head>
EOT;
}
?><!doctypehtml>
<html lang=en xml:lang=en>
  <meta charset=utf-8>
  <meta charset=utf-8>
  <meta content=Inforsen name=author>
  <meta content=#fff name=theme-color>
  <meta content="IE=edge"http-equiv=X-UA-Compatible>
  <meta content=#fff name=msapplication-TileColor>
  <meta content=#fff name=msapplication-navbutton-color>
  <meta content=#fff name=apple-mobile-web-app-status-bar-style>
  <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"name=viewport>
  <meta content=en http-equiv=Content-Language>
  <link href=""rel=canonical>
  <link href=http://.com/ rel=alternate hreflang=en-ke>
  <link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css rel=stylesheet>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel=stylesheet>
  <meta content=""name=description>
  <meta content=""name=keywords>
  <meta content=""name=twitter:card>
  <meta content=""name=twitter:title>
  <meta content=""name=twitter:description>
  <meta content=images/icons/logo.png name=twitter:image>
  <meta content=""name=twitter:image:alt>
  <meta content=""property=og:url>
  <meta content=article property=og:type>
  <meta content=""property=og:title>
  <meta content=""property=og:description>
  <meta content=images/icons/Logo.png property=og:image>
  <script src=https://kit.fontawesome.com/a313665787.js crossorigin=anonymous></script>
  <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js></script>
  <link href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.css rel=stylesheet>
  <link href=images/icons/Logo.png rel=icon type=image/png>
  <link href="assets/css/style.min.css?v=<?php echo time()?>"rel=stylesheet>
  <link href="assets/css/responsive.min.css?v=<?php echo time()?>"rel=stylesheet>
  <link href="layerslider/css/layerslider.css?v=<?php echo time()?>"rel=stylesheet>
  <meta content=noindex name=robots>
  <script>window.console=window.console||function(o){}</script>
  <header id=menu-area>
    <div class=container>
      <div class=logo_container>
         <div class=logo_img>
          <img src=images/Logo.png>
        </div>
          <div class=banner_none>
            <span id=menuApp onclick=opeNav()>
              <i class="fa fa-sliders"></i>
            </span>
          </div>
          <div class=logo_menu id=Demo>
            <ul>
              <li class="active login">
                <a href="">Login</a>
                <li class=register>
                  <a href="">Register</a>
                </ul>
              </div>
            </div>
          </div>
        </header>