<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Review;
use App\Models\Task;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public const USERS_QUANTITY = 100;
    public const TASKS_QUANTITY = 20;
    public const BOOKS_QUANTITY = 20;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Task::factory(self::TASKS_QUANTITY)->create();
//
//        Book::factory(33)->create()->each(function ($book) {
//            $numReviews = random_int(5, 30);
//
//            Review::factory()->count($numReviews)
//                ->good()
//                ->for($book)
//                ->create();
//        });
//
//        Book::factory(33)->create()->each(function ($book) {
//            $numReviews = random_int(5, 30);
//
//            Review::factory()->count($numReviews)
//                ->average()
//                ->for($book)
//                ->create();
//        });
//
//        Book::factory(34)->create()->each(function ($book) {
//            $numReviews = random_int(5, 30);
//
//            Review::factory()->count($numReviews)
//                ->bad()
//                ->for($book)
//                ->create();
//        });

//        User::factory(self::USERS_QUANTITY)->create();
//        User::factory(self::USERS_QUANTITY)->unverified()->create();
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        User::factory(self::USERS_QUANTITY)->create();
//        $this->call(EventSeeder::class);
//        $this->call(AttendeeSeeder::class);

//        Work::factory(100)->create();

        $users = \App\Models\User::all()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            \App\Models\Employer::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }

        $employers = \App\Models\Employer::all();

        for ($i = 0; $i < 100; $i++) {
            \App\Models\Work::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        foreach ($users as $user) {
            $jobs = \App\Models\Work::inRandomOrder()->take(rand(0, 4))->get();

            foreach ($jobs as $job) {
                \App\Models\WorkApplication::factory()->create([
                    'work_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
