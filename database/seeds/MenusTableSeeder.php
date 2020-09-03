<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'Setting',
            'url' => '#',
            'icon' => 'fa fa-cog',
            'parent_id' => 0,
            'order' => 1,
        ]);

        Menu::create([
            'name' => 'Users',
            'url' => '/users',
            'icon' => null,
            'parent_id' => 1,
            'order' => 2,
        ]);

        Menu::create([
            'name' => 'Roles',
            'url' => '/roles',
            'icon' => null,
            'parent_id' => 1,
            'order' => 3,
        ]);

        Menu::create([
            'name' => 'Permissions',
            'url' => '/permissions',
            'icon' => null,
            'parent_id' => 1,
            'order' => 4,
        ]);

        Menu::create([
            'name' => 'Menus',
            'url' => '/menus',
            'icon' => null,
            'parent_id' => 1,
            'order' => 4,
        ]);
    }
}
