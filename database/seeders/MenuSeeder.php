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
                'name' => 'Tahu Campur',
                'description' => 'Telur yang diolah bersama kentang, bawang, dan bumbu-bumbu spesial'
            ],
            // Add more menu items here
            [
                'name' => 'Nasi Goreng',
                'description' => 'Nasi yang digoreng dengan bumbu dan ditambahkan dengan sayuran serta daging atau udang'
            ],
            [
                'name' => 'Ayam Bakar',
                'description' => 'Potongan ayam yang dibakar dengan bumbu rempah-rempah, disajikan dengan nasi dan lalapan'
            ],
            [
                'name' => 'Sate Ayam',
                'description' => 'Ikan yang dibumbui dan ditusuk pada tusukan bambu, kemudian dibakar dan disajikan dengan saus kacang'
            ],
            // Add 30 more menu items here
            [
                'name' => 'Soto Betawi',
                'description' => 'Soto dengan kuah santan kental dan daging sapi, dilengkapi dengan kerupuk, perkedel, dan sambal'
            ],
            [
                'name' => 'Gado-gado',
                'description' => 'Campuran sayuran seperti kacang panjang, tauge, dan lontong disiram dengan bumbu kacang'
            ],
            [
                'name' => 'Rendang',
                'description' => 'Daging sapi yang dimasak dalam santan dan bumbu rempah-rempah hingga empuk dan berkuah kental'
            ],
            [
                'name' => 'Gulai Ayam',
                'description' => 'Ayam yang dimasak dalam kuah gulai kental dengan bumbu rempah-rempah'
            ],
            [
                'name' => 'Nasi Uduk',
                'description' => 'Nasi yang dimasak dengan santan dan dibumbui dengan rempah-rempah, disajikan dengan lauk dan pelengkap'
            ],
            [
                'name' => 'Ikan Bakar',
                'description' => 'Ikan yang dibakar dengan bumbu rempah-rempah, disajikan dengan nasi, sambal, dan lalapan'
            ],
            [
                'name' => 'Pempek',
                'description' => 'Makanan khas Palembang berupa adonan tepung ikan yang digoreng dan disajikan dengan kuah cuka'
            ],
            [
                'name' => 'Mie Goreng',
                'description' => 'Mie yang digoreng dengan bumbu dan ditambahkan dengan sayuran serta daging atau udang'
            ],
            [
                'name' => 'Soto Ayam',
                'description' => 'Soto dengan kuah kaldu ayam yang kaya rasa, dilengkapi dengan potongan ayam, mie, dan bumbu pelengkap'
            ],
            [
                'name' => 'Nasi Kuning',
                'description' => 'Nasi yang dimasak dengan kunyit, memiliki aroma khas, disajikan dengan lauk dan pelengkap'
            ],
            [
                'name' => 'Bakso',
                'description' => 'Adonan daging yang digiling dan dibentuk bulat-bulat, disajikan dengan kuah, mie, dan pelengkap'
            ],
            [
                'name' => 'Sayur Asem',
                'description' => 'Sayuran yang dimasak dengan kuah asam yang segar dan disajikan dengan nasi'
            ],
            [
                'name' => 'Sate Padang',
                'description' => 'Daging yang dipotong kecil-kecil, ditusuk pada tusukan bambu, dan disajikan dengan kuah kacang kental'
            ],
            [
                'name' => 'Martabak',
                'description' => 'Adonan yang digoreng dengan bumbu dan diisi dengan telur, daging, sayuran, atau cokelat'
            ],
            [
                'name' => 'Pecel Lele',
                'description' => 'Ikan lele yang digoreng kering, disajikan dengan nasi, sambal, dan lalapan'
            ],
            [
                'name' => 'Rawon',
                'description' => 'Semangkuk sup daging berkuah hitam dengan aroma khas, disajikan dengan nasi, tauge, dan pelengkap'
            ],
            [
                'name' => 'Sop Buntut',
                'description' => 'Sup dengan bahan dasar buntut sapi yang dimasak hingga empuk, disajikan dengan nasi'
            ],
            [
                'name' => 'Pisang Goreng',
                'description' => 'Pisang yang digoreng dengan adonan tepung hingga renyah, biasanya disajikan dengan saus atau taburan gula'
            ],
            [
                'name' => 'Nasi Campur',
                'description' => 'Nasi yang disajikan dengan berbagai lauk seperti ayam, babi, sayuran, telur, dan sambal'
            ],
            [
                'name' => 'Sate Kambing',
                'description' => 'Daging kambing yang dipotong kecil-kecil, ditusuk pada tusukan bambu, dan dibakar, disajikan dengan saus kacang'
            ],
            [
                'name' => 'Ketoprak',
                'description' => 'Makanan khas Betawi yang terdiri dari lontong, tahu, tauge, bihun, dan bumbu kacang'
            ],
            [
                'name' => 'Pempek Palembang',
                'description' => 'Makanan khas Palembang berupa adonan tepung ikan yang digoreng dan disajikan dengan kuah cuka'
            ],
            [
                'name' => 'Soto Betawi',
                'description' => 'Soto dengan kuah santan kental dan daging sapi, dilengkapi dengan kerupuk, perkedel, dan sambal'
            ],
            [
                'name' => 'Nasi Goreng Seafood',
                'description' => 'Nasi goreng dengan tambahan seafood seperti udang, cumi-cumi, dan ikan, dilengkapi dengan sayuran dan bumbu rempah-rempah'
            ],
            [
                'name' => 'Ayam Penyet',
                'description' => 'Potongan ayam yang digoreng hingga renyah, kemudian ditumbuk hingga pipih, disajikan dengan sambal dan lalapan'
            ],
            [
                'name' => 'Pisang Molen',
                'description' => 'Pisang yang dibalut dengan adonan tepung dan digoreng hingga renyah, biasanya disajikan sebagai kue'
            ],
            [
                'name' => 'Sop Iga Sapi',
                'description' => 'Sup dengan bahan dasar iga sapi yang dimasak hingga empuk, disajikan dengan nasi'
            ],
            [
                'name' => 'Sambal Goreng Ati',
                'description' => 'Potongan hati ayam atau babi yang dimasak dengan bumbu rempah-rempah dan disajikan dengan nasi'
            ],
            [
                'name' => 'Gulai Kambing',
                'description' => 'Gulai dengan bahan dasar daging kambing yang dimasak dalam kuah kental dengan bumbu rempah-rempah'
            ],
        ];

        for ($i = 0; $i < (18 + count($menus)) ; $i++) {
            $menuId[] = Str::uuid()->toString();
        }

        $counter = 0;

        Menu::create([
            'id' => $menuId[0],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam Keju',
            'price' => 15000,
            'status' => 'available',
            'description' => 'Ayam dengan bumbu keju'
        ]);

        Menu::create([
            'id' => $menuId[1],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam Coklat',
            'price' => 25000,
            'status' => 'available',
            'description' => 'Ayam dengan bumbu Coklat'
        ]);

        Menu::create([
            'id' => $menuId[2],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam Kriuk',
            'price' => 30000,
            'status' => 'available',
            'description' => 'Ayam Kriuk'
        ]);

        Menu::create([
            'id' => $menuId[3],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam',
            'price' => 24000,
            'status' => 'available',
            'description' => 'Ayam dengan bumbu keju'
        ]);

        Menu::create([
            'id' => $menuId[4],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam Bakar Kecap',
            'price' => 30000,
            'status' => 'available',
            'description' => 'Nasi dengan lalapan dan Potongan ayam bakar dengan kecap'
        ]);

        Menu::create([
            'id' => $menuId[5],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Goreng Special',
            'price' => 25000,
            'status' => 'available',
            'description' => 'Nasi goreng dengan tambahan daging ayam, sosis, sayuran dan telur'

        ]);

        Menu::create([
            'id' => $menuId[6],
            'seller_id' => $sellerId[0],
            'name' => 'Spagetti Bolognese',
            'price' => 45000,
            'status' => 'available',
            'description' => 'Spagetti dengan saus bolognese dan daging sapi cincang'

        ]);

        Menu::create([
            'id' => $menuId[7],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Uduk Komplit',
            'price' => 25000,
            'status' => 'available',
            'description' => 'Nasi uduk dengan lauk seperti ayam goreng, telur dadar dan tempe goreng'

        ]);

        Menu::create([
            'id' => $menuId[8],
            'seller_id' => $sellerId[0],
            'name' => 'Ayam Parmesan',
            'price' => 45000,
            'status' => 'available',
            'description' => 'potongan ayam yang digoreng dengan tepungg dan dilumuri saus tomat dan keju mozarella dengan tambahan spagetti'

        ]);

        Menu::create([
            'id' => $menuId[9],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Goreng Seafood',
            'price' => 35000,
            'status' => 'archived',
            'description' => 'Nasi goreng dengan campuran seafood dan disajikan dengan telur mata sapi'

        ]);

        Menu::create([
            'id' => $menuId[10],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam Taliwang',
            'price' => 30000,
            'status' => 'archived',
            'description' => 'Nasi dengan potongan ayam bakar dengan bumbu khas taliwag yang pedas'

        ]);

        Menu::create([
            'id' => $menuId[11],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ikan Asam Manis',
            'price' => 35000,
            'status' => 'archived',
            'description' => 'Nasi dengan tambahan ikan goreng dengan saus asam manis dan disajikan dengan irisan bawang merah dan paprika'

        ]);

        Menu::create([
            'id' => $menuId[12],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Tim Ayam',
            'price' => 25000,
            'status' => 'archived',
            'description' => 'Nasi tim dengan potongan daging ayam, jamur, dan telur yang dimasak dengan bumbu special'

        ]);

        Menu::create([
            'id' => $menuId[13],
            'seller_id' => $sellerId[0],
            'name' => 'Bubur Ayam',
            'price' => 18000,
            'status' => 'available',
            'description' => 'Bubur nasi dengan irisan daging ayam, telur, dan bawang goreng'

        ]);

        Menu::create([
            'id' => $menuId[14],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ayam Rica-Rica',
            'price' => 35000,
            'status' => 'available',
            'description' => 'Potongan ayam dengan bumbu rica-rica pedas'

        ]);

        Menu::create([
            'id' => $menuId[15],
            'seller_id' => $sellerId[0],
            'name' => 'Mie Goreng jawa',
            'price' => 28000,
            'status' => 'available',
            'description' => 'Mie goreng dengan bumbu khas jawa seperti kecap manis, cabai, dan irisan ayam'

        ]);

        Menu::create([
            'id' => $menuId[16],
            'seller_id' => $sellerId[0],
            'name' => 'Nasi Ikan Goreng Sambal Matah',
            'price' => 35000,
            'status' => 'available',
            'description' => 'Nasi dengan Ikan yang digoreng garung disajikan dengan sambal matah segar'

        ]);

        Menu::create([
            'id' => $menuId[17],
            'seller_id' => $sellerId[0],
            'name' => 'Tahu Telur',
            'price' => 15000,
            'status' => 'deleted',
            'description' => 'Tahu yang diolah bersama telur, bawang dan bumbu-bumbu spesial'
        ]);


        $counter = 18;

        foreach ($menus as $menu) {
            Menu::create([
                'id' => $menuId[$counter++],
                'seller_id' => $sellerId[0],
                'name' => $menu['name'],
                'price' => mt_rand(15, 50) * 1000,
                'status' => 'available',
                'description' => $menu['description']
            ]);
        }

        return $menuId;
    }
}
