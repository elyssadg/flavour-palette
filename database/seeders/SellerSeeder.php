<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($userId)
    {
        for ($i = 0; $i < (15) ; $i++) {
            $sellerId[] = Str::uuid()->toString();
        }

        $counter = 0;
        $counters = 1;

        Seller::create([
            'id' => $sellerId[$counter++],
            'user_id' => $userId[$counters++],
            'name' => 'Vije Catering',
            'description' => 'Catering yummy top 1 Indonesia',
            'store_rating' => 5,
            'halal_certification' => '1686811274.png',
            'business_permit' => '1686811296.png',
            'address' => 'Selokan Sudirman',
            'opening_hour' => '10:00:00',
            'closing_hour' => '00:00:00'
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'Lauk Bento',
                'description' => 'Dari central kitchen di Jakarta, kami menyiapkan ribuan porsi catering setiap harinya untuk dikirim ke kantor-kantor, rumah, maupun apartment di daerah Jabodetabek.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Green Lake City Rukan CBD Block C No.67, Cipondoh - Tangerang. Banten',
                'opening_hour' => '10:00:00',
                'closing_hour' => '22:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'erica catering',
                'description' => 'Dengan Motto, Clean, Healthy, and Delicious, Erica Catering berkomitmen untuk menyajikan kualitas terbaik dari setiap sajian yang ditawarkan, dengan bahan segar "Fresh From The Market Every Day", diolah secara higienis, serta dimasak oleh koki handal yang telah berpengalaman selama lebih dari 20 tahun dalam memasak aneka kuliner Nusantara dan Chinese Cuisine.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. San Lorenzo II No.9, Gading, Kec. Serpong, Kabupaten Tangerang, Banten 15810',
                'opening_hour' => '07:00:00',
                'closing_hour' => '20:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'dapur pangeran',
                'description' => 'Dapur Pangeran bangga menjadi salah satu mitra terpercaya BUMN dan perusahaan swasta dalam mengakomodir kebutuhan nasi kotak dan katering premium bertema Nusantara sejak tahun 2016. Kami terus meningkatkan kualitas, mutu makanan, serta pelayanan untuk kepuasan seluruh Sahabat Pangeran, khususnya di wilayah DKI Jakarta dan sekitarnya ',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. Krekot Jaya Molek No.11, RT.7/RW.02, Ps. Baru, Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710',
                'opening_hour' => '09:00:00',
                'closing_hour' => '18:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'dapur djanda',
                'description' => 'Dengan berbagai macam produk yaitu Lunch catering, Ready to eat, dan Chef Meal, kami berharap bahwa kami dapat memudahkan hidup anda, dalam mencari kebutuhan makan atau masak anda.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. Batas Peninggilan, RT.003/RW.009, Paninggilan Utara, Kec. Ciledug, Kota Tangerang, Banten 15153',
                'opening_hour' => '00:00:00',
                'closing_hour' => '23:59:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'catering aja',
                'description' => 'Berdiri sejak tahun 2018. Cateringaja sendiri telah diendorse oleh beberapa artis tanah air, seperti Ivan Gunawan, Ruben Onsu, Sule, Roy Kiyoshi, Barbie Kumalasari, Saipul Jamil dan masih banyak artis papan atas lainnya di Indonesia',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Sentra Gading Serpong, Ruko Jl. Boulevard Raya Gading Serpong No.5, Pakulonan Bar., Kec. Klp. Dua, Kabupaten Tangerang, Banten 15810',
                'opening_hour' => '00:00:00',
                'closing_hour' => '23:59:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'martini catering',
                'description' => 'Usaha kami adalah One Stop Shopping pelayanan kebutuhan catering anda. Berdiri sejak tahun 1990an di Tangerang.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. Bumi Mas Raya C1 No. 2, Cikokol, RT.002/RW.003, Cikokol, Kec. Tangerang, Kota Tangerang, Banten 15117',
                'opening_hour' => '00:00:00',
                'closing_hour' => '23:59:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'mymealcatering',
                'description' => 'MyMeal merupakan jasa catering makanan sehat pertama di Indonesia. Sejak tahun 2005, MyMeal dipercaya sebagai catering diet sehat untuk melayani lebih dari 10.000 orang.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Ruko Graha Cikokol, Jl. Jenderal Sudirman No.1K, Kelapa Indah, Tangerang, Tangerang City, Banten 15118',
                'opening_hour' => '08:00:00',
                'closing_hour' => '17:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'dapur sadewa',
                'description' => 'Catering Tangerang Dapur Sadewa  memfokuskan jasa service catering baik untuk individu maupun industri, jika anda membutuhkan jasa service catering untuk acara pernikahan, pembukaan kantor, training, ulang tahun, catering harian, catering nasi box, catering rantangan.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. Rasuna Said, RT.002/RW.002, Pakojan, Kec. Pinang, Kota Tangerang, Banten 15142',
                'opening_hour' => '07:00:00',
                'closing_hour' => '16:00:00',
        ]);
        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'zuliacatering',
                'description' => 'Didukung oleh chef-chef yang handal Zulia Katering menawarkan berbagai makanan khas Nusantara dengan rasa dan kualitas yang terjamin. Kami hadir dengan menawarkan berbagai layanan mulai dari nasi box, tumpeng, snackbox sampai dengan prasmanan.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jalan Kebantenan RT 005, Kel No.52, Pd. Aren, Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15220',
                'opening_hour' => '08:00:00',
                'closing_hour' => '17:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'homey catering',
                'description' => 'Kami melayani jasa catering rumah dan juga menerima pesanan Nasi Box, Lunch Box, Bento, Snack Box untuk event/acara atau kantor. Kami menawarkan mutu terbaik di setiap pelayanan catering kami, dan harga terjangkau untuk setiap menu.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jalan Boulevard Gading Serpong Ruko Glaze 2 Blok B no 1, Klp. Dua, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15810',
                'opening_hour' => '09:00:00',
                'closing_hour' => '21:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'ong catering',
                'description' => 'ong catering melayani setiap hari setiap saat untuk setiap orang seperti mahasiswa, kantoran, rumahan, dan masih banyak lagi.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Ruko Santa Monica, Jl. Boulevard Raya Gading Serpong Jl. Pelepah Indah Raya No.31, Klp. Dua, Kec. Klp. Dua, Kabupaten Tangerang, Banten 15810',
                'opening_hour' => '07:00:00',
                'closing_hour' => '23:00:00',
        ]);

        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'tigadaracatering',
                'description' => 'tigadaracatering, Kami menawarkan berbagai macam produk untuk kebutuhan asupan harian Anda.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. Raya Gg. Chober No.13, RT.4/RW.1, Kembangan Sel., Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11610',
                'opening_hour' => '09:00:00',
                'closing_hour' => '16:00:00',
        ]);
        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'homade',
                'description' => 'Homade bergerak didalam industri food & beverages yang memiliki standar kesehatan, rasa, kualitas yang tinggi, namun harganya sangat terjangkau.',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Jl. Swadaya II No.45D, Tj. Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520',
                'opening_hour' => '09:00:00',
                'closing_hour' => '17:00:00',
        ]);
        Seller::create([
            'id' => $sellerId[$counter++],
                'user_id' => $userId[$counters++],
                'name' => 'stevi catering',
                'description' => 'Stevi Catering berdiri sejak tahun 1990. Hingga kini, kami telah melayani banyak perusahaan dan rumah tangga, khususnya di wilayah Jabotabek. Untuk terus meningkatkan mutu & pelayanan, kami menggunakan peralatan masak yang modern, full stainless steel dan menggunakan air bersih',
                'store_rating' => 0,
                'halal_certification' => '1686811274.png',
                'business_permit' => '1686811296.png',
                'address' => 'Perumahan Taman Kedoya Permai Blok A-1/18, RT.5/RW.7, Kebon Jeruk, Kebonjeruk, West Jakarta City, Jakarta 11530',
                'opening_hour' => '07:00:00',
                'closing_hour' => '19:00:00',
        ]);

        return $sellerId;
    }
}
