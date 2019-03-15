<?php
require 'tsne.php';

$dists = array( array(1,0.1,0.2), array(0.1,1,0.3), array(0.2,0.1,1));
$tsne = new tSNE(array('epsilon'=>10));
$tsne->initDataDist($dists);
for( $k=0; $k<500; $k++) {
    // every time you call this, the solution gets better.
    $tsne->step();
}
$Y = $tsne->getSolution();
print_r($Y);
