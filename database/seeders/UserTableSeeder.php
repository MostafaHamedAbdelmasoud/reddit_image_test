<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bar = $this->command->getOutput()->createProgressBar(
            count($this->users())
        );

        $bar->start();

        foreach ($this->users() as $user) {
            User::factory()->create($user);
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("\n");
    }

    private function users()
    {
        return [
            [
                'email' => 'admin@demo.com',
                'name' => 'admin',
            ],
            [
                'email' => 'moderator@demo.com',
                'name' => 'moderator',
            ],
        ];
    }
}
