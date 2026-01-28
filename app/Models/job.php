<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'category', 
        'job_nature', 
        'vacancy', 
        'salary', 
        'Location', // مطابقة للـ Blade
        'description', 
        'benefits', 
        'responsibility', 
        'qualifications', 
        'keywords', 
        'company_name', 
        'location', 
        'website', 
        'user_id'
    ];
}