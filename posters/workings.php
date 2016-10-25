<?php
use Zaachi\Image\Filter;
//require 'vendor/autoload.php';
require '../Zaachi/src/Image/Filter.php';
if (isset($_POST['pngimageData'])){

  $filename = $_POST['filename'];
  $img = $_POST['pngimageData'];
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);

  $date = new DateTime();
  $timestamp = $date->getTimestamp();

  $filename = $timestamp . ".png";
  //$filename = "/posters" . "/" . $filename;

  file_put_contents($filename, $data);

  echo $filename;

} else if (isset($_POST['filter'])){

  $filter_name = $_POST['filter'];
  $filename = $_POST['filename'];
  $image = imagecreatefrompng($filename);

  if ($filter_name == "aqua"){
    $filter = (new Filter($image))->aqua();
    $filename = "aqua_" . $filename;
  } else if ($filter_name == "bubbles"){
    $filter = (new Filter($image))->bubbles();
    $filename = "bubbles_" . $filename;
  } else if ($filter_name == "boost"){
    $filter = (new Filter($image))->boost();
    $filename = "boost_" . $filename;
  } else if ($filter_name == "colorise"){
    $filter = (new Filter($image))->colorise();
    $filename = "colorise_" . $filename;
  } else if ($filter_name == "cool"){
    $filter = (new Filter($image))->cool();
    $filename = "cool_" . $filename;
  } else if ($filter_name == "fuzzy"){
    $filter = (new Filter($image))->fuzzy();
    $filename = "fuzzy_" . $filename;
  } else if ($filter_name == "gray"){
    $filter = (new Filter($image))->gray();
    $filename = "gray_" . $filename;
  } else if ($filter_name == "light"){
    $filter = (new Filter($image))->light();
    $filename = "light_" . $filename;
  } else if ($filter_name == "old"){
    $filter = (new Filter($image))->old();
    $filename = "old_" . $filename;
  } else if ($filter_name == "real old"){
    $filter = (new Filter($image))->old2();
    $filename = "old2_" . $filename;
  } else if ($filter_name == "really old"){
    $filter = (new Filter($image))->old3();
    $filename = "old3_" . $filename;
  } else if ($filter_name == "sepia"){
    $filter = (new Filter($image))->sepia();
    $filename = "sepia_" . $filename;
  }

  //header('Content-type: image/png');

  imagepng($filter->getImage(), $filename);

  echo $filename;

  imagedestroy($image);

} else if (isset($_POST['download'])){
  $bg = $_POST['filename'];
  $file_path = realpath(__DIR__ . '/..') . "/img/y.png";
  $dst_file_path = "final_" . $bg;
  $m_bg = imagecreatefromstring(file_get_contents($bg));
  $img_blob = imagecreatefromstring(file_get_contents($file_path));
  list($width, $height) = getimagesize($bg);
  //resize the file first which is bg
  $newWidth = 700;
  $newHeight = 700;
  $tmp = imagecreatetruecolor($newWidth, $newHeight);
  imagecopyresampled($tmp, $m_bg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
  //imagepng($tmp, $bg);
  imagecopy($tmp, $img_blob, 0, 0, 0, 0, $newWidth, $newHeight);
  imagepng($tmp, $dst_file_path);
  imagedestroy($tmp);
  //header('Set-Cookie: fileDownload=true; path=/');
  //header('Cache-Control: max-age=60, must-revalidate');
  //header("Content-type: text/csv");
  //header('Content-Type:' . mime_content_type ($dst_file_path));
  echo $dst_file_path;
} else if (isset($_GET['download_x'])){
  $dst_file_path = $_GET['filename'];;
  downloadFile($dst_file_path);
}

function downloadFile($dst_file_path){
  ob_clean();
  ob_start();
  //header("Content-Transfer-Encoding: binary");
  header('Content-Type:' . mime_content_type ($dst_file_path));
  header("Content-Transfer-Encoding: binary");
  //header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename=CJ_Display_picture.png');
  header('Expires: 0');
  header('Pragma: no-cache');
  //header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
  header('Content-Length: ' . filesize($dst_file_path));
  readfile($dst_file_path);
  //exit($dst_file_path);
  //exit();
  ob_flush();
}

?>
