<?php
// (A) LOAD LIBRARIES
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-content.php";
$contentLib = new Content();

// (B) DO SAVE
$pass = $contentLib->edit($_POST['content_text'], $_POST['content_id']);
echo json_encode([
  "status" => $pass,
  "message" => $pass ? "ok" : $contentLib->error
]);
?>