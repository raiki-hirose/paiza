<?php

function getStdin(): string
{
    return trim(fgets(STDIN));
}

function findMaxDevidedVoteParty(array $devidedPartyVotes, array $partyVotes): int
{
    $maxDevidedVote = 0;
    $maxDevidedVoteParty = -1;
    $maxPartyVote = 0;
    $partyCount = 0;
    foreach ($devidedPartyVotes as $party) {
        $max = $party[0];
        if ($max > $maxDevidedVote) {
            $maxDevidedVote = $max;
            $maxDevidedVoteParty = $partyCount;
            $maxPartyVote = $partyVotes[$partyCount];
        } elseif($max === $maxDevidedVote && $partyVotes[$partyCount] > $maxPartyVote) {
            $maxDevidedVote = $max;
            $maxDevidedVoteParty = $partyCount;
            $maxPartyVote = $partyVotes[$partyCount];
        }
        $partyCount++;
    }

    return $maxDevidedVoteParty;
}

[$partyNum, $seatNum] = explode(' ', getStdin());
$partyVotes = [];
$devidedPartyVotes = [[]];
$partyGetSeats = [];
for ($i = 0; $i < $partyNum; $i++) {
    $partyGetSeats[] = 0;
}

for ($i = 0; $i < $partyNum; $i++) {
    $partyVotes[] = getStdin();
}

$partyCount = 0;
foreach ($partyVotes as $partyVote) {
    for ($i = 1; $i <= $seatNum; $i++) {
        $devidedPartyVotes[$partyCount][] = (int)($partyVote / $i);
    }
    $partyCount++;
}

for ($i = 0; $i < $seatNum; $i++) {
    $maxDevidedVoteParty = findMaxDevidedVoteParty($devidedPartyVotes, $partyVotes);
    $partyGetSeats[$maxDevidedVoteParty]++;
    array_splice($devidedPartyVotes[$maxDevidedVoteParty], 0, 1);
}

foreach ($partyGetSeats as $partySeat) {
    echo $partySeat, PHP_EOL;
}
