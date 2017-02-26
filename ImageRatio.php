<?php
require_once('./FPDF/fpdf.php');

class FPDF_ratio extends FPDF {

  function ImageRatio($filename, $x, $y, $photo_width, $photo_height, $extention)
  {
    list($width, $height) = getimagesize($filename);

    $wanted_ratio = $photo_width / $photo_height;
    $image_ratio = $width / $height;

    $new_height = $height;
    $new_width = $width;

    if ($image_ratio > $wanted_ratio) {
      $new_width = $height * $wanted_ratio;
    }
    else if ($image_ratio <= $wanted_ratio) {
      $new_height = $width / $wanted_ratio;
    }

    $image_destination = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($filename);

    $offset_w = round(abs($new_width - $width));
    $offset_h = round(abs($new_height - $height));

    imagecopyresampled($image_destination, $image,
    0, 0,
    $offset_w /2 , $offset_h / 2,
    $width, $height,
    $width, $height);

    if (!is_dir("tmp")) {
      mkdir("tmp");
    }

    imagejpeg($image_destination, "tmp/" . $filename);

    imagedestroy($image_destination);
    imagedestroy($image);

    return $this->Image("tmp/" . $filename,
    $x, $y,
    $photo_width, $photo_height, $extention);
  }

}
