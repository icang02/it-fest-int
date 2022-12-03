<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'user_id' => 41,
            'name' => "D'Masiv Live In Concert",
            'place' => 'Tugu MTQ Kota Kendari',
            'description' => "Band musik nasional, D'Masiv bakal menghibur masyarakat Sulawesi Tenggara (Sultra) pada acara bertajuk D'Masiv Live In Concert yang dipersembahkan Berduamanagement dan D'Cool Management di area Eks MTQ, Kota Kendari mendatang",
            'ticket_stock' => 100,
            'price' => 75000,
            'phone' => '081341770730',
            'cover' => 'img/cover-konser/dmasiv.jpg',
            'maps' => 'https://goo.gl/maps/XRrSXMa27hhgcgZe7',
            'query' => 'Tugu MTQ Kendari',
            'tgl_mulai' => Carbon::create('2022', '12', '24'),
            'tgl_akhir' => Carbon::create('2022', '12', '27'),
        ]);
        Event::create([
            'user_id' => 41,
            'name' => "The Changcuters Concert",
            'place' => 'FT Teknik',
            'description' => "Kehadiran band rock n roll pelantun I Love U Bibeh itu di Kota Kendari untuk memeriahkan malam puncak Hari Ulang Tahun (HUT) atau milad FT UHO.",
            'ticket_stock' => 120,
            'price' => 50000,
            'phone' => '08137172890',
            'cover' => 'img/cover-konser/changcuters.jpg',
            'maps' => 'https://goo.gl/maps/XRrSXMa27hhgcgZe7',
            'query' => 'Fakultas Teknik UHO',
            'tgl_mulai' => Carbon::create('2022', '11', '29'),
            'tgl_akhir' => Carbon::create('2022', '11', '30'),
        ]);
    }
}
