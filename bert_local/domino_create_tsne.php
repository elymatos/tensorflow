<?php

require 'tsne.php';

$tsne = new tSNE(['epsilon' => 10, 'dim' => 3]);

$m = 0;
$o = [];
$tk = [];
$input = 'domino_data/train';
$jsonInput = file($input . '.json');
foreach($jsonInput as $in) {
    $json = json_decode($in);
    println(++$m);
    $lines = '';
    $dists = [];
    $tokens = [];
    $dist = [];
    $previousToken = '';
    $l = 4;
    $i = 0;
    $t = [];
    foreach ($json->features as $j => $feature) {
        $token = $feature->token;
        $tk[] = $t[$j] = $token;
        if (substr($token, 0, 2) == '##') {
            $tokens[$i - 1] = $previousToken . substr($token, 2);
        } else {
            for ($k = 0; $k < $l; $k++) {
                foreach ($feature->layers[$k]->values as $value) {
                    $dist[$j][] = $value;
                }
            }
            $tokens[$i] = $token;
            $previousToken = $token;
        }
        $i++;
    }
    foreach ($dist as $d) {
        $dists[] = $d;
    }
    $tsne->initDataDist($dists);
    for ($k = 0; $k < 500; $k++) {
        // every time you call this, the solution gets better.
        $tsne->step();
    }
    $Y = $tsne->getSolution();
    //print_r($Y);
    println(count($Y));
    foreach($Y as $j => $p) {
        //$o[] = $t[$j] . ',' . $p[0] .','. $p[1] .','. $p[2];
        $o[] = $p[0] . "\t" . $p[1] . "\t". $p[2];
    }
}
file_put_contents($input . '_label.tsv', implode("\n", $tk));
file_put_contents($input . '.tsv', implode("\n", $o));

function println($s) {
    print_r($s . "\n");
}