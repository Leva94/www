<?php

function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=90){
		if (!file_exists($src)) return false;
		$size = getimagesize($src);
		 if ($size === false) return false;

	$format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
	$icfunc = "imagecreatefrom" . $format;
	if (!function_exists($icfunc)) return false;

	if($size[0]>=$size[1]) {
		if ($size[0]>=$width){
			$new_width = $width;
			$new_height = ($width*$size[1])/$size[0];
		} elseif($size[1]>=$height) {
			$new_width =  $width; //($height*$size[1])/$size[0];
			$new_height = ($width*$size[1])/$size[0]; // $height;
		} else {
			$new_width = $size[0];
			$new_height = $size[1];
		}
	} else {
		if ($size[1]>=$height){
			$new_width = ($size[0]*$height)/$size[1];;
			$new_height = $height;
		} 
	}
	
	$x_ratio = $width / $size[0];
	$y_ratio = $height / $size[1];


	$isrc = $icfunc($src);
	$idest = imagecreatetruecolor($new_width, $new_height);

	imagefill($idest, 0, 0, $rgb);
	imagecopyresampled($idest, $isrc, 0, 0, 0, 0, 
    $new_width, $new_height, $size[0], $size[1]);

	imagejpeg($idest, $dest, $quality);

	imagedestroy($isrc);
	imagedestroy($idest);
	
	return true;
}
