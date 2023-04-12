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
  <title>看房網</title>
</head>
<?php require PARTIAL_PATH . 'navbar.php'; ?>
<div class="w-full min-h-screen">
  <div class="slideshow-container">
    <div class="mySlides fade">
      <img src="./static/image/slide1.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <img src="./static/image/slide2.jpg" style="width:100%">
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