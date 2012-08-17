<?php
$nt=0;
$n=0;
$data = array();
//30700
for ($fi=0; $fi<26801; $fi++) {
  $handle = fopen("2009/$fi.igc", "r");
  if ($handle) {
      while (($line = fgets($handle, 4096)) !== false) {
	  $nt++;

	  if ('B' != substr($line, 0, 1)) continue;

	  $lat_lettre = substr($line, 14, 1);
	  if ('N' != $lat_lettre) continue;

	  $lat_deg = substr($line, 7, 2);
	  $lat_min = substr($line, 9, 4);
	  $lat_min = sprintf("%02d", 1/60*intval($lat_min));
	  $lat = $lat_deg . $lat_min;
	  $lat_deg_int = intval($lat_deg);

	  if ($lat_deg_int < 35 && $lat_deg_int > 55) continue;

	  $lon_deg = substr($line, 16, 2);
	  $lon_min = substr($line, 18, 4);
	  $lon_min = sprintf("%02d", 1/60*intval($lon_min));
	  $lon_lettre = substr($line, 23, 1);
	  $lon = $lon_deg.$lon_min;
	  $lon_deg_int = intval($lon_deg);

	  if ( 'E' == $lon_lettre && $lon_deg_int > 20) continue;
	  if ( 'W' == $lon_lettre ) {
	    if ($lon_deg_int > 10) continue;
	    $lon = '-'.$lon;
	  }

	  if (!array_key_exists($lon, $data) || !array_key_exists($lat, $data[$lon])) {
	    $data[$lon][$lat] = 1;
	  } else {
	    $data[$lon][$lat]++;
	  }


	  // lon : -0999 > 1999 +999
	  // lat : 3500 > 5599 -3500
	  //echo $line;
	  //printf("%s\t%s\t%s\t%s\t%s\t%s\n", $lat_deg, $lat_min, $lon_deg, $lon_min, $lat, $lon);
	  $n++;
      }
      if (!feof($handle)) {
	  echo "Error: unexpected fgets() fail\n";
      }
      fclose($handle);
	echo "$fi\t";
      //printf("%d:\t%d\t%d\t%f\n", $fi, $n, $nt, $n/$nt*100);
  }
}

?>
