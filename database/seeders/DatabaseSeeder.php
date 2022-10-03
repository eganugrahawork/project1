<?php

namespace Database\Seeders;

use App\Models\Eksternal;
use App\Models\Lokasi;
use App\Models\Material;
use App\Models\TypeMaterial;
use App\Models\Uom;
use App\Models\User;
use App\Models\UserAccessMenu;
use App\Models\UserDetail;
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
            'username' => 'eganugrahaid',
            'email' => 'nugrahaega261@gmail.com',
            'id_detail_user' => 1,
            'id_role' => 1,
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'username' => 'dwiwahyu',
            'email' => 'dwiwahyu@gmail.com',
            'id_detail_user' => 2,
            'id_role' => 2,
            'password' => bcrypt('12345678')
        ]);
        // End User

        // User Detail
        UserDetail::create([
            'nama' => 'Ega Nugraha',
            'image' => 'img-users/default.png',
            'alamat' => 'tasik',
            'nokontak' => '08975568102',
            'lokasi' => 'Wilayah Selatan'
        ]);
        UserDetail::create([
            'nama' => 'Dwi Wahyu',
            'image' => 'img-users/default.png',
            'alamat' => 'bandung',
            'nokontak' => '08975568101',
            'lokasi' => 'Wilayah Utara'
        ]);
        // End UserDetail

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
                            'icon' => 'dsa'
        ]);
        UserSubmenu::create(['submenu'=> 'Principal',
                            'urlsubmenu'=> '/admin/masterdata/principal',
                            'id_menu' => 3,
                            'icon' => 'dsa'
        ]);
        UserSubmenu::create(['submenu'=> 'UoM',
                            'urlsubmenu'=> '/admin/masterdata/uom',
                            'id_menu' => 3,
                            'icon' => 'dsa'
        ]);
        UserSubmenu::create(['submenu'=> 'Customer',
                            'urlsubmenu'=> '/admin/masterdata/customer',
                            'id_menu' => 3,
                            'icon' => 'dsa'
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
        Lokasi::create([
            'lokasi' => 'Wilayah Barat'
        ]);

        Lokasi::create([
            'lokasi' => 'Wilayah Selatan'
        ]);

        Lokasi::create([
            'lokasi' => 'Wilayah Utara'
        ]);
        // End Lokasi

        // TypeMaterial
        TypeMaterial::create([
            'type_material_name' => 'Pestisida',
            'type_material_description' => 'Pestisida',
        ]);
        TypeMaterial::create([
            'type_material_name' => 'Non Pestisida',
            'type_material_description' => 'Non Pestisida',
        ]);
        // End Type Material

        // UoM
            Uom::create([
                'uom_name'=> 'Kilogram',
                'uom_symbol'=> 'kg',
                'description'=> 'Satuan Berat'
            ]);
            Uom::create([
                'uom_name'=> 'Gram',
                'uom_symbol'=> 'gr',
                'description'=> 'Satuan Berat Kecil'
            ]);
            Uom::create([
                'uom_name'=> 'Liter',
                'uom_symbol'=> 'lt',
                'description'=> 'Satuan Liter'
            ]);
        // End Uom

        //Principal
            Eksternal::create([
                'kode_eksternal' => "212003",
                'name_eksternal' => "PT. AGROKIMINDO",
                'eksternal_address' => "Jl. Raden Saleh No.6, Jakarta",
                'phone_1' => "021-31927418",
                'sts_show'=>1
            ]);
        // End Principal

        // Items
            Material::create([
                'stock_code' => "BAI0101",
                'stock_name' => "Acrobat 50 WP",
                'stock_desc' => "Acrobat 50 WP",
                'base_qty' => 10,
                'unit_terkecil' => 2,
                'unit_box' => 320,
                'type' => 1,
                'pajak' => 10,
                'dist_id' => 1,
                'sts_show' => 1
            ]);
        // End Items
    }
}
