<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
require APP_PATH.'EditHouse.php';
$edit = new EditHouse();
if (isset($_GET['id'])) {
  $house = $edit->getHouse();
}
if (isset($_POST['title'])) {
  $alert = $edit->process();
}
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <title>編輯房屋｜看房網</title>
</head>
<body>
  <div class="min-h-screen flex">
  <?php require PARTIAL_PATH . 'sidebar.php'; ?>
  <div class="w-full px-4 h-screen overflow-y-scroll">
      <div class="w-full flex justify-between items-center mt-4">
        <span class="text-gray-600 font-bold text-2xl">編輯房屋</span>
      </div>
      <?php if (isset($alert)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">錯誤</strong>
          <span class="block sm:inline"><?= $alert ?></span>
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
          </span>
        </div>
      <?php endif; ?>
      <form class="mb-2" action="./edit-house.php<?= '?id='.$_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <div>
          <label class="text-gray-800 font-semibold block my-3 text-md" for="title">標題</label>
          <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="title"
            id="title" value="<?= isset($_POST['title']) ? $_POST['title'] : $house['title'] ?>" required />
        </div>
        <div>
          <label class="text-gray-800 font-semibold block my-3 text-md" for="subtitle">副標題</label>
          <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="subtitle"
            id="subtitle" value="<?= isset($_POST['subtitle']) ? $_POST['subtitle'] : $house['subtitle'] ?>" required />
        </div>
        <div>
          <label class="text-gray-800 font-semibold block my-3 text-md" for="region">地區</label>
          <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="region"
            id="region" value="<?= isset($_POST['region']) ? $_POST['region'] : $house['region'] ?>" required />
        </div>
        <div>
          <label class="text-gray-800 font-semibold block my-3 text-md" for="rent">租金</label>
          <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="rent" id="rent" value="<?= isset($_POST['rent']) ? $_POST['rent'] : $house['rent'] ?>" required />
        </div>
        <div>
          <label class="text-gray-800 font-semibold block mt-3 text-md" for="vr_url">VR 看房網址</label><a class="text-sm text-blue-700" href="./faq.php">如何上傳 VR 環景相片？</a>
          <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="vr_url" id="vr_url" value="<?= isset($_POST['vr_url']) ? $_POST['vr_url'] : $house['vr_url'] ?>" required />
        </div>
        <div>
          <label class="text-gray-800 font-semibold block my-3 text-md" for="description">房屋描述</label>
          <textarea class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="description" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
            id="description" required><?= isset($_POST['description']) ? $_POST['description'] : $house['description'] ?></textarea>
        </div>
        <div>
        <label class="text-gray-800 font-semibold block my-3 text-md" for="house_img">圖片</label>
          <input type="file" class="form-control-file" name="house_img_upload" id="house_img_upload" accept="image/*">
          <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" type="text" name="house_img"
            id="house_img" value="<?= isset($_POST['house_img']) ? $_POST['house_img'] : $house['images'][0] ?>" disabled />
        </div>
        <div>
          <button type="submit" class="w-full my-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">編輯房屋</button>
        </div>
      </form>
      <button class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" onclick="deleteCheck(<?= $_GET['id'] ?>)">刪除房屋</button>
    </div>
  </div>
</body>

<script>
function deleteCheck(id) {
  if (confirm('確定要刪除嗎？')) {
    let fd = new FormData();
    fd.append('id', id);

    $.ajax({
    url: './delete-house.php',
    type: 'post',
    data: fd,
    contentType: false,
    processData: false,
    success: function(response) {
      response = JSON.parse(response);
      if (response.status == 'success') {
        window.location.href = "./house-manage.php";
      }
    },
  });
  }
}
let unsaved = false;
$(":input").change(function() {
  unsaved = true;
});

$(window).bind('beforeunload', function(){
  if (unsaved) {
    return '';
  }
});

$("input:file").change(function (){
  let fd = new FormData();
  let files = $('#house_img_upload')[0].files[0];
  fd.append('file', files);

  $.ajax({
    url: './image-upload.php',
    type: 'post',
    data: fd,
    contentType: false,
    processData: false,
    success: function(response){
      if(response != 0){
        response = JSON.parse(response);
        console.log(response);
        $('#house_img').val(response.file);
      }
      else{
        alert('Upload Failed');
      }
    },
  });
});

$('form').submit(function(e) {
  unsaved = false;
  $(':disabled').each(function(e) {
    $(this).removeAttr('disabled');
  })
});

setInputFilter(document.getElementById("rent"), function(value) {
  return /^\d*$/.test(value); }, "必須是數字");

function setInputFilter(textbox, inputFilter, errMsg) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
    textbox.addEventListener(event, function(e) {
      if (inputFilter(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          this.classList.remove("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        this.classList.add("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  });
}
</script>