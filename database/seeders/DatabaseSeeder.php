<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123!@')
        ]);
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'page_icon' => 'pages/home.png'
            ],
            [
                'title' => 'Create Name',
                'slug' => 'create-name',
                'page_icon' => 'pages/heart.png'
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'page_icon' => 'pages/bell.png'
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'page_icon' => 'pages/contact.png'
            ],
        ];
        foreach ($pages as $page)
            Page::create($page);
    }
}
