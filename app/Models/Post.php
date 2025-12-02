<?php

namespace App\Models;

use Illuminate\Support\Arr;
// Kalo di image_url gausah pakai routing folder /image karena langsung akses ke public folder
class Post {
    public static function all()
    {
    return [
        [
            'slug' => 'sejarah-bank-sampah',
            'title' => 'Sejarah Bank Sampah di Indonesia',
            'author' => 'Tim RRC',
            'body' => "Bank sampah di Indonesia berawal dari kebutuhan mendesak untuk mengatasi meningkatnya jumlah sampah rumah tangga dan kurangnya sistem pengelolaan yang efektif. Konsep ini mulai berkembang pada tahun 2008 ketika masyarakat di Bantul, Yogyakarta, memperkenalkan Bank Sampah Gemah Ripah sebagai model awal. Sistem ini terinspirasi dari mekanisme perbankan tradisional: masyarakat “menabung” sampah yang sudah dipilah berdasarkan jenisnya, lalu memperoleh nilai setara uang yang dicatat dalam buku tabungan.

Model tersebut mendapatkan respons positif karena memberikan dua manfaat penting secara bersamaan: meningkatkan kesadaran masyarakat untuk memilah sampah, serta memberikan nilai ekonomi tambahan bagi keluarga. Seiring berjalannya waktu, konsepsi bank sampah berkembang dari sekadar program komunitas menjadi gerakan nasional. Pemerintah kemudian mendukung pembentukan bank sampah melalui regulasi, pendampingan, dan program kebersihan di tingkat desa hingga kota.

Dalam satu dekade, bank sampah tumbuh pesat di seluruh Indonesia, mencakup sekolah, perumahan, organisasi masyarakat, bahkan institusi pemerintahan. Bank sampah bukan hanya tempat penampungan sampah, tetapi juga pusat edukasi pengelolaan lingkungan, pengurangan sampah ke TPA, serta penguatan ekonomi sirkular berbasis komunitas.",
            'image_url' => 'landing.png',
            'label' => 'Edukasi',
            // include a time so blade can render jam alongside tanggal
            'created_at' => '2025-11-09 09:15:00',
            'tag1' => 'DaurUlang',
            'tag2' => 'TeknologiHijau',
        ],
        [
            'slug' => 'kampanye-bersih-bersih-pantai-ribuan-relawan-beraksi-melawan-sampah-plastik',
            'title' => 'Kampanye Bersih-Bersih Pantai: Ribuan Relawan Beraksi',
            'author' => 'Lina Susanti',
            'body' => "Kampanye bersih-bersih pantai yang melibatkan ribuan relawan berhasil mengumpulkan ton limbah plastik dan sampah lainnya. Aksi ini menyoroti pentingnya kolaborasi masyarakat, pemerintah, dan organisasi swadaya untuk mencegah sampah masuk ke laut.",
            'image_url' => 'tas.jpg',
            'label' => 'Konservasi',
            'created_at' => '2025-11-11 14:30:00',
            'tag1' => 'Konservasi',
            'tag2' => 'Lingkungan',
        ],
        [
            'slug' => 'teknologi-daur-ulang-plastik-canggih-bantu-pulihkan-ekosistem-laut',
            'title' => 'Teknologi Daur Ulang Plastik Mutakhir untuk Laut',
            'author' => 'Andi Wijaya',
            'body' => "Perusahaan teknologi lingkungan memperkenalkan proses daur ulang plastik canggih yang mengubah sampah plastik menjadi bahan bakar bersih dan bahan baku industri. Pendekatan ini dapat mengurangi akumulasi plastik di pesisir dan mendukung pemulihan ekosistem laut jika diterapkan dalam skala luas.",
            'image_url' => 'botol.png',
            'label' => 'Teknologi',
            'created_at' => '2025-11-13 08:45:00',
            'tag1' => 'Teknologi',
            'tag2' => 'Inovasi',
        ],
        
    ];
    }

    public static function find($slug): array
    {
        $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);
        if(!$post){
            abort(404);
        } 
        return $post;
    }
}