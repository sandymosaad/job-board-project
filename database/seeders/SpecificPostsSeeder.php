<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class SpecificPostsSeeder extends Seeder
{
    public function run()
    {
        // Delete posts with IDs from 12 to 60
        Post::whereBetween('id', [12, 60])->delete();

        // Insert the 3 specific posts
        Post::create([
            'title' => 'Pending Post 1',
            'description' => 'Description for pending post 1.',
            'deadline' => now()->addDays(10),
            'workType' => 'remote',
            'location' => 'Location 1',
            'skills' => 'Skill 1, Skill 2',
            'salaryRange' => '$5000 - $6000',
            'benefites' => 'Benefits 1, Benefits 2',
            'logo' => 'logo1.png',
            'category' => 'Category 1',
            'status' => 'pending',
            'user_id' => 2,
        ]);

        Post::create([
            'title' => 'Pending Post 2',
            'description' => 'Description for pending post 2.',
            'deadline' => now()->addDays(15),
            'workType' => 'onsite',
            'location' => 'Location 2',
            'skills' => 'Skill 3, Skill 4',
            'salaryRange' => '$4000 - $5000',
            'benefites' => 'Benefits 3, Benefits 4',
            'logo' => 'logo2.png',
            'category' => 'Category 2',
            'status' => 'pending',
            'user_id' => 2,
        ]);

        Post::create([
            'title' => 'Pending Post 3',
            'description' => 'Description for pending post 3.',
            'deadline' => now()->addDays(20),
            'workType' => 'hybrid',
            'location' => 'Location 3',
            'skills' => 'Skill 5, Skill 6',
            'salaryRange' => '$3000 - $4000',
            'benefites' => 'Benefits 5, Benefits 6',
            'logo' => 'logo3.png',
            'category' => 'Category 3',
            'status' => 'pending',
            'user_id' => 2,
        ]);
    }
}
