<?php

namespace App\Helpers\Statics;

class UserRolesStatic {
    const MANAGER = 0;
    const AGENCY_MANAGER = 1;
    const BUSINESS_STAFF = 2;
    const WAREHOUSE_STAFF = 3;

    public static function getRoleChoices()
    {
        return [
            self::MANAGER => 'Manager',
            self::AGENCY_MANAGER => 'Agency manager',
            self::BUSINESS_STAFF => 'Business staff',
            self::WAREHOUSE_STAFF => 'Warehouse staff',
        ];
    }

    public static function getRoleText($role)
    {
        $roleList = self::getRoleChoices();
        return isset($roleList[$role]) ? $roleList[$role] : '-empty-';
    }
}


?>