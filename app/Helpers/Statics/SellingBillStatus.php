<?php

namespace App\Helpers\Statics;

class SellingBillStatus {
    const WAREHOUSE_PENDING = 0;
    const WAREHOURS_CONFIRM = 1;

    public static function getStatusChoices()
    {
        return [
            self::WAREHOUSE_PENDING => 'Chưa nhận hàng',
            self::WAREHOURS_CONFIRM => 'Đã nhận hàng',
        ];
    }

    public static function getStatusText($role)
    {
        $roleList = self::getStatusChoices();
        return isset($roleList[$role]) ? $roleList[$role] : '-empty-';
    }
}

?>