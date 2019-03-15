<?php

$i = 1;
$out = [];
$lines = file('domino_data/train.conllu');
foreach ($lines as $line) {
    if ($line{0} == '#') {
        if (substr($line, 0, 6) == '# text') {
            $sentence = mb_strtolower(trim(str_replace("\n", "", substr($line,8))));
            $out[] = $sentence;
            if (++$i > 50) {
                break;
            }
        }
    }
}
file_put_contents('domino_data/train.txt', implode("\n", $out));