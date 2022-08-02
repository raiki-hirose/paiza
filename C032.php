<?php

$purchaseList1 = new PurchaseList(getStdin());
$purchaseList1->writeItemList();
$purchaseList1->calcItemTypeSum();
$list1Points = $purchaseList1->calcPoints();
$list1PointSum = array_sum($list1Points);

echo $list1PointSum;


function getStdin()
{
    return trim(fgets(STDIN));
}

class PurchaseList
{
    const ITEM_TYPE_NUM = 4;
    private $itemList = [[]];
    private $itemTypeSum = [];

    public function __construct(
        private int $itemNum,
        private float $pointRateType0 = 0.05,
        private float $pointRateType1 = 0.03,
        private float $pointRateType2 = 0.02,
        private float $pointRateType3 = 0.01,
    ) {}

    public function writeItemList(): array
    {
        for ($i = 0; $i < $this->itemNum; $i++) {
            $this->itemList[$i] = explode(' ', getStdin());
        }

        return $this->itemList;
    }

    public function calcItemTypeSum(): array
    {
        foreach ($this->itemList as $item) {
            switch ($item[0]) {
                case 0:
                    $this->itemTypeSum[0] += $item[1];
                    break;
                case 1:
                    $this->itemTypeSum[1] += $item[1];
                    break;
                case 2:
                    $this->itemTypeSum[2] += $item[1];
                    break;
                case 3:
                    $this->itemTypeSum[3] += $item[1];
                    break;
            }
        }

        return $this->itemTypeSum;
    }

    public function calcPoints(): array
    {
        $points = [];
        for ($i = 0; $i < self::ITEM_TYPE_NUM; $i++) {
            $points[] = (int)($this->itemTypeSum[$i] / 100) * 100 * $this->{"pointRateType".$i};
        }

        return $points;
    }
}
