<?php

namespace Database\Seeders;

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

        UserDetail::create([
            'nama' => 'Ega Nugraha',
            'image' => 'img-users/default.png',
            'alamat' => 'tasik',
            'nokontak' => '08975568102',
            'lokasi' => 'wilayah1'
        ]);
        UserDetail::create([
            'nama' => 'Dwi Wahyu',
            'image' => 'img-users/default.png',
            'alamat' => 'bandung',
            'nokontak' => '08975568101',
            'lokasi' => 'wilayah2'
        ]);

        UserMenu::create([
            'menu' => 'Dashboard',
            'icon' => 'home',
            'url' => '/admin/dashboard'
        ]);
        UserMenu::create([
            'menu' => 'Configuration',
            'icon' => 'lock',
            'url' => '',
            'is_submenu' => 1
        ]);
        UserMenu::create([
            'menu' => 'Users',
            'icon' => 'users',
            'url' => '/admin/users'
        ]);
        UserMenu::create([
            'menu' => 'Profile',
            'icon' => 'user',
            'url' => '/admin/profile'
        ]);

        UserSubmenu::create([
            'id_menu' => 2,
            'submenu' => 'Menu',
            'urlsubmenu' => '/admin/configuration/menu'
        ]);

        UserSubmenu::create([
            'id_menu' => 2,
            'submenu' =>'Submenu',
            'urlsubmenu'=>'/admin/configuration/submenu'
        ]);
        UserSubmenu::create([
            'id_menu' => 2,
            'submenu' =>'Role',
            'urlsubmenu'=>'/admin/configuration/userrole'
        ]);

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
          'id_role' =>1,
          'id_menu' => 4,
        ]);

        UserAccessMenu::create([
          'id_role' =>2,
          'id_menu' => 1,
        ]);
        UserAccessMenu::create([
          'id_role' =>2,
          'id_menu' => 3,
        ]);
        UserAccessMenu::create([
          'id_role' =>2,
          'id_menu' => 4,
        ]);
        UserAccessMenu::create([
          'id_role' =>3,
          'id_menu' => 1,
        ]);
        UserAccessMenu::create([
          'id_role' =>3,
          'id_menu' => 4,
        ]);

        UserRole::create([
            'role' => 'Super Admin'
        ]);

        UserRole::create([
            'role' => 'Admin'
        ]);

        UserRole::create([
            'role' => 'Staff'
        ]);

    }
}
