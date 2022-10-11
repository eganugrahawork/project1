<?php

namespace App\Providers;

// use App\Models\User;

use App\Models\CrudPermission;
use App\Models\User;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('Rupiah', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

        Gate::define('create', function(User $user, $is_submenu, $url){
            // dd($id_role_user);
            if($is_submenu == 1){
                $idnya = UserSubmenu::where(['urlsubmenu' => $url])->pluck('id')->first();
                $isAvailable = null;
                if($idnya){
                    $isAvailable = CrudPermission::where(['id_submenu' => $idnya,'id_role' => $user->id_role, 'created'=>1])->first();
                }

                return $isAvailable;
            }else{
                $idnya = UserMenu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['id_menu'=>$idnya,'id_role'=>$user->id_role, 'created' => 1])->first();
                }
                return $isAvailable;
            }

        });

        Gate::define('edit', function(User $user, $is_submenu, $url){
            // dd($id_role_user);
            if($is_submenu == 1){
                $idnya = UserSubmenu::where(['urlsubmenu' => $url])->pluck('id')->first();
                $isAvailable = null;
                if($idnya){
                    $isAvailable = CrudPermission::where(['id_submenu' => $idnya,'id_role' => $user->id_role, 'edit'=>1])->first();
                }

                return $isAvailable;
            }else{
                $idnya = UserMenu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['id_menu'=>$idnya,'id_role'=>$user->id_role, 'edit' => 1])->first();
                }
                return $isAvailable;
            }

        });
        Gate::define('delete', function(User $user, $is_submenu, $url){
            // dd($id_role_user);
            if($is_submenu == 1){
                $idnya = UserSubmenu::where(['urlsubmenu' => $url])->pluck('id')->first();
                $isAvailable = null;
                if($idnya){
                    $isAvailable = CrudPermission::where(['id_submenu' => $idnya,'id_role' => $user->id_role, 'deleted'=>1])->first();
                }

                return $isAvailable;
            }else{
                $idnya = UserMenu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['id_menu'=>$idnya,'id_role'=>$user->id_role, 'deleted' => 1])->first();
                }
                return $isAvailable;
            }

        });


    }
}
