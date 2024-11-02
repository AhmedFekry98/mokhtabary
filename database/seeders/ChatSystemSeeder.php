<?php

namespace Database\Seeders;

use App\Features\Chat\Models\Chat;
use App\Features\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Create 10 users
            $users = User::take(10)->get();


            // Create 5 chat rooms and assign users to each
            for ($j = 1; $j <= 5; $j++) {
                $chat = Chat::create([
                    'name' => 'Chat Room ' . $j,
                ]);

                // Attach a random selection of users to each chat
                $chat->users()->attach(
                    collect($users)->random(rand(2, 5))->pluck('id')->toArray()
                );

                // Generate messages for each chat
                for ($k = 0; $k < 20; $k++) {
                    $chat->messages()->create([
                        'sender_id' => $chat->users->random()->id,
                        'content' => "Message $k in Chat Room $j",
                    ]);
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
