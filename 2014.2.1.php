<?php


$commands = trim(fgets(STDIN));
$registerNum = 5;
$register1 = new Register(2);
$register2 = new Register(7);
$register3 = new Register(3);
$register4 = new Register(5);
$register5 = new Register(2);
$registers = [];

for ($i = 1; $i <= $registerNum; $i++) {
    $registers[] = ${'register'.$i};
}


foreach (str_split($commands) as $command) {
    if ($command === '.') {
        foreach ($registers as $register) {
            $register->cashing();
        }
    } elseif ($command === 'x') {
        $index = findMinWaitRegisterIndex($registers);
        $registers[$index]->setToCloseCount();
        $registers[$index]->addWaitNum(1);
    } elseif(is_numeric($command)) {
        $index = findMinWaitRegisterIndex($registers);
        $registers[$index]->addWaitNum((int)$command);
    }
}


for ($i = 0; $i < $registerNum - 1; $i++) {
    echo $registers[$i]->getWaitNum().',';
}
echo $registers[$registerNum - 1]->getWaitNum(), PHP_EOL;


class Register
{
    private int $capability;
    private int $waitNum;
    private bool $closing;
    private int $toCloseCount;

    public function __construct(int $capa)
    {
        $this->capability = $capa;
        $this->waitNum = 0;
        $this->closing = false;
        $this->toCloseCount = -1;
    }

    public function getWaitNum(): int
    {
        return $this->waitNum;
    }

    public function addWaitNum(int $addNum): void
    {
        $this->waitNum += $addNum;
    }

    public function setToCloseCount(): void
    {
        if ($this->toCloseCount < 0) {
            $this->toCloseCount = $this->waitNum;
        }
    }

    public function cashing(): void
    {
        if (!$this->closing) {
            if ($this->toCloseCount <= $this->capability && $this->toCloseCount >= 0) {
                $this->waitNum -= $this->toCloseCount;
                $this->closing = true;
            } else {
                $this->waitNum -= $this->capability;
                $this->toCloseCount -= $this->capability;
            }
            if ($this->waitNum < 0) {
                $this->waitNum = 0;
            }
        }
    }
}

function findMinWaitRegisterIndex(array $registers): int
{
    $minWaitNum = 999999;
    $minWaitRegisterIndex = 0;
    $count = 0;

    foreach ($registers as $register) {
        if ($register->getWaitNum() < $minWaitNum) {
            $minWaitRegisterIndex = $count;
            $minWaitNum = $register->getWaitNum();
        }
        $count++;
    }

    return $minWaitRegisterIndex;
}
