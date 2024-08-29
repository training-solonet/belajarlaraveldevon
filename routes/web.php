<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home', ['title' => 'home page']);
});

Route::get('/about', function () {
    return view('about', ['nama' => 'Devon'], ['title' => 'about page']);

});

Route::get('/posts', function () {
    $posts = Post::with(['author','category'])->latest()->get();
    return view('posts', ['title' => 'Blog', 'posts' => Post::all() ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});


Route::get('/authors/{user:username}', function (User $user) {
    return view('posts', [
        'title' => count($user->posts) . ' Artikel oleh ' . $user->name, 
        'posts' => $user->posts,
        'author_id' => $user->id
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'title' => 'Artikel di ' . $category->name, 
        'posts' => $category->posts,
        'category_id' => $category->id
    ]);
});





Route::get('/contact', function () {
    return view('contact', ['title' => 'contact page']);
});

Route::get('/search', function (Illuminate\Http\Request $request) {
    $query = Post::query();

    // Filter berdasarkan author jika ada parameter author_id
    if ($authorId = $request->input('author_id')) {
        $query->where('author_id', $authorId);
    }

    // Filter berdasarkan kategori jika ada parameter category_id
    if ($categoryId = $request->input('category_id')) {
        $query->where('category_id', $categoryId);
    }

    // Filter berdasarkan judul, nama author, atau nama kategori
    if ($search = $request->input('search')) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhereHas('author', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              })
              ->orWhereHas('category', function($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    return view('posts', [
        'title' => 'Search Results',
        'posts' => $query->get(),
    ]);
});
Route::get('/search', function (Illuminate\Http\Request $request) {
    $query = Post::query();

    // Selalu terapkan filter author_id jika ada
    if ($authorId = $request->input('author_id')) {
        $query->where('author_id', $authorId);
    }

    // Selalu terapkan filter category_id jika ada
    if ($categoryId = $request->input('category_id')) {
        $query->where('category_id', $categoryId);
    }

    // Pencarian berdasarkan judul, nama author, atau nama kategori
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhereHas('author', function ($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              })
              ->orWhereHas('category', function ($q) use ($search) {
                  $q->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    return view('posts', [
        'title' => 'Search Results',
        'posts' => $query->get(),
    ]);
});


