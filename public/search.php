<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
session_start();
require APP_PATH . 'search.php'
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <link href="./static/css/slide.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <title><?= $_GET['region'] ?> 的搜尋結果 | 看房網</title>
</head>
<?php require PARTIAL_PATH . 'navbar.php'; ?>
<div class="h-24"></div>
<?php if (isset($_GET['region'])): ?>
<div class="max-w-screen-lg mx-auto">
  <span class="ml-2 font-bold"><?= $_GET['region'] ?></span> 的搜尋結果：
</div>
<?php endif; ?>
<div class="max-w-screen-lg mx-auto flex flex-wrap mb-4">
  <?php if (isset($houses) && count($houses) > 0): ?>
  <?php foreach($houses as $house): ?>
  <div class="p-2">
    <a href="./house.php?id=<?= $house['id'] ?>">
      <div class="max-w-xs rounded overflow-hidden shadow-lg">
        <img class="w-full h-64 object-cover" src="<?= $house['images'][0] ?>" alt="Sunset in the mountains">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2 truncate "><?= $house['title'] ?></div>
          <p class="text-gray-700 text-base"
            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
            <?= $house['description'] ?>
          </p>
        </div>
        <div class="px-6 pt-2 pb-2">
          <span
            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><?= $house['rent'] ?></span>
        </div>
      </div>
    </a>
  </div>
  <?php endforeach; ?>
  <?php else: ?>
    <span class="ml-2">沒有找到符合的結果</span>
  <?php endif; ?>
</div>

<script>
  $('#region').on('change', function () {
    this.form.submit();
  });
</script>