<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('PARTIAL_PATH', $root . 'partial' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
session_start();
require APP_PATH . 'chatroom.php'
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./static/css/output.css" rel="stylesheet">
  <script src="./static/js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="./static/js/flowbite.min.css" />
  <title>聯絡房東 | 看房網</title>
</head>
<div class="w-full h-screen">
  <?php require PARTIAL_PATH . 'navbar.php'; ?>
  <!-- component -->
<div>
  <div class="w-full h-32"></div>
    <div class="container mx-auto" style="margin-top: -128px;">
      <div class="pt-6 h-screen">
        <div class="flex border border-grey rounded shadow-lg h-full">
          <div class="w-full border flex flex-col">
              <!-- Messages -->
              <div class="mt-16 flex-1 overflow-auto" style="background-color: #DAD3CC">
                  <div class="py-2 px-3" id="messages">
                      <?php foreach ($messages as $message): ?>
                        <?php if ($message['message_from'] == 'landlord'): ?>
                        <div class="flex mb-2">
                          <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
                            <p class="text-sm text-teal">
                              <?=$message['landlord_name']?>
                            </p>
                            <p class="text-sm mt-1">
                              <?=$message['content']?>
                            </p>
                            <p class="text-right text-xs text-grey-dark mt-1">
                              <?=$message['created_at']?>
                            </p>
                          </div>
                        </div>
                        <?php else: ?>
                        <div class="flex justify-end mb-2">
                          <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                              <p class="text-sm mt-1">
                                <?=$message['content']?>
                              </p>
                              <p class="text-right text-xs text-grey-dark mt-1">
                                <?=$message['created_at']?>
                              </p>
                          </div>
                        </div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                  </div>
              </div>

              <!-- Input -->
              <div class="bg-grey-lighter px-4 py-4 flex items-center">
                  <div class="flex-1 mx-4">
                      <input id="input" class="w-full border rounded px-2 py-2" type="text"/>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./static/js/flowbite.js"></script>
<script>
$('#region').on('change', function () {
  this.form.submit();
});


$('#input').keyup(function(event) {
  if (event.which === 13) {
    let message = $("#input").val();
    $.post("./chat-input.php", { content: message, to_message: <?=$_GET['to_message']?> });
    $("#input").val("");
  }
});

function getMessage() {
  $.post("./chat-get.php", {tenant_id: 2, landlord_id: 1},function(result){
    let messages = JSON.parse(result);
    let div = document.createElement('div');
    messages.forEach(function(message) {
      if (message.message_from == 'landlord') {
        div.innerHTML += '<div class="flex mb-2">' + 
                            '<div class="rounded py-2 px-3" style="background-color: #F2F2F2">' +
                              '<p class="text-sm text-teal">' +
                                message.landlord_name +
                              '</p>' +
                              '<p class="text-sm mt-1">' +
                                message.content +
                              '</p>' +
                              '<p class="text-right text-xs text-grey-dark mt-1">' +
                                message.created_at +
                              '</p>' +
                            '</div>' +
                          '</div>';
      } else {
        div.innerHTML += '<div class="flex justify-end mb-2">' + 
                            '<div class="rounded py-2 px-3" style="background-color: #E2F7CB">' +
                              '<p class="text-sm mt-1">' +
                                message.content +
                              '</p>' +
                              '<p class="text-right text-xs text-grey-dark mt-1">' +
                                message.created_at +
                              '</p>' +
                            '</div>' +
                          '</div>';
      }
    });
    $('#messages').html(div);
  });
}

setInterval(getMessage, 1000);
</script>