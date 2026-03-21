<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // إنشاء مستخدم "مسؤول" أو حساب دائم للاختبار
    \App\Models\User::create([
        'name' => 'Evan Bittar',
        'email' => 'evan@gmail.com',
        'password' => Hash::make('123123123'), // كلمة مرور سهلة للاختبار
        
    ]);
    \App\Models\User::create([
        'name' => 'fadi Bittar',
        'email' => 'fadi@gmail.com',
        'password' => Hash::make('123123123'), // كلمة مرور سهلة للاختبار
        
    ]);
    \App\Models\User::factory(5)->create();
}
}
