<?php
$raw = 55.04;
$max = 60;

$exactPercent = ($raw / $max) * 100;
$exactScaled = ($exactPercent / 100) * 5;
$roundedPercent = round($exactPercent, 2);
$roundedScaled = ($roundedPercent / 100) * 5;

printf("exactPercent=%.15f\n", $exactPercent);
printf("exactScaled=%.15f\n", $exactScaled);
printf("roundedPercent=%.2f\n", $roundedPercent);
printf("roundedScaled=%.15f\n", $roundedScaled);
printf("difference=%.15f\n", abs($exactScaled - $roundedScaled));
