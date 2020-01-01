<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'product_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'product_category_create',
            ],
            [
                'id'    => '19',
                'title' => 'product_category_edit',
            ],
            [
                'id'    => '20',
                'title' => 'product_category_show',
            ],
            [
                'id'    => '21',
                'title' => 'product_category_delete',
            ],
            [
                'id'    => '22',
                'title' => 'product_category_access',
            ],
            [
                'id'    => '23',
                'title' => 'product_tag_create',
            ],
            [
                'id'    => '24',
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => '25',
                'title' => 'product_tag_show',
            ],
            [
                'id'    => '26',
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => '27',
                'title' => 'product_tag_access',
            ],
            [
                'id'    => '28',
                'title' => 'product_create',
            ],
            [
                'id'    => '29',
                'title' => 'product_edit',
            ],
            [
                'id'    => '30',
                'title' => 'product_show',
            ],
            [
                'id'    => '31',
                'title' => 'product_delete',
            ],
            [
                'id'    => '32',
                'title' => 'product_access',
            ],
            [
                'id'    => '33',
                'title' => 'customer_create',
            ],
            [
                'id'    => '34',
                'title' => 'customer_edit',
            ],
            [
                'id'    => '35',
                'title' => 'customer_show',
            ],
            [
                'id'    => '36',
                'title' => 'customer_delete',
            ],
            [
                'id'    => '37',
                'title' => 'customer_access',
            ],
            [
                'id'    => '38',
                'title' => 'driver_create',
            ],
            [
                'id'    => '39',
                'title' => 'driver_edit',
            ],
            [
                'id'    => '40',
                'title' => 'driver_show',
            ],
            [
                'id'    => '41',
                'title' => 'driver_delete',
            ],
            [
                'id'    => '42',
                'title' => 'driver_access',
            ],
            [
                'id'    => '43',
                'title' => 'line_create',
            ],
            [
                'id'    => '44',
                'title' => 'line_edit',
            ],
            [
                'id'    => '45',
                'title' => 'line_show',
            ],
            [
                'id'    => '46',
                'title' => 'line_delete',
            ],
            [
                'id'    => '47',
                'title' => 'line_access',
            ],
            [
                'id'    => '48',
                'title' => 'report_access',
            ],
            [
                'id'    => '49',
                'title' => 'order_management_access',
            ],
            [
                'id'    => '50',
                'title' => 'order_create',
            ],
            [
                'id'    => '51',
                'title' => 'order_edit',
            ],
            [
                'id'    => '52',
                'title' => 'order_show',
            ],
            [
                'id'    => '53',
                'title' => 'order_delete',
            ],
            [
                'id'    => '54',
                'title' => 'order_access',
            ],
            [
                'id'    => '55',
                'title' => 'salesman_create',
            ],
            [
                'id'    => '56',
                'title' => 'salesman_edit',
            ],
            [
                'id'    => '57',
                'title' => 'salesman_show',
            ],
            [
                'id'    => '58',
                'title' => 'salesman_delete',
            ],
            [
                'id'    => '59',
                'title' => 'salesman_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
