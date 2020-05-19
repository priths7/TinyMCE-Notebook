<?php
// (A) GET CONTENT
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-content.php";
$contentLib = new Content();
$id = 1; // CHANGE THIS TO THE CONTENT ID YOU WANT TO FETCH
$content = $contentLib->get($id);

// (B) EDIT CONTENT ?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      TinyMCE PHP MySQL Demo
    </title>
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
      // (A) INIT TINYMCE
      // https://www.tiny.cloud/get-tiny/downloads/
      // https://www.tiny.cloud/docs/configure/
      tinymce.init({
        selector : '#content-text',
        plugins : "save",
        menubar : false,
        toolbar: 'save | styleselect | bold italic | alignleft aligncenter alignright alignjustify',
        save_onsavecallback : "save"
      });

      // (B) SAVE FUNCTION
      function save (editor) {
        // APPEND DATA
        var data = new FormData();
        data.append('content_id', document.getElementById("content-id").value);
        data.append('content_text', editor.getContent());

        // AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "4c-save.php", true);
        xhr.onload = function(){
          if (xhr.status==200) {
            var response = JSON.parse(this.response);
            alert(response.message);
          } else { alert("ERROR LOADING 4c-save.php!"); }
        };
        xhr.send(data);
      }
    </script>
  </head>
  <body>
    <input type="hidden" id="content-id" value="<?=$id?>"/>
    <textarea id="content-text"><?=$content?></textarea>
  </body>
</html>