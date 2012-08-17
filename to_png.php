<?php

$lat_start = 3500;
$lat_stop = 5500;
$lon_start = -1000;
$lon_stop = 2000;

$xsize = $lon_stop-$lon_start;
$ysize = $lat_stop-$lat_start;


$im = imagecreatetruecolor($xsize, $ysize);
$blue = imagecolorallocate($im, 0, 0, 200); 
$white = imagecolorallocate($im, 0, 0, 0); 

$scale[] = imagecolorallocate($im, 255, 255, 217); 
$scale[] = imagecolorallocate($im, 237, 248, 177); 
$scale[] = imagecolorallocate($im, 199, 233, 180); 
$scale[] = imagecolorallocate($im, 127, 205, 187); 
$scale[] = imagecolorallocate($im, 65, 182, 196); 
$scale[] = imagecolorallocate($im, 29, 145, 192); 
$scale[] = imagecolorallocate($im, 34, 94, 168); 
$scale[] = imagecolorallocate($im, 12, 44, 132);




imagefill($im, 0, 0, $white);

$row=0;
if (($handle = fopen("count.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

	$lat = $ysize-(intval($data[0])-$lat_start);
	$lon = intval($data[1])-$lon_start;
	
	$val = $data[2];
	
	$color = 0;
	if ($val < 10): $color=7;
	elseif ($val < 20): $color=6;
	elseif ($val < 50): $color=5;
	elseif ($val < 100): $color=4;
	elseif ($val < 300): $color=3;
	elseif ($val < 600): $color=2;
	elseif ($val < 1000): $color=1;
	else: $color=0;
	endif;

	imagesetpixel($im, $lon, $lat, $scale[$color]);

	echo "$row\t";
        $row++;
    }
    fclose($handle);
}

imagepng($im, "out.png");
imagedestroy($im);

?>