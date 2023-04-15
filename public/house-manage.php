<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
require APP_PATH.'house-manage.php';
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <title>房屋管理｜找好屋</title>
</head>
<body>
  <div class="min-h-screen flex">
    <?php require PARTIAL_PATH . 'sidebar.php'; ?>
    <div class="w-full px-4 h-screen overflow-y-scroll">
      <div class="w-full flex justify-between items-center">
        <span class="text-gray-600 font-bold text-2xl">我刊登的房屋</span>
        <a href="./create-house.php"><button type="button"
          class="mt-2 first-line:text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">新增房屋</button>
        </a>
      </div>
      <div class="flex flex-col gap-4 h-min-screen mb-4">
        <?php if (count($houses) > 0): ?>
        <?php foreach ($houses as $house): ?>
        <a href="edit-house.php?id=<?= $house['id'] ?>" class="w-full border-2 border-b-4 border-gray-200 rounded-xl hover:bg-gray-50 overflow-hidden">
          <div class="flex flex-row">
            <div class="flex-none w-56 h-48">
              <img src="<?= $house['images'][0] ?>" class="w-full h-full object-cover" />
            </div>
            <div class="ml-2 mt-2">
              <p class="text-gray-600 font-bold text-lg"><?= $house['title'] ?></p>
              <p class="text-gray-400"><?= $house['subtitle'] ?></p>
              <p class="text-gray-400"><?= $house['region'] ?></p>
              <p class="text-gray-400"><?= '$'.number_format($house['rent']) ?></p>
              <p class="text-gray-400"
                style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?= $house['description'] ?></p>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
        <?php else: ?>
          <span class="text-gray-600">你還沒有刊登任何房屋。點擊「<a href="./create-house.php" class="text-blue-500 hover:text-blue-700">新增房屋</a>」立即刊登！</span>
        <?php endif; ?>
      </div>
    </div>  
  </div>
</body>