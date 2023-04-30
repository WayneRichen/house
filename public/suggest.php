<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
require APP_PATH . 'suggest.php'
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <title>給我們的建議 | 看房網</title>
</head>
<?php require PARTIAL_PATH . 'navbar.php'; ?>
<div class="max-w-screen-lg min-h-full flex items-center mx-auto justify-center">
  <form class="max-w-md w-full space-y-4" action="./suggest.php" method="POST">
    <div class="text-center">
      <sapn class="text-gray-700 text-xl font-bold">給我們的建議</span>
    </div>
    <?php if ($success): ?>
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
      <p class="text-sm">我們已收到您的建議！</p>
    </div>
    <?php endif; ?>
    <?php if (isset($alert)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">錯誤</strong>
        <span class="block sm:inline"><?= $alert ?></span>
      </div>
    <?php endif; ?>
    <div>
      <label for="name" class="text-gray-600 font-bold">姓名</label>
      <input id="name" name="name" type="text" required
        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
    </div>
    <div>
      <label for="email" class="text-gray-600 font-bold">電子郵件地址</label>
      <input id="email" name="email" type="email" required
        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
    </div>
    <div>
      <label for="content" class="text-gray-600 font-bold">建議內容</label>
      <textarea class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="content" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
            id="content" required></textarea>
      </div>
    <div>
      <button type="submit" class="mb-2 w-full inline-block px-6 py-2 bg-blue-600 text-white font-medium leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">送出建議</button>
    </div>
  </form>
</div>

<script>
  $('#region').on('change', function () {
    this.form.submit();
  });
</script>