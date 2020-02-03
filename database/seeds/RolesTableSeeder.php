<?php
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'ShopOwner';
        $role->save();
        $role1 = new Role();
        $role1->name = 'ShopManager';
        $role1->save();
        $role3 = new Role();
        $role3->name = 'cachier';
        $role3->save();
        $role2 = new Role();
        $role2->name = 'SuperAdmin';
        $role2->save();
        
    }
}
