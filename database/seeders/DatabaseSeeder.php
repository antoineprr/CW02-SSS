<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Country;
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

        Category::create(['label' => 'Trades']);
        Category::create(['label' => 'Injuries']);
        Category::create(['label' => 'Rookie Watch']);
        Category::create(['label' => 'Game Highlights']);
        Category::create(['label' => 'Analysis']);
        Category::create(['label' => 'Rumours']);
        Category::create(['label' => 'Playoffs']);
        Category::create(['label' => 'History']);
        Category::create(['label' => 'Statistics']);
        Category::create(['label' => 'Awards']);

        Country::create(['name' => 'United States', 'code' => 'US']);
        Country::create(['name' => 'Canada', 'code' => 'CA']);
        Country::create(['name' => 'France', 'code' => 'FR']);
        Country::create(['name' => 'Spain', 'code' => 'ES']);
        Country::create(['name' => 'Serbia', 'code' => 'RS']);
        Country::create(['name' => 'Australia', 'code' => 'AU']);
        Country::create(['name' => 'Germany', 'code' => 'DE']);
        Country::create(['name' => 'Brazil', 'code' => 'BR']);
        Country::create(['name' => 'Nigeria', 'code' => 'NG']);
        Country::create(['name' => 'Lithuania', 'code' => 'LT']);

        $adminUser = User::create([
            'name' => 'Morgan',
            'firstname' => 'Alex',
            'email' => 'admin.user@test.demo',
            'is_admin' => true,
            'is_author' => true,
            'password' => bcrypt('#DEMOPass123!')
        ]);

        $writerUser = User::factory()->create([
            'name' => 'Lopez',
            'firstname' => 'Jamie',
            'email' => 'author.user@test.local',
            'is_admin' => false,
            'is_author' => true,
            'password' => bcrypt('AuthorPass123!')
        ]);

        User::factory()->create([
            'name' => 'Sullivan',
            'firstname' => 'Riley',
            'email' => 'reader.user@test.local',
            'password' => bcrypt('ReaderPass123!')
        ]);


        Team::create([
            'name' => 'Los Angeles Lakers',
            'location' => 'Los Angeles, CA',
            'description' => 'Historic franchise known for its championships and legendary players.',
            'color' => '#552583', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Golden State Warriors',
            'location' => 'San Francisco, CA',
            'description' => 'Modern dynasty known for elite shooting and multiple recent titles.',
            'color' => '#1D428A', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Boston Celtics',
            'location' => 'Boston, MA',
            'description' => 'One of the oldest franchises with a strong championship legacy.',
            'color' => '#007A33', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Chicago Bulls',
            'location' => 'Chicago, IL',
            'description' => 'Famous for the Jordan era and global brand recognition.',
            'color' => '#CE1141', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Miami Heat',
            'location' => 'Miami, FL',
            'description' => 'Three-time NBA champions known for their culture and competitiveness.',
            'color' => '#98002E', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Phoenix Suns',
            'location' => 'Phoenix, AZ',
            'description' => 'High-tempo franchise with iconic purple and orange branding.',
            'color' => '#E56020',
            'logo' => null
        ]);

        Team::create([
            'name' => 'Dallas Mavericks',
            'location' => 'Dallas, TX',
            'description' => '2011 NBA champions and current home of elite talent.',
            'color' => '#00538C', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Brooklyn Nets',
            'location' => 'Brooklyn, NY',
            'description' => 'Known for its modern branding and black-and-white identity.',
            'color' => '#000000', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'Milwaukee Bucks',
            'location' => 'Milwaukee, WI',
            'description' => 'Recent NBA champions with a strong star-led roster.',
            'color' => '#00471B', 
            'logo' => null
        ]);

        Team::create([
            'name' => 'New York Knicks',
            'location' => 'New York, NY',
            'description' => 'Iconic franchise based in Madison Square Garden.',
            'color' => '#F58426',
            'logo' => null
        ]);

        $teams = Team::all();
        foreach ($teams as $team) {
            Player::factory(4)->create([
                'team_id' => $team->id,
                'position_id' => random_int(1, 5),
                'country_id' => random_int(1, 10)  
            ]);
        }
        

        if (app()->environment() !== 'production') {
            $categories = Category::all();

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
}
