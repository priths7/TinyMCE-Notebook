<?php
// (A) GET CONTENT
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-content.php";
$contentLib = new Content();
$id = 1; // CHANGE THIS TO THE CONTENT ID YOU WANT TO FETCH
$content = $contentLib->get($id);

// (B) HTML ?>
<!DOCTYPE html>
<html>
  <body>
    <?php
    echo $content;
  ?>
  </body>
</html>