<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop=new shop();
        $shop->name = 'Carrefour Group';
        $shop->adress = '33 Avenue Émile Zola, 92100 Boulogne-Billancourt, France';
        $shop->contact = '01 41 04 26 00';
        $shop->opening_hour = '08:00h';
        $shop->closure_hour = '22:00';
        $shop->tax_identification = '234678969369';
        $shop->shop_owner_id = user::where('email', 'bahaeddineb@outlook.fr')->value('id');
        $shop->save();

        $shop1=new shop();
        $shop1->name = 'monoprix';
        $shop1->adress = '16 rue Marc Bloch, 92116 Clichy, France';
        $shop1->contact = '01 78 99 90 00';
        $shop1->opening_hour = '08:00h';
        $shop1->closure_hour = '22:00';
        $shop1->tax_identification = '234678923897';
        $shop1->shop_owner_id = user::where('email', 'safwen@outlook.fr')->value('id');
        $shop1->save();
    }
}
