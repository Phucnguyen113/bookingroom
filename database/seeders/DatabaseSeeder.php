<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Tags;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()->create();
        Tag::findOrCreate('#', Tags::Blog);
        Tag::findOrCreate('#', Tags::RoomService['general_amenities']);
        Tag::findOrCreate('#', Tags::RoomService['outdoor_facilities']);

        Category::create([
            'name' => '#'
        ]);
    }
}
