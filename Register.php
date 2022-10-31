<?php
require_once 'Customer.php';

class Register
{
    private int $capability;
    private int $waitingPeopleNum;
    private bool $stopping;
    private int $toStopCount;

    public function __construct(int $capa)
    {
        $this->capability = $capa;
        $this->waitingPeopleNum = 0;
        $this->stopping = false;
        $this->toStopCount = -1;
    }

    public function getWaitingPeopleNum(): int
    {
        return $this->waitingPeopleNum;
    }

    public function addWaitingPeopleNum(int $addNum): void
    {
        $this->waitingPeopleNum += $addNum;
    }

    public function setToStopCount(): void
    {
        if ($this->toStopCount < 0) {
            $this->toStopCount = $this->waitingPeopleNum;
        }
    }

    public function cashing(): void
    {
        if (!$this->stopping) {
            if ($this->toStopCount <= $this->capability && $this->toStopCount >= 0) {
                $this->waitingPeopleNum -= $this->toStopCount;
                $this->toStopCount = 0;
                $this->stopping = true;
                return;
            }
            $this->waitingPeopleNum = max($this->waitingPeopleNum - $this->capability, 0);
            $this->toStopCount -= $this->capability;
        }
    }
}