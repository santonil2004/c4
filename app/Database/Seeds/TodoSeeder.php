<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TodoSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'task'        => $faker->sentence(4),
                'description' => $faker->paragraph(),
                'status'      => $faker->randomElement(['pending', 'in_progress', 'completed']),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $this->db->table('todo')->insert($data);
        }
    }
}
