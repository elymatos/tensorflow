<?php
require 'tsne.php';

$output = 'output01';
$str = file_get_contents($output . '.json');
$json = json_decode($str);
$lines = '';
$tokens = [];
$previousToken = '';
$l = 4;
$i = 0;
foreach ($json->features as $j => $feature) {
    $token = $feature->token;
    if (substr($token, 0, 2) == '##') {
        $tokens[$i - 1] = $previousToken . substr($token, 2);
    } else {
        for($k = 0; $k < $l; $k++) {
            foreach($feature->layers[$k]->values as $value) {
                $dist[$j][] = $value;
            }
        }

        /*
        $values = $feature->layers[0]->values;
        $lines .= implode("\t", $values);
        $values = $feature->layers[1]->values;
        $lines .= "\t" . implode("\t", $values);
        $values = $feature->layers[2]->values;
        $lines .= "\t" . implode("\t", $values);
        $values = $feature->layers[3]->values;
        $lines .= "\t" . implode("\t", $values) . "\n";
        */
        $tokens[$i] = $token;
        $previousToken = $token;
    }
    $i++;
}

foreach($tokens as $i => $token) {
    print_r($i . ':' . $token . "\n");
}
foreach($dist as $i => $d) {
    for($k = 0; $k < 100; $k++) {
        print_r($d[$k] . ' ' );
    }
    print_r("\n");
}

//$tsne = new tSNE(['epsilon' => 10, 'dim' => 3]);
//$d = $tsne->L2($dist[1], $dist[5]);
//print_r($d);

$dists = [];
foreach ($dist as $d) {
    $dists[] = $d;
}
/*
print_r(array_keys($dist));
$dists =[
    $dist[3],
    $dist[5]
];
*/
$tsne = new tSNE(['epsilon' => 10, 'dim' => 3]);
$tsne->initDataDist($dists);
for ($k = 0; $k < 500; $k++) {
    // every time you call this, the solution gets better.
    $tsne->step();
}
$Y = $tsne->getSolution();
print_r($Y);
