<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Article;
use App\Models\Category;
use App\Models\Student;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware(['auth:web', 'admin']),];
    }
    public function index()
    {
        return view('admin.dashboard', [
            'usersCount'     => User::count(),
            'articlesCount'  => Article::count(),
            'categoriesCount' => Category::count(),
            'studentsCount' => Student::count(),
            'addressesCount' => Address::count(),
        ]);
    }
}
