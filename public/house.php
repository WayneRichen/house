<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
session_start();
require APP_PATH . 'house.php'
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="./static/js/flowbite.min.css" />
  <title><?= $house['title'] ?> | 看房網</title>
</head>
<div class="w-full h-screen">
  <?php require PARTIAL_PATH . 'navbar.php'; ?>
  <div class="max-w-screen-lg mx-auto mb-4 py-24">
    <div class="min-w-max overflow-hidden mx-auto my-2">
      <img src="<?= $house['images'][0] ?>" class="w-1/2 mx-auto">
    </div>
    <span class="text-3xl font-bold text-gray-700"><?= $house['title'] ?></span>
      <p class="text-xl text-gray-700"><?= $house['subtitle'] ?>
      <p class="mt-2 whitespace-pre-line	"><?= $house['description'] ?></p>
  </div>
  <div class="fixed bottom-0 w-full h-16 bg-white shadow-inner">
    <div class="max-w-screen-lg mx-auto h-full flex justify-end items-center">
      <span class="text-lg font-bold mr-4 text-red-600"><?= $house['rent'] ?>&nbsp;&frasl;&nbsp;一個月</span>
      <?php if ($house['vr_url']): ?>
      <a href="<?= $house['vr_url'] ?>" target="_blank"><button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-bold text-lg rounded-lg px-5 py-2.5 text-center mr-2">VR 線上看房</button></a>
      <?php endif; ?>
      <button type="button" data-tooltip-target="tooltip-default" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center ml-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">聯絡房東</button>
      <div id="tooltip-default" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
        房東姓名：<?= $house['landlord_name'] ?><br>房東手機：<?= $house['landlord_phone'] ?><br>房東 Email：<?= $house['landlord_email'] ?>
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>
    </div>
  </div>
</div>

<script src="./static/js/flowbite.js"></script>
<script>
const targetEl = document.getElementById('tooltip-default');
const triggerEl = document.getElementById('tooltipButton');

// options with default values
const options = {
  placement: 'bottom',
  triggerType: 'hover',
  onHide: () => {
      console.log('tooltip is shown');
  },
  onShow: () => {
      console.log('tooltip is hidden');
  }
};
$('#region').on('change', function () {
  this.form.submit();
});
</script>