<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bar = $this->command->getOutput()->createProgressBar(
            count($this->admins())
        );

        $bar->start();

        foreach ($this->admins() as $admin) {
            Admin::factory()->create($admin);
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("\n");
    }

    private function admins()
    {
        return [
            [
                'user_id' => 1,
            ],
        ];
    }
}
