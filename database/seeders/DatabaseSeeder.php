<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Player;
use App\Models\Position;
use App\Models\Post;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Position::create(['label' => 'PG']);
        Position::create(['label' => 'SG']);
        Position::create(['label' => 'SF']);
        Position::create(['label' => 'PF']);
        Position::create(['label' => 'C']);

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'firstname' => 'User',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'is_author' => true,
            'password' => bcrypt('admin')
        ]);

        $writerUser = User::factory()->create([
            'name' => 'Author',
            'firstname' => 'User',
            'email' => 'author@example.com',
            'is_admin' => false,
            'is_author' => true,
            'password' => bcrypt('author')
        ]);

        User::factory()->create([
            'name' => 'Reader',
            'firstname' => 'User',
            'email' => 'reader@example.com',
            'password' => bcrypt('reader')
        ]);

        $categories = Category::factory(10)->create();

        $teams = Team::factory(10)->create();
        foreach ($teams as $team) {
            Player::factory(2)->create([
                'team_id' => $team->id,
                'position_id' => random_int(1, 5)
            ]);
        }

        $adminPost = Post::factory(5)->create([
            'user_id' => $adminUser->id
        ]);

        $writerPost = Post::factory(5)->create([
            'user_id' => $writerUser->id
        ]);

        $players = Player::all();
        $posts = $adminPost->concat($writerPost);

        foreach ($posts as $index => $post) {
            $post->categories()->attach($categories[$index]->id);
            $post->teams()->attach($teams[$index]->id);
            $post->players()->attach($players[$index]->id);
        }

    }
}
