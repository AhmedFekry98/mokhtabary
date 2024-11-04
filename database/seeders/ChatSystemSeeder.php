<?php

namespace Database\Seeders;

use App\Features\Chat\Models\Chat;
use App\Features\User\Models\User;
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
            $admin = User::first();
            $labs = User::whereHas('roles', fn($q) => $q->whereName('lab'))
                ->take(5)
                ->get();


            foreach ($labs as $lab) {

                $chat = Chat::create();
                $chat->users()->attach([$admin->id, $lab->id]);
                $chat->messages()

                ->createMany([
                    [
                        'sender_id' => $lab->id,
                        'content' => 'Hi'
                    ],
                    [
                        'sender_id' => $admin->id,
                        'content' => 'Welcome'
                    ],
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
