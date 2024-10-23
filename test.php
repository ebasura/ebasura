<?php
include 'init.php';

$b = new Basura();
echo round($b->calculatePercentageFull(1,1),2). '%';