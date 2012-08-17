<?php
$counts = array();
if (($handle = fopen("count.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	$counts[] = $data[2];
    }
    fclose($handle);
}
sort($counts);
$n = count($counts)-1;
array_splice($counts, $n);

echo "\n";
echo "count : ".$n."\n";
echo "min : ".min($counts)."\n";
echo "max : ".max($counts)."\n";

$total = 0;
for ($i=0; $i<$n; $i++) {
  $total += $counts[$i];
}
$moy = $total/$n;
echo "moy : ".round($moy)."\n";

echo "distrib :\n";

$dn = $n/10;
for ($i=0; $i<10; $i++) {
  $index=ceil($dn*$i);
  printf("%d\t%d\t%d\n", $i, $index, $counts[$index]);
}

?>