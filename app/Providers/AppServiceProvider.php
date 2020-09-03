<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Helpers\Navbar;
use Auth;

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
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $adminPath = config('adminlte.dashboard_url');
            $menu = new Navbar();
            

                
            foreach($menu->getSidemenu() as $sidebar) {
                $event->menu->add($sidebar);
            }

            $event->menu->add('PENGATURAN');
            foreach($menu->getSideSetting() as $sidebar) {
                $event->menu->add($sidebar);
            }
        });
    }
}
