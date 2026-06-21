<?php
$raw = 55.04;
$max = 60;
$exactPercent = ($raw / $max) * 100;
$roundedPercent = round($exactPercent, 2);
$exactScaled = ($exactPercent / 100) * 5;
$roundedScaled = ($roundedPercent / 100) * 5;

echo "exactPercent=" . $exactPercent . PHP_EOL;
echo "roundedPercent=" . $roundedPercent . PHP_EOL;
echo "exactScaled=" . $exactScaled . PHP_EOL;
echo "roundedScaled=" . $roundedScaled . PHP_EOL;
