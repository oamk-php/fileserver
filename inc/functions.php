<?php
function returnError(string $message): void {
  header('HTTP/1.1 500 Internal Server Error');
  $error = array('error' => $message);
  echo json_encode($error);
  exit;
}