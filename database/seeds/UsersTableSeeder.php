<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Baha';
        $user->last_name = 'Bouslama';
        $user->email = 'bahaeddineb@outlook.fr';
        $user->password = Hash::make('siyou2020');
        $user->activated_account=1;
        $user->save();
        // get role and assign it to a user
        $role = Role::where('name', 'shopOwner')->first();
        $role->users()->save($user);


        $user1 = new User();
        $user1->first_name = 'habiba';
        $user1->last_name = 'boujmil';
        $user1->email = 'habiba@outlook.fr';
        $user1->password = Hash::make('siyou2020');
        $user1->shop_owner_id=user::where('email', 'bahaeddineb@outlook.fr')->value('id');
        $user1->activated_account=1;
        $user1->save();
        // get role and assign it to a user
        $role1 = Role::where('name', 'shopManager')->first();
        $role1->users()->save($user1);


        $user2 = new User();
        $user2->first_name = 'marwa';
        $user2->last_name = 'souissi';
        $user2->email = 'marwa@outlook.fr';
        $user2->password = Hash::make('siyou2020');
        $user2->shop_owner_id=user::where('email', 'bahaeddineb@outlook.fr')->value('id');
        $user2->activated_account=1;
        $user2->save();
        // get role and assign it to a user
        $role2 = Role::where('name', 'cachier')->first();
        $role2->users()->save($user2);

        $user3 = new User();
        $user3->first_name = 'siyou';
        $user3->last_name = 'technology';
        $user3->email = 'siyou@outlook.fr';
        $user3->password = Hash::make('siyou2020');
        $user3->shop_owner_id=user::where('email', 'bahaeddineb@outlook.fr')->value('id');
        $user3->activated_account=1;
        $user3->save();
        // get role and assign it to a user
        $role3 = Role::where('name', 'SuperAdmin')->first();
        $role3->users()->save($user3);

        $user4 = new user();
        $user4->first_name = 'safwen';
        $user4->last_name = 'derwich';
        $user4->email = 'safwen@outlook.fr';
        $user4->password = Hash::make('siyou2020');
        $user4->activated_account=1;
        $user4->save();
        // get role and assign it to a user
        $role = Role::where('name', 'shopOwner')->first();
        $role->users()->save($user4);

        $user5 = new User();
        $user5->first_name = 'Amine';
        $user5->last_name = 'boussaa';
        $user5->email = 'amine@outlook.fr';
        $user5->password = Hash::make('siyou2020');
        $user5->shop_owner_id=user::where('email', 'safwen@outlook.fr')->value('id');
        $user5->activated_account=1;
        $user5->save();
        // get role and assign it to a user
        $role5 = Role::where('name', 'shopManager')->first();
        $role5->users()->save($user5);


        $user6 = new User();
        $user6->first_name = 'takwa';
        $user6->last_name = 'missaoui';
        $user6->email = 'takwa@outlook.fr';
        $user6->password = Hash::make('siyou2020');
        $user6->shop_owner_id=user::where('email', 'safwen@outlook.fr')->value('id');
        $user6->activated_account=1;
        $user6->save();
        // get role and assign it to a user
        $role6 = Role::where('name', 'cachier')->first();
        $role6->users()->save($user6);

    }
}
