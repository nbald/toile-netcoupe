<?php

$fp = fopen('count.csv', 'w');

$line = array("lat", "lon", "count");
fputcsv($fp, $line);

$i = 1;

foreach ($data as $lon=>$data2) {
	foreach ($data2 as $lat=>$count) {
		$line = array(intval($lat), intval($lon), $count);
		fputcsv($fp, $line);
		echo "$i\t";
		$i++;
	}
}


fclose($fp);
?>
