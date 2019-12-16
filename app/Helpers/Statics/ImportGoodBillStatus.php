<?php

namespace App\Helpers\Statics;

class ImportGoodBillStatus {
    const WAREHOUSE_PENDING = 0;
    const WAREHOURS_CONFIRM = 1;
    const WAREHOURS_ADDPRODUCT = 2;
    public static function getStatusChoices()
    {
        return [
            self::WAREHOUSE_PENDING => 'Chưa Thanh Toán',
            self::WAREHOURS_CONFIRM => 'Đã Thanh Toán',
            self::WAREHOURS_ADDPRODUCT => 'Đã Nhập Hàng',
            
        ];
    }

    public static function getStatusText($role)
    {
        $roleList = self::getStatusChoices();
        return isset($roleList[$role]) ? $roleList[$role] : '-empty-';
    }
}

?>