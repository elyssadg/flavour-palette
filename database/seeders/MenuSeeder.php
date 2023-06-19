<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $menuId = [];

    public function run($sellerId)
    {
        $menus = [
            [
                'name' => 'Fried Rice',
                'description' => 'Fried rice with spices and added with vegetables and chicken and sausages',
                'profile_menu' => 'fried_Rice.jpg'
            ],
            [
                'name' => 'Grilled Chicken',
                'description' => 'Chicken pieces grilled with spices, served with rice and lalapan',
                'profile_menu' => 'Grilled_Chicken.jpg'
            ],
            [
                'name' => 'Soto Betawi',
                'description' => 'Soto with thick coconut milk and beef, accompanied by crackers, cakes, and chili sauce',
                'profile_menu' => 'Soto_Betawi.png'
            ],
            [
                'name' => 'Gado Gado',
                'description' => 'Mixed vegetables such as long beans, bean sprouts and lontong are smothered in peanut sauce',
                'profile_menu' => 'Gado_gado.jpg'
            ],
            [
                'name' => 'Rendang',
                'description' => 'Beef cooked in coconut milk and spices until tender and thick gravy',
                'profile_menu' => 'rendang.png'
            ],
            [
                'name' => 'Indonesian chicken curry',
                'description' => 'Chicken cooked in thick curry sauce with spices',
                'profile_menu' => 'Ayam_Gulai.jpg'
            ],
            [
                'name' => 'Uduk Rice',
                'description' => 'Rice cooked in coconut milk and seasoned with spices, served with side dishes and accompaniments',
                'profile_menu' => 'Nasi_Uduk.jpg'
            ],
            [
                'name' => 'Fried Noodles',
                'description' => 'Fried noodles with spices and added with vegetables and meat or shrimp',
                'profile_menu' => 'fried_noodles.jpg'
            ],
            [
                'name' => 'Indonesian Chicken Soto',
                'description' => 'Soto with rich chicken broth, complemented by pieces of chicken, noodles, and complementary seasonings',
                'profile_menu' => 'Chicken_Soto.jpg'
            ],
            [
                'name' => 'Yellow Rice',
                'description' => 'Rice cooked with turmeric, has a distinctive aroma, served with side dishes and accompaniments',
                'profile_menu' => 'Yellow_Rice.jpg'
            ],
            [
                'name' => 'Padang Satay',
                'description' => 'The meat is cut into small pieces, skewered on bamboo skewers, and served with thick peanut sauce',
                'profile_menu' => 'Padang_Satay.jpg'
            ],
            [
                'name' => 'Rawon',
                'description' => 'A bowl of black soup with a distinctive aroma, served with rice, bean sprouts, and accompaniments',
                'profile_menu' => 'Rawon.jpg'
            ],
            [
                'name' => 'Oxtail Soup',
                'description' => 'Soup with the basic ingredients of oxtail cooked until tender, served with rice',
                'profile_menu' => 'Oxtail_Soup.jpeg'
            ],
            [
                'name' => 'Mixed Rice',
                'description' => 'Rice served with various side dishes such as chicken, pork, vegetables, eggs and chili sauce',
                'profile_menu' => 'Mixed_Rice.jpg'
            ],
            [
                'name' => 'Goat Satay',
                'description' => 'Mutton cut into small pieces, skewered on bamboo skewers, and grilled, served with peanut sauce',
                'profile_menu' => 'Goat_Satay.jpg'
            ],
            [
                'name' => 'Palembang pempek',
                'description' => 'Palembang special food is fish flour dough that is fried and served with vinegar sauce',
                'profile_menu' => 'Palembang_Pempek.jpg'
            ],
            [
                'name' => 'Goat Curry',
                'description' => 'Goulash with basic ingredients of mutton cooked in thick gravy with spices',
                'profile_menu' => 'Goat_Curry.jpg'
            ],
            [
                'name' => 'Seafood Fried Rice',
                'description' => 'Fried rice with additional seafood such as shrimp, squid and fish, complemented by vegetables and spices',
                'profile_menu' => 'Seafood_Friedrice.jpg'
            ],
            [
                'name' => 'Penyet Chicken',
                'description' => 'Pieces of chicken fried until crispy, then pounded into a flat, served with chili sauce and fresh vegetables',
                'profile_menu' => 'Penyet_Chicken.jpg'
            ],
            [
                'name' => 'Beef Rib Soup',
                'description' => 'Soup made from beef ribs cooked until tender, served with rice',
                'profile_menu' => 'Beef_Rib_Soup.jpg'
            ],
            [
                'name' => 'Chicken Katsu',
                'description' => 'Fried Chicken in Japanese Style, with rice and sauces',
                'profile_menu' => 'katsu.jpeg'
            ],
        ];

        for ($i = 0; $i < (count($menus)) ; $i++) {
            $menuId[] = Str::uuid()->toString();
        }

        $counter = 0;

        foreach ($menus as $menu) {
            Menu::create([
                'id' => $menuId[$counter++],
                'seller_id' => $sellerId[rand(0,0)],
                'name' => $menu['name'],
                'profile_menu' => $menu['profile_menu'],
                'price' => mt_rand(15, 50) * 1000,
                'status' => 'available',
                'description' => $menu['description']
            ]);
        }

        return $menuId;
    }
}
