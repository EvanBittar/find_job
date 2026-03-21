<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeJob extends Controller
{
    public function index()
    {
        $categories = DB::table('jobs')
            ->select('category', DB::raw('count(*) as jobs_count'))
            ->groupBy('category')
            ->orderBy('category', 'ASC')
            ->get();

            $featuredJobs = DB::table('jobs')
            ->where('isFeatured', 1)
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

            $latestJobs = DB::table('jobs')
            ->orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        return view('home', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs
        ]);
    }
}
