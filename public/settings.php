<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
require APP_PATH.'settings.php';
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
        <span class="text-gray-600 font-bold text-2xl">會員資料修改</span>
      </div>
      <div class="flex flex-col gap-4 h-min-screen mb-4">
      <form class="max-w-md w-full space-y-4" action="./settings.php" method="POST">
        <?php if ($success): ?>
        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
          <p class="text-sm">會員資料修改成功！</p>
        </div>
        <?php endif; ?>
        <?php if (isset($alert)): ?>
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">錯誤</strong>
            <span class="block sm:inline"><?= $alert ?></span>
          </div>
        <?php endif; ?>
        <div>
          <label for="email-address" class="text-gray-600 font-bold">電子郵件地址</label>
          <input id="email-address" name="email" type="email" value="<?= $user['email'] ?>" disabled
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </div>
        <div>
          <label for="password" class="text-gray-600 font-bold">密碼（若不修改則留空）</label>
          <input id="password" name="password" type="password"
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </div>
        <div>
          <label for="name" class="text-gray-600 font-bold">姓名</label>
          <input id="name" name="name" type="text" value="<?= $user['name'] ?>" required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </div>
        <div>
          <label for="phone" class="text-gray-600 font-bold">電話</label>
          <input id="phone" name="phone" type="text" value="<?= $user['phone'] ?>" required
            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
        </div>
        <div>
          <button type="submit" class="mb-2 w-full inline-block px-6 py-2 bg-blue-600 text-white font-medium leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">修改會員資料</button>
        </div>
      </form>
      </div>
    </div>  
  </div>
</body>