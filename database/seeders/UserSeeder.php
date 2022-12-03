<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrator',
            'username' => Str::slug('Administrator'),
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Ilmi Faizan',
            'username' => Str::slug('icang1112'),
            'email' => 'ilmifaizan1112@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        User::factory(38)->create();

        // DATA DUMMY PENGELOLA
        User::factory()->create([
            'name' => 'User 1',
            'username' => Str::slug('User 1'),
            'email' => 'user1@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 41,
            'no_rek' => '2368126387652 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'User 2',
            'username' => Str::slug('User 2'),
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 42,
            'no_rek' => '3499892748789 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'User 3',
            'username' => Str::slug('User 3'),
            'email' => 'user3@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 43,
            'no_rek' => '2132716675 (BNI)'
        ]);
        User::factory()->create([
            'name' => 'User 4',
            'username' => Str::slug('User 4'),
            'email' => 'user4@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 44,
            'no_rek' => '398478979712 (BCA)'
        ]);
        User::factory()->create([
            'name' => 'User 5',
            'username' => Str::slug('User 5'),
            'email' => 'user5@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 45,
            'no_rek' => '78973467234324 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'User 6',
            'username' => Str::slug('User 6'),
            'email' => 'user6@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 46,
            'no_rek' => '532645376245765 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'User 7',
            'username' => Str::slug('User 7'),
            'email' => 'user7@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 47,
            'no_rek' => '7467267246576 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'User 8',
            'username' => Str::slug('User 8'),
            'email' => 'user8@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 48,
            'no_rek' => '98786545646564 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'User 9',
            'username' => Str::slug('User9'),
            'email' => 'user9@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 49,
            'no_rek' => '6556752657567 (BRI)'
        ]);
        User::factory()->create([
            'name' => 'Yayat',
            'username' => Str::slug('yayat'),
            'email' => 'auliyarahman1904@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        User::factory(120)->create();
    }
}
