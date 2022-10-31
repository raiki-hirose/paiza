<?php

class Customer
{
    private int $numOfPeople;
    private int $standingRegisterIndex;
    private int $forwardCustomerNum;

    public function __construct(int $numOfPeople)
    {
        $this->numOfPeople = $numOfPeople;
    }

    protected function findMinWaitingRegisterIndex(array $registers): int
    {
        $waitingPeopleNums = [];

        foreach ($registers as $register) {
            $waitingPeopleNums[] = $register->getWaitingPeopleNum();
        }

        return array_search(min($waitingPeopleNums), $waitingPeopleNums);
    }

    public function standInRegister(array $registers): void
    {
        $this->standingRegisterIndex = $this->findMinWaitingRegisterIndex($registers);
        $standingRegister = $registers[$this->standingRegisterIndex];
        $this->forwardCustomerNum = $standingRegister->getWaitingPeopleNum();
        $standingRegister->addWaitingPeopleNum($this->numOfPeople);
    }
}