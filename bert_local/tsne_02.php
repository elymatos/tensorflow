<?php
require 'tsne.php';

$output = 'output03';
$str = file_get_contents($output . '.json');
$json = json_decode($str);
$lines = '';
$tokens = [];
$previousToken = '';
$i = 0;
foreach ($json->features as $j => $feature) {
    $token = $feature->token;
    if (substr($token, 0, 2) == '##') {
        $tokens[$i - 1] = $previousToken . substr($token, 2);
    } else {
        $dist[$j] = $feature->layers[0]->values;
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

$dists = [];
foreach ($dist as $d) {
    $dists[] = $d;
}
$tsne = new tSNE(['epsilon' => 10, 'dim' => 3]);
$tsne->initDataDist($dists);
for ($k = 0; $k < 500; $k++) {
    // every time you call this, the solution gets better.
    $tsne->step();
}
$Y = $tsne->getSolution();
print_r($Y);
