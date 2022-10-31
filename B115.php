<?php

$wordNum = getStdin();
$words = [];
$matchWordPareNum = 0;
for ($i = 0; $i < $wordNum; $i++) {
    $words[] = getStdin();
}

$allWordPare = [];
for ($i = 0; $i < $wordNum; $i++) {
    for ($j = $i; $j < $wordNum; $j++) {
        $allWordPare[] = $words[$i].$words[$j];
    }
}

foreach ($allWordPare as $wordPare) {
    foreach ($words as $word) {
        $matchWordPareNum += judgeMatchWordPare($wordPare, $word);
    }
}

echo $matchWordPareNum;



function getStdin(): string
{
    return trim(fgets(STDIN));
}

function judgeMatchWordPare(string $wordA, String $wordB): int
{
    if (strlen($wordA) !== strlen($wordB)) {
        return 0;
    }
    if (strlen($wordA) === strlen($wordB)) {
        for ($i = 0; $i < strlen($wordA); $i++) {
            $matchPosition = strpos($wordB, $wordA[$i]);
            if ($matchPosition === false) {
                return 0;
            }
            if ($matchPosition !== false) {
                $wordB = substr($wordB, 0, $matchPosition).substr($wordB, $matchPosition + 1);
            }
        }

        return 1;
    }
}
