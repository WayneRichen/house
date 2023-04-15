<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
session_start();
if (isset($_SESSION['user_name'])) {
  header("location:index.php");
}
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
require APP_PATH.'register.php';
if (isset($_POST['type'])) {
  $register = new Register();
  $alert = $register->checkUser();
  if (!$alert) {
    $alert = $register->insertUser();
  }
}
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <title>帳號註冊｜找好屋</title>
</head>
<body>
  <nav class="w-full fixed z-10">
    <div class="w-3/4 mx-auto flex items-center ">
      <a href="./index.php" class="logo">
        <img src="./static/image/logo.png" class="h-28" height="100%">
      </a>
      <span class="text-2xl font-bold">找好屋</sapn>
    </div>
  </nav>
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">帳號註冊</h2>
      <form class="mt-8 space-y-6" action="./register.php" method="POST">
        <div class="max-w-screen-lg mx-auto text-center flex justify-center items-center">
          <span>您是...</span>
          <input type="radio" id="type1" name="type" value="tenant" class="ml-8" required>
          <label for="type1" class="text-gray-600 font-bold">房客</label>
          <input type="radio" id="type2" name="type" value="landlord" class="ml-8">
          <label for="type2" class="text-gray-600 font-bold">房東</label>
        </div>
        <?php if (isset($alert)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">錯誤</strong>
          <span class="block sm:inline"><?= $alert ?></span>
        </div>
        <?php endif; ?>
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email-address" class="text-gray-600 font-bold">電子郵件地址</label>
            <input id="email-address" name="email" type="email" autocomplete="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
          <div class="pt-2">
            <label for="password" class="text-gray-600 font-bold">密碼</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
          <div class="pt-2">
            <label for="name" class="text-gray-600 font-bold">姓名</label>
            <input id="name" name="name" type="text" autocomplete="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
          <div class="pt-2">
            <label for="phone" class="text-gray-600 font-bold">電話</label>
            <input id="phone" name="phone" type="text" autocomplete="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          </div>
        </div>
        <div>
          <button type="submit" class="mb-2 w-full inline-block px-6 py-2 bg-blue-600 text-white font-medium leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">會員註冊</button>
        </div>
      </form>
      <a href="./login.php"><button type="button" class="w-full inline-block px-6 py-1.5 border-2 border-blue-600 text-blue-600 font-medium leading-normal uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">會員登入</button></a>
    </div>
  </div>
</body>