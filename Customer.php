<?php

class Customer
{
    private int $numOfPeople;

    public function __construct(int $numOfPeople)
    {
        $this->numOfPeople = $numOfPeople;
    }

    public function getNumOfPeople(): int
    {
        return $this->numOfPeople;
    }

    public function reduceNumOfPeople(int $reduceNum): void
    {
        $this->numOfPeople -= $reduceNum;
    }

    protected function findMinWaitingRegister(array $registers): Register
    {
        $waitingPeopleNums = [];

        foreach ($registers as $register) {
            $waitingPeopleNums[] = $register->getWaitingPeopleSum();
        }

        return $registers[array_search(min($waitingPeopleNums), $waitingPeopleNums)];
    }

    public function standInRegister(array $registers): void
    {
        $this->findMinWaitingRegister($registers)->addWaitingCustomers($this);
    }
}