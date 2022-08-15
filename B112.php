<?php

[$height, $width, $startPoint] = explode(' ', getStdin());
$map = [];
for ($i = 0; $i < $height; $i++) {
    $map[] = getStdin();
}

$goalPoint = playAmidakuji($map, $height, $width, $startPoint);
echo $goalPoint;


function getStdin(): string
{
    return trim(fgets(STDIN));
}

function playAmidakuji(array $map, int $height, int $width, int $startPoint): int
{
    $nowColumn = strpos($map[0], $startPoint);
    for ($i = 1; $i < $height; $i++) {
        if ($nowColumn > 0 && $map[$i][$nowColumn - 1] === '.') {
            while ($nowColumn > 0 && $map[$i][$nowColumn - 1] === '.') {
                $nowColumn--;
            }

            continue;
        }
        if($nowColumn < $width - 1 && $map[$i][$nowColumn + 1] === '.') {
            while ($nowColumn < $width - 1 && $map[$i][$nowColumn + 1] === '.') {
                $nowColumn++;
            }
        }
    }

    return $map[$height - 1][$nowColumn];
}
