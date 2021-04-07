<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$text = filter_input(INPUT_POST,'test',FILTER_SANITIZE_STRING);
if (isset($_FILES['file'])) {
  if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $filename = $_FILES['file']['name'];
    $type = $_FILES['file']['type'];

    if ($type === 'image/png')  {
      $path = 'uploads/' . basename($filename);

      if (move_uploaded_file($_FILES['file']['tmp_name'],$path)) {
        $data = array('filename' => $filename,'type' => $type,'text' => $text);
        echo json_encode($data);
      } else {
        returnError('Error saving file to uploads');
      }
    } else {  
      returnError('Wrong file type');
    }
  } else {
    returnError('Error uploading file');
  }
} else {
  returnError('Image was not uploaded.');
}