<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
use App\Models\Chain;

class ChainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chain= new chain();
        $chain->name = 'Carrefour Market le Passage';
        $chain->adress = 'Tunis -Tunisia';
        $chain->contact = '70 011 000';
        $chain->opening_hour = '08:00h';
        $chain->closure_hour = '22:00';
        $chain->shop_owner_id = user::where('email', 'bahaeddineb@outlook.fr')->value('id');
        $chain->shop_id = shop::where('shop_owner_id', $chain->shop_owner_id )->value('id');
        $chain->save();

        $chain1= new chain();
        $chain1->name = 'Carrefour Market ';
        $chain1->adress = 'Les Jardins El Mourouj - tunis -Tunisia';
        $chain1->contact = '70 248 248';
        $chain1->opening_hour = '08:00h';
        $chain1->closure_hour = '22:00';
        $chain1->shop_owner_id = user::where('email', 'bahaeddineb@outlook.fr')->value('id');
        $chain1->shop_id = shop::where('shop_owner_id', $chain1->shop_owner_id )->value('id');
        $chain1->save();

        $chain2= new chain();
        $chain2->name = 'monoprix Bardo ';
        $chain2->adress = 'tunis, Tunisia';
        $chain2->contact = '71 580 415';
        $chain2->opening_hour = '08:00h';
        $chain2->closure_hour = '23:00';
        $chain2->shop_owner_id = user::where('email', 'safwen@outlook.fr')->value('id');
        $chain2->shop_id = shop::where('shop_owner_id', $chain2->shop_owner_id )->value('id');
        $chain2->save();

        $chain3= new chain();
        $chain3->name = 'monoprix Express ';
        $chain3->adress = 'Place Mizene, Tunis, Tunisia';
        $chain3->contact = '71 751 429';
        $chain3->opening_hour = '08:00h';
        $chain3->closure_hour = '23:00';
        $chain3->shop_owner_id = user::where('email', 'safwen@outlook.fr')->value('id');
        $chain3->shop_id = shop::where('shop_owner_id', $chain3->shop_owner_id )->value('id');
        $chain3->save();
    }
}
