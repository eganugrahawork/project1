<?php

namespace App\Providers;

// use App\Models\User;

use App\Models\CrudPermission;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\User;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Closure;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
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

        Gate::define('approve', function(User $user,  $url){

                $idnya = Menu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['menu_id'=>$idnya,'role_id'=> $user->role_id, 'approve' => 1])->first();
                }
                return $isAvailable;
        });

        Gate::define('create', function(User $user,  $url){

                $idnya = Menu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['menu_id'=>$idnya,'role_id'=> $user->role_id, 'created' => 1])->first();
                }
                return $isAvailable;
        });

        Gate::define('edit', function(User $user, $url){

                $idnya = Menu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['menu_id'=>$idnya,'role_id'=>$user->role_id, 'edit' => 1])->first();
                }
                return $isAvailable;

        });
        Gate::define('delete', function(User $user, $url){

                $idnya = Menu::where(['url' => $url])->pluck('id')->first();

                $isAvailable =null;
                if($idnya){
                    $isAvailable= CrudPermission::where(['menu_id'=>$idnya,'role_id'=>$user->role_id, 'deleted' => 1])->first();
                }
                return $isAvailable;
        });


    }
}
