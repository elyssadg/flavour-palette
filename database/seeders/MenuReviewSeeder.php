<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\MenuReview;

class MenuReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($menuId)
    {
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[1],
            'rating' => 5.0,
            'review_message' => 'Bagus makanan enak dan roger suka'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[0],
            'rating' => 5.0,
            'review_message' => 'Banyak'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[1],
            'rating' => 4.0,
            'review_message' => 'Murah'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[2],
            'rating' => 1.0,
            'review_message' => 'Kureng'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[3],
            'rating' => 5.0,
            'review_message' => 'Murah'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[3],
            'rating' => 3.5,
            'review_message' => 'Kureng'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[4],
            'rating' => 5.0,
            'review_message' => 'Makanan ini luar biasa! Rasanya enak dan menggugah selera.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[4],
            'rating' => 5.0,
            'review_message' => 'Saya sangat terkesan dengan kualitas makanan yang disajikan di sini.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[5],
            'rating' => 5.0,
            'review_message' => 'Saya akan merekomendasikan menu ini kepada semua orang.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[5],
            'rating' => 5.0,
            'review_message' => 'Porsi makanan yang disajikan sangatlah besar dan puas.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[6],
            'rating' => 5.0,
            'review_message' => 'Rasa bumbu pada menu ini sangatlah nikmat.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[6],
            'rating' => 5.0,
            'review_message' => 'Harga makanan di sini sangat terjangkau, tetapi kualitasnya tetap tinggi.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[7],
            'rating' => 5.0,
            'review_message' => 'Makanan di sini sangatlah lezat. Setiap gigitan memberikan kepuasan yang luar biasa.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[7],
            'rating' => 4.0,
            'review_message' => 'Porsi makanan yang disajikan sangatlah melimpah. Tidak akan membuat Anda kelaparan.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[8],
            'rating' => 5.0,
            'review_message' => 'Saya sangat merekomendasikan untuk mencoba menu ini'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[8],
            'rating' => 5.0,
            'review_message' => 'Saya senang dengan pengemasan katering online ini. Makanannya tiba dengan aman dan tetap segar.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[9],
            'rating' => 5.0,
            'review_message' => 'Katering ini benar-benar memperhatikan detail. Kemasan makanannya rapi dan terlihat menarik.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[9],
            'rating' => 5.0,
            'review_message' => 'Pesanan saya tiba tepat waktu dan makanan masih dalam kondisi segar. Layanan pengantaran yang sangat baik!'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[10],
            'rating' => 5.0,
            'review_message' => 'Menu iniluar biasa! Rasanya enak banget, bikin nagih terus.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[10],
            'rating' => 5.0,
            'review_message' => 'menunya juara! Gak pernah kecewa dengan variasi hidangannya.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[11],
            'rating' => 5.0,
            'review_message' => 'Rasa hidangannya pas banget di lidah. Bumbunya nendang tapi gak bikin eneg.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[11],
            'rating' => 5.0,
            'review_message' => 'Rasanya konsisten banget, tiap kali pesan selalu enak dan memuaskan.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[12],
            'rating' => 5.0,
            'review_message' => 'Penyajian makanannya cantik banget, jadi pengen langsung makan. Bukan cuma tampilan doang, rasanya juga oke!'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[12],
            'rating' => 5.0,
            'review_message' => 'Saya suka kualitas bahan makanannya. Segar dan berkualitas tinggi, bikin makan jadi lebih nikmat.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[13],
            'rating' => 5.0,
            'review_message' => 'Menu ini ramah buat anak-anak. Anak saya suka banget sama makanannya.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[13],
            'rating' => 5.0,
            'review_message' => 'Menu ini sangat cocok untuk acara sarapan'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[14],
            'rating' => 3.0,
            'review_message' => 'Paketnya cukup komplet, tetapi rasanya tidak selalu memuaskan.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[14],
            'rating' => 4.0,
            'review_message' => 'Kualitas makanan dalam menu katering online ini biasa saja. Tidak ada yang membuat saya terkesan secara khusus.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[15],
            'rating' => 5.0,
            'review_message' => 'Menu katering onlinenya top markotop! Rasanya enak parah, gak bisa berenti makan.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[15],
            'rating' => 5.0,
            'review_message' => 'Makanannya bikin puas maksimal, porsinya juga gak pelit.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[16],
            'rating' => 5.0,
            'review_message' => 'Rasanya enak banget. Bumbunya dapet, gak terlalu berlebihan.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[16],
            'rating' => 5.0,
            'review_message' => 'Tampilan makanannya keren banget, bikin pengen langsung makan. Rasanya juga gak kalah enak!'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[17],
            'rating' => 3.0,
            'review_message' => 'Menu katering online ini so-so saja. Ada beberapa hidangan yang enak, tapi ada juga yang biasa saja.'
        ]);
        MenuReview::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[17],
            'rating' => 4.0,
            'review_message' => 'Rasanya makanan ini standar. Tidak ada yang istimewa atau menonjol.'
        ]);
    }
}
