<?php
require_once 'Customer.php';

class StopperCustomer extends Customer
{
    private $stopperCustomer;

    public function __construct(int $registerIndex, int $numOfPeople, int $forwardCustomerNum, string $stopperCustomer)
    {
        parent::__construct($registerIndex, $numOfPeople, $forwardCustomerNum);

        $this->stopperCustomer = $stopperCustomer;
    }
}