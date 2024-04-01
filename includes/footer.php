<footer id=maine-footer>
    <div class=footer-top></div>
    <div class=footer-bottom>
        <div class=footer-inner>
          <span>Copyright ©<?php echo $mydate['month'] ?><?php echo $mydate['mday']; ?>,<?php echo $mydate['year']; ?>HappyHour™. All Rights Reserved.</span></div>
    </div>
</footer>
<script>window.addEventListener("scroll", function() {
        let menuArea = document.getElementById("menu-area");

        if (window.pageYOffset > 200){
          menuArea.classList.add("cus-nav");
        }else{
          menuArea.classList.remove("cus-nav");
        }
      });</script><script>$(document).ready(function(){$("#menuApp").click(function(){$("#Demo").toggle()})})</script></body>
</html>