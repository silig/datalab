<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = ['users','roles','permissions','menus'];
        $access = ['view','create','edit','delete'];
        $no = 2;
        foreach ($tables as $table) {
            foreach ($access as $acc) {
                Permission::create([
                    'name' => $acc.'-'.$table,
                    'alias' => $acc.' '.$table,
                    'menu_id' => $no
                ]);
            }
            $no++;
        }
        
    }
}
