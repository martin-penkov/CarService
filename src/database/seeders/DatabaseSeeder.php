<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('bg_BG');

        // Създаваме администраторски потребител
        DB::table('users')->insert([
            'name'              => 'Администратор',
            'email'             => 'admin@carservice.bg',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Тестов потребител
        DB::table('users')->insert([
            'name'              => 'Иван Иванов',
            'email'             => 'ivan@example.bg',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Видове услуги
        $services = [
            ['name' => 'Смяна на масло', 'description' => 'Пълна смяна на двигателно масло и маслен филтър', 'price' => 60.00, 'duration_minutes' => 30],
            ['name' => 'Смяна на спирачни накладки', 'description' => 'Смяна на предни или задни спирачни накладки', 'price' => 120.00, 'duration_minutes' => 60],
            ['name' => 'Смяна на гуми', 'description' => 'Сваляне, монтаж и балансиране на 4 гуми', 'price' => 80.00, 'duration_minutes' => 45],
            ['name' => 'Диагностика', 'description' => 'Компютърна диагностика на всички системи', 'price' => 40.00, 'duration_minutes' => 30],
            ['name' => 'Смяна на ангренажен ремък', 'description' => 'Комплектна смяна на ангренажен ремък с обтягачи', 'price' => 350.00, 'duration_minutes' => 240],
            ['name' => 'Смяна на акумулатор', 'description' => 'Монтаж на нов акумулатор', 'price' => 25.00, 'duration_minutes' => 20],
            ['name' => 'Климатична система', 'description' => 'Зареждане и проверка на климатичната система', 'price' => 90.00, 'duration_minutes' => 60],
            ['name' => 'Преден преглед', 'description' => 'Проверка на предна ходова част, рулево управление', 'price' => 50.00, 'duration_minutes' => 45],
        ];

        foreach ($services as $service) {
            DB::table('services')->insert(array_merge($service, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Марки и модели коли
        $carData = [
            ['make' => 'Volkswagen', 'model' => 'Golf'],
            ['make' => 'Volkswagen', 'model' => 'Passat'],
            ['make' => 'BMW', 'model' => '3 Series'],
            ['make' => 'BMW', 'model' => '5 Series'],
            ['make' => 'Mercedes-Benz', 'model' => 'C-Class'],
            ['make' => 'Toyota', 'model' => 'Corolla'],
            ['make' => 'Opel', 'model' => 'Astra'],
            ['make' => 'Ford', 'model' => 'Focus'],
            ['make' => 'Renault', 'model' => 'Megane'],
            ['make' => 'Skoda', 'model' => 'Octavia'],
        ];

        // Добавяме 15 коли
        foreach (range(1, 15) as $i) {
            $carInfo = $carData[array_rand($carData)];
            DB::table('cars')->insert([
                'user_id'    => rand(1, 2),
                'make'       => $carInfo['make'],
                'model'      => $carInfo['model'],
                'year'       => rand(2005, 2023),
                'plate'      => strtoupper($faker->bothify('??####??')),
                'vin'        => strtoupper($faker->bothify('?????????????????')),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Добавяме 30 ремонта
        $statuses = ['pending', 'in_progress', 'completed', 'cancelled'];
        foreach (range(1, 30) as $i) {
            DB::table('repairs')->insert([
                'car_id'      => rand(1, 15),
                'service_id'  => rand(1, 8),
                'repair_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'notes'       => $faker->optional()->sentence(),
                'total_price' => rand(40, 500),
                'status'      => $statuses[array_rand($statuses)],
                'mileage'     => rand(20000, 250000),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
