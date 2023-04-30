<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
require APP_PATH . 'landlord-review.php'
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <title>評論房東 | 看房網</title>
</head>
<?php require PARTIAL_PATH . 'navbar.php'; ?>
<div class="max-w-screen-lg min-h-full mx-auto">
  <div class="w-full mt-32 flex flex-col items-center justify-center">
    <form class="max-w-md w-full mx-auto space-y-4" action="./landlord-review.php" method="POST">
      <div class="text-center">
        <sapn class="text-gray-700 text-xl font-bold">評論房東</span>
      </div>
      <?php if ($success): ?>
      <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="text-sm">房東評論成功！</p>
      </div>
      <?php endif; ?>
      <?php if (isset($alert)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">錯誤</strong>
          <span class="block sm:inline"><?= $alert ?></span>
        </div>
      <?php endif; ?>
      <div>
        <label for="landlord" class="text-gray-600 font-bold">選擇房東</label>
        <select name="landlord" id="landlord"
          class="form-select appearance-none block w-full px-3 mt-4 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
          <?php foreach ($landlords as $landlord): ?>
            <?php print_r($landlord); ?>
            <option value="<?=$landlord['id']?>"><?=$landlord['name']?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="content" class="text-gray-600 font-bold">評論內容</label>
        <textarea class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="content" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
              id="content" required></textarea>
      </div>
      <div>
        <button type="submit" class="mb-2 w-full inline-block px-6 py-2 bg-blue-600 text-white font-medium leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">送出</button>
      </div>
    </form>
    <?php if ($landlord_review): ?>
      <div class="text-center">
        <sapn class="text-gray-700 text-xl font-bold">評論紀錄</span>
      </div>
    <?php endif; ?>
    <div class="w-full mx-auto">
      <?php foreach($landlord_review as $review): ?>
        <div class="my-2">
          <span class="text-xs text-gray-500"><?=date('Y-m-d H:i', strtotime($review['created_at']))?></span> 評論房東 <span class="font-bold"><?=$review['name']?></span><br> <?=$review['content']?><br>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
  $('#region').on('change', function () {
    this.form.submit();
  });
</script>