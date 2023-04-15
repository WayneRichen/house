<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
session_start();
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <link href="./static/css/slide.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <title>找好屋</title>
</head>
<?php require PARTIAL_PATH . 'navbar.php'; ?>
<div class="w-full min-h-screen">
  <div class="slideshow-container">
    <div class="mySlides fade">
      <img src="./static/image/background.jpg" style="width:100%">
    </div>
    <div class="absolute mt-10 w-full h-2/3 bottom-0">
      <div class="mx-64 mt-16 p-2 bg-white rounded text-gray-600 font-bold" style="background-color: rgba(255,255,255,0.8);">
        <span class="text-xl text-gray-700">地區快選</span>
        <p>
        台中市：<br>
          <a class="hover:text-amber-600" href="/search.php?region=南屯區">南屯區</a>
          <a class="hover:text-amber-600" href="/search.php?region=烏日區">烏日區</a>
          <a class="hover:text-amber-600" href="/search.php?region=西屯區">西屯區</a>
          <a class="hover:text-amber-600" href="/search.php?region=清水區">清水區</a>
          <a class="hover:text-amber-600" href="/search.php?region=沙鹿區">沙鹿區</a>
          <a class="hover:text-amber-600" href="/search.php?region=大甲區">大甲區</a>
          <a class="hover:text-amber-600" href="/search.php?region=西區">西區</a>
          <a class="hover:text-amber-600" href="/search.php?region=南區">南區</a>
        </p>
        <p class="mt-2">
        台北市：<br>
          <a class="hover:text-amber-600" href="/search.php?region=信義區">信義區</a>
          <a class="hover:text-amber-600" href="/search.php?region=中正區">中正區</a>
          <a class="hover:text-amber-600" href="/search.php?region=萬華區">萬華區</a>
          <a class="hover:text-amber-600" href="/search.php?region=大同區">大同區</a>
          <a class="hover:text-amber-600" href="/search.php?region=中山區">中山區</a>
          <a class="hover:text-amber-600" href="/search.php?region=大安區">大安區</a>
          <a class="hover:text-amber-600" href="/search.php?region=士林區">士林區</a>
          <a class="hover:text-amber-600" href="/search.php?region=北投區">北投區</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
  let slideIndex = 0;
  autoSlides();
  function autoSlides() {
    let slides = document.getElementsByClassName("mySlides");
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(autoSlides, 3000); // Change image every 3 seconds
  }

  $('#region').on('change', function () {
    this.form.submit();
  });
</script>