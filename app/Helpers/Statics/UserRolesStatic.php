<?php

namespace App\Helpers\Statics;

class UserRolesStatic {
    const ADMIN = 0;
    const MANAGER = 1;
    const ASSISTANT = 2;
    const AGENCY_MANAGER = 3;
    const BUSINESS_STAFF = 4;
    const WAREHOUSE_STAFF = 5;

    public static function getRoleChoices()
    {
        return [
            self::ADMIN => 'Admin',
            self::MANAGER => 'Giám đốc',
            self::ASSISTANT => 'Trợ lý',
            self::AGENCY_MANAGER => 'Quản lý đại lý',
            self::BUSINESS_STAFF => 'Nhân viên kinh doanh',
            self::WAREHOUSE_STAFF => 'Nhân viên kho',
        ];
    }

    public static function getRoleText($role)
    {
        $roleList = self::getRoleChoices();
        return isset($roleList[$role]) ? $roleList[$role] : '-empty-';
    }
}


?>