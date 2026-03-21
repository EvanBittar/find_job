<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        // جلب المستخدمين لربط الوظائف بهم (كأصحاب عمل)
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->error('Please seed users first!');
            return;
        }

        $categories = ['Web Development', 'Mobile Apps', 'Design', 'Marketing', 'Writing'];
        $natures = ['Full Time', 'Part Time', 'Freelance', 'Remote'];
        $cities = ['Dubai', 'Riyadh', 'Amman', 'Cairo', 'New York'];

        for ($i = 1; $i <= 10; $i++) {
            $city = $cities[array_rand($cities)];

            Job::create([
                'title' => 'Senior Laravel Developer ' . $i,
                'category' => $categories[array_rand($categories)],
                'job_nature' => $natures[array_rand($natures)],
                'vacancy' => rand(1, 5),
                'salary' => rand(3000, 9000) . ' USD',
                // 'Location' => $city, // الحقل المطلوب للـ Blade
                'location' => $city, // الحقل الصغير
                'description' => 'We are looking for a PHP expert to build amazing web applications using the Laravel framework.',
                'benefits' => 'Health insurance, paid time off, and flexible remote work options.',
                'responsibility' => 'Develop clean code, maintain databases, and collaborate with the frontend team.',
                'qualifications' => '3+ years of experience with Laravel, MySQL, and REST APIs.',
                'keywords' => 'php, laravel, backend, mysql',
                'company_name' => 'Tech Solutions ' . $i,
                'website' => 'https://example' . $i . '.com',
                'user_id' => $users->random()->id, // ربط عشوائي بمستخدم موجود
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}