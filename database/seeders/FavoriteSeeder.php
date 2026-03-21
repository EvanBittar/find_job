<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        // جلب كل المستخدمين والوظائف المتاحة
        $users = User::all();
        $jobs = Job::all();

        // تأكد من وجود بيانات قبل البدء
        if ($users->isEmpty() || $jobs->isEmpty()) {
            return;
        }

        // إضافة 10 سجلات مفضلات عشوائية
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $job = $jobs->random();

            // التأكد من عدم تكرار نفس المفضلة لنفس المستخدم
            $exists = Favorite::where('user_id', $user->id)
                             ->where('job_id', $job->id)
                             ->exists();

            if (!$exists) {
                Favorite::create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}