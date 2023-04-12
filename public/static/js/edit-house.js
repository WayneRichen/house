let unsaved = false;
$(":input").change(function() {
  unsaved = true;
});

$(window).bind('beforeunload', function(){
  if (unsaved) {
    return '';
  }
});

$('input:file').change(function () {
  let fd = new FormData();
  let files = $('#house_img_upload')[0].files[0];
  fd.append('file', files);

  $.ajax({
    url: './image-upload.php',
    type: 'post',
    data: fd,
    contentType: false,
    processData: false,
    success: function(response) {
      if (response != 0) {
        response = JSON.parse(response);
        console.log(response);
        $('#house_img').val(response.file);
      } else {
        alert('系統錯誤，請稍後再試');
      }
    },
  });
});

$('form').submit(function(e) {
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