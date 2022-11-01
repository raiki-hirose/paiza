<?php

class Register
{
    private int $capability;
    private array $waitingCustomers;
    private bool $stopping;

    public function __construct(int $capa)
    {
        $this->capability = $capa;
        $this->waitingCustomers = [];
        $this->stopping = false;
    }

    public function addWaitingCustomers(Customer|StopperCustomer $customer): void
    {
        $this->waitingCustomers[] = $customer;
    }

    public function getWaitingPeopleSum(): int
    {
        $peopleSum = 0;
        foreach ($this->waitingCustomers as $customer) {
            $peopleSum += $customer->getNumOfPeople();
        }

        return $peopleSum;
    }

    public function cashing(): void
    {
        if (!$this->stopping) {
            $remainReducePeopleNum = $this->capability;
            while (!empty($this->waitingCustomers)) {
                $headCustomer = $this->waitingCustomers[0];
                if ($headCustomer instanceof StopperCustomer) {
                    $this->stopping = true;
                    break;
                }
                if ($headCustomer->getNumOfPeople() <= $remainReducePeopleNum) {
                    $remainReducePeopleNum -= $headCustomer->getNumOfPeople();
                    array_shift ($this->waitingCustomers);
                    continue;
                }

                $headCustomer->reduceNumOfPeople($remainReducePeopleNum);
                break;
            }
        }
    }
}