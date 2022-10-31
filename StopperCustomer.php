<?php
require_once 'Customer.php';

class StopperCustomer extends Customer
{
    private string $stopperCustomerChar;

    public function __construct(int $numOfPeople, string $stopperCustomerChar)
    {
        parent::__construct($numOfPeople);

        $this->stopperCustomerChar = $stopperCustomerChar;
    }
}