<?php

require_once 'Register.php';
require_once 'Customer.php';
require_once 'StopperCustomer.php';

const CASHING = '.';
const STOPPER_CUSTOMER = 'x';

$commands = trim(fgets(STDIN));
$registerNum = 5;
$register0 = new Register(2); //レジ番号1
$register1 = new Register(7); //2
$register2 = new Register(3); //3
$register3 = new Register(5); //4
$register4 = new Register(2); //5
$registers = [];

for ($i = 0; $i < $registerNum; $i++) {
    $registers[] = ${'register'.$i};
}

foreach (str_split($commands) as $command) {
    if(is_numeric($command)) {
        $customer = new Customer((int)$command);
        $customer->standInRegister($registers);
        continue;
    }
    if ($command === STOPPER_CUSTOMER) {
        $stopperCustomer = new StopperCustomer(1, STOPPER_CUSTOMER);
        $stopperCustomer->standInRegister($registers);
        continue;
    }
    if ($command === CASHING) {
        foreach ($registers as $register) {
            $register->cashing();
        }
    }

}

for ($i = 0; $i < $registerNum - 1; $i++) {
    echo $registers[$i]->getWaitingPeopleSum().',';
}
echo $registers[$registerNum - 1]->getWaitingPeopleSum(), PHP_EOL;