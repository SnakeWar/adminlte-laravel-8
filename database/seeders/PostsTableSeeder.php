<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        for($i = 0; $i <= 50; $i++){
            $post = Post::create([
                'title' => $slug = Str::random(8),
                'slug' => Str::slug($slug),
                'description' => Str::random(10),
                'body' => Str::random(100),
                'status' => 1,
                'photo' => 'assets/img/logo.png',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
            ]);
            $post->categories()->sync([1]);
        }

    }
}
