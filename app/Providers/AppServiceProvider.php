<?php

namespace App\Providers;

// use App\Models\User;

use App\Models\User;
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

        Gate::define('create', function(User $user){
           return $user->id_role == 2;
        });
    }
}
