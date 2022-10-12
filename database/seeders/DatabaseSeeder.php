<?php

namespace Database\Seeders;

use App\Models\Items;
use App\Models\PriceHistory;
use App\Models\Principal;
use App\Models\Region;
use App\Models\TypeItems;
use App\Models\Uom;
use App\Models\User;
use App\Models\UserAccessMenu;
use App\Models\UserAccessSubmenu;
use App\Models\UserMenu;
use App\Models\UserRole;
use App\Models\UserSubmenu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User
        User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'id_role' => 1,
            'password' => bcrypt('12345678'),
            'name' => 'Super Admin',
            'image' => 'img-users/default.png',
            'address' => 'tasik',
            'no_hp' => '08975568102',
            'region' => '1'
        ]);
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'id_role' => 2,
            'password' => bcrypt('12345678'),
            'name' => 'Super Admin',
            'image' => 'img-users/default.png',
            'address' => 'tasik',
            'no_hp' => '08975568102',
            'region' => '1'
        ]);
        // End User


        // User Menu
        UserMenu::create([
            'menu' => 'Dashboard',
            'url' => '/admin/dashboard'
        ]);
        UserMenu::create([
            'menu' => 'Users',
            'url' => '/admin/users'
        ]);
        UserMenu::create([
            'menu' => 'Masterdata',
            'is_submenu' => 1
        ]);
        // End User Menu

        // User Submenu
        UserSubmenu::create(['submenu'=> 'Items',
                            'urlsubmenu'=> '/admin/masterdata/items',
                            'id_menu' => 3,
                            'icon' => 'box'
        ]);
        UserSubmenu::create(['submenu'=> 'Principal',
                            'urlsubmenu'=> '/admin/masterdata/principal',
                            'id_menu' => 3,
                            'icon' => 'person-square'
        ]);
        UserSubmenu::create(['submenu'=> 'UoM',
                            'urlsubmenu'=> '/admin/masterdata/uom',
                            'id_menu' => 3,
                            'icon' => 'clipboard'
        ]);
        UserSubmenu::create(['submenu'=> 'Customer',
                            'urlsubmenu'=> '/admin/masterdata/customer',
                            'id_menu' => 3,
                            'icon' => 'bag-check'
        ]);
        UserSubmenu::create(['submenu'=> 'Price Management',
                            'urlsubmenu'=> '/admin/masterdata/pricemanagement',
                            'id_menu' => 3,
                            'icon' => 'cash-coin'
        ]);
        UserSubmenu::create(['submenu'=> 'COA',
                            'urlsubmenu'=> '/admin/masterdata/coa',
                            'id_menu' => 3,
                            'icon' => 'credit-card'
        ]);
        // End User Submenu

        // User Access
        UserAccessMenu::create([
          'id_role' =>1,
          'id_menu' => 1,
        ]);
        UserAccessMenu::create([
          'id_role' =>1,
          'id_menu' => 2,
        ]);
        UserAccessMenu::create([
          'id_role' =>1,
          'id_menu' => 3,
        ]);
        UserAccessMenu::create([
          'id_role' =>2,
          'id_menu' => 1,
        ]);
        // End User access

        // User Access Submenu

        UserAccessSubmenu::create([
            'id_role' => 1,
            'id_submenu'=>1
        ]);
        UserAccessSubmenu::create([
            'id_role' => 1,
            'id_submenu'=>2
        ]);
        UserAccessSubmenu::create([
            'id_role' => 1,
            'id_submenu'=>3
        ]);
        UserAccessSubmenu::create([
            'id_role' => 1,
            'id_submenu'=>4
        ]);
        UserAccessSubmenu::create([
            'id_role' => 1,
            'id_submenu'=>5
        ]);
        UserAccessSubmenu::create([
            'id_role' => 1,
            'id_submenu'=>6
        ]);
        // End User Access Submenu

        // User Role
        UserRole::create([
            'role' => 'Super Admin'
        ]);

        UserRole::create([
            'role' => 'Admin'
        ]);

        UserRole::create([
            'role' => 'Staff'
        ]);
        // End User Role

        // Lokasi
        Region::create([
            'name' => 'Wilayah Barat'
        ]);

        Region::create([
            'name' => 'Wilayah Selatan'
        ]);

        Region::create([
            'name' => 'Wilayah Utara'
        ]);
        // End Lokasi

        // TypeItem
        TypeItems::create([
            'type_item_name' => 'Pestisida',
            'type_item_description' => 'Pestisida',
            'vat' => 10,
            'status' => 0,
            'id_coa' => 123
        ]);
        TypeItems::create([
            'type_item_name' => 'Non Pestisida',
            'type_item_description' => 'Non Pestisida',
            'vat' => 10,
            'status' => 0,
            'id_coa' => 123
        ]);
        // End Type Material
        // UoM
            Uom::create([
                'name'=> 'Kilogram',
                'symbol'=> 'kg',
                'description'=> 'Satuan Berat'
            ]);
            Uom::create([
                'name'=> 'Gram',
                'symbol'=> 'gr',
                'description'=> 'Satuan Berat Kecil'
            ]);
            Uom::create([
                'name'=> 'Liter',
                'symbol'=> 'lt',
                'description'=> 'Satuan Liter'
            ]);
        // End Uom

        //partners
            Principal::create([
                'code' => "212003",
                'name' => "PT. AGROKIMINDO",
                'address' => "Jl. Raden Saleh No.6, Jakarta",
                'phone' => "021-31927418",
                'status'=>1
            ]);
        // End partners

        // Items
            Items::create([
                'code' => "BAI0101",
                'name' => "Acrobat 50 WP",
                'description' => "Acrobat 50 WP",
                'base_qty' => 10,
                'uom_id' => 2,
                'unit_box' => 320,
                'type' => 1,
                'vat' => 10,
                'partner_id' => 1,
                'status' => 1
            ]);

            PriceHistory::create(['items_id'=>1]);
        // End Items
    }
}
