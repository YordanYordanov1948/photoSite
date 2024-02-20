<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PhotosTableSeeder extends Seeder
{
    public function run()
    {

        $user = User::first();

        if ($user) {
            foreach (range(1, 10) as $index) {
                DB::table('photos')->insert([
                    'title' => 'Panda ' . $index,
                    'image_path' => 'images/panda.jpg',
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // Optionally handle the case where no users are found
            echo "No users found. Cannot seed photos without a user.";
        }
    }
}
