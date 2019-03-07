<?php

$str = file_get_contents('output.json');
$json = json_decode($str);
$lines = '';
$tokens = [];
$previousToken = '';
$i = 0;
foreach($json->features as $i => $feature) {
    $token = $feature->token;
    if (substr($token, 0, 2) == '##') {
        $tokens[$i - 1] = $previousToken . substr($token, 2);
    } else {
        $values = $feature->layers[0]->values;
        $lines .= implode("\t", $values);
        $values = $feature->layers[1]->values;
        $lines .= "\t" . implode("\t", $values);
        $values = $feature->layers[2]->values;
        $lines .= "\t" . implode("\t", $values);
        $values = $feature->layers[3]->values;
        $lines .= "\t" . implode("\t", $values) . "\n";
        $tokens[$i] = $token;
        $previousToken = $token;
    }
    $i++;
}
file_put_contents('output.tsv', $lines);
file_put_contents('output.lbl', implode("\n", $tokens));