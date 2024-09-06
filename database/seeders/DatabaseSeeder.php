<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create users
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $superUser = User::create([
            'name' => 'Super User',
            'email' => 'admin@readers-club.com',
            'password' => bcrypt('superuser1234'),
            'role' => 'super_user',
        ]);

        // Seed additional fake users
        $additionalUsers = User::factory()->count(10)->create();

        // Create categories
        $categories = [
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Thriller',
            'Non-Fiction',
            'Biography',
            'Self-Help',
            'Romance',
            'Historical Fiction',
            'Young Adult'
        ];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);;
        }

        // Create books and assign categories
        $books = [
            [
                'title' => 'Dune',
                'isbn' => '9780441013593',
                'authors' => 'Frank Herbert',
                'publisher' => 'Chilton Books',
                'edition' => '1st',
                'cover_art' => 'image/books/24wtdlcfgr3neehj6ev3k4de5ley.jpg',
                'category_id' => Category::where('name', 'Science Fiction')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'The Hobbit',
                'isbn' => '9780547928227',
                'authors' => 'J.R.R. Tolkien',
                'publisher' => 'Houghton Mifflin',
                'edition' => '1st',
                'cover_art' => 'image/books/frxjk2ln3mmo4nio8u9zvk9te2z1.jpg',
                'category_id' => Category::where('name', 'Fantasy')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'Gone Girl',
                'isbn' => '9780307588371',
                'authors' => 'Gillian Flynn',
                'publisher' => 'Crown Publishing Group',
                'edition' => '1st',
                'cover_art' => 'image/books/g9cpq9eng11ahx91z1081i8a2uta.jpg',
                'category_id' => Category::where('name', 'Mystery')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'The Girl with the Dragon Tattoo',
                'isbn' => '9780307454546',
                'authors' => 'Stieg Larsson',
                'publisher' => 'Vintage Crime/Black Lizard',
                'edition' => '1st',
                'cover_art' => 'image/books/hi2w62shitit1a1ez4y6vl7wz37u.jpg',
                'category_id' => Category::where('name', 'Thriller')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'isbn' => '9780062316110',
                'authors' => 'Yuval Noah Harari',
                'publisher' => 'HarperCollins',
                'edition' => '1st',
                'cover_art' => 'image/books/q6772fd7fdkcdvg3ed70nupy0r7z.jpg',
                'category_id' => Category::where('name', 'Non-Fiction')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'The Immortal Life of Henrietta Lacks',
                'isbn' => '9781400052189',
                'authors' => 'Rebecca Skloot',
                'publisher' => 'Crown Publishing Group',
                'edition' => '1st',
                'cover_art' => 'image/books/qqc8v7jr9iqe14s5mysy012w7itl.jpg',
                'category_id' => Category::where('name', 'Biography')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'How to Win Friends and Influence People',
                'isbn' => '9780671027032',
                'authors' => 'Dale Carnegie',
                'publisher' => 'Simon & Schuster',
                'edition' => '1st',
                'cover_art' => 'image/books/ukpn0mg81hrv8flzj0l8wrmm5s06.jpg',
                'category_id' => Category::where('name', 'Self-Help')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'Pride and Prejudice',
                'isbn' => '9780141439518',
                'authors' => 'Jane Austen',
                'publisher' => 'Penguin Classics',
                'edition' => '1st',
                'cover_art' => 'image/books/v3hm00c8bv9z13qyh92eaz8hkeys.jpg',
                'category_id' => Category::where('name', 'Romance')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'The Night Circus',
                'isbn' => '9780385534635',
                'authors' => 'Erin Morgenstern',
                'publisher' => 'Doubleday',
                'edition' => '1st',
                'cover_art' => 'image/books/vjrggi7ozndm782taq4yfe894b87.jpg',
                'category_id' => Category::where('name', 'Fantasy')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'All the Light We Cannot See',
                'isbn' => '9781501173219',
                'authors' => 'Anthony Doerr',
                'publisher' => 'Scribner',
                'edition' => '1st',
                'cover_art' => 'image/books/x6vh0xvy1hrwtdvwq6a3m8uosdhy.jpg',
                'category_id' => Category::where('name', 'Historical Fiction')->first()->id,
                'user_id' => $regularUser->id,
            ],
            [
                'title' => 'The Hunger Games',
                'isbn' => '9780439023528',
                'authors' => 'Suzanne Collins',
                'publisher' => 'Scholastic Press',
                'edition' => '1st',
                'cover_art' => '',
                'category_id' => Category::where('name', 'Young Adult')->first()->id,
                'user_id' => $regularUser->id,
            ],
        ];



        foreach ($books as $book) {
            Book::create($book);
        }

        // Create comments
        $comments = [
                                   
            ['content' => 'A mesmerizing journey through a desert world of political intrigue.', 'book_id' => Book::where('title', 'Dune')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'An epic science fiction saga that remains a classic.', 'book_id' => Book::where('title', 'Dune')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Frank Herbert’s world-building is unparalleled in this genre.', 'book_id' => Book::where('title', 'Dune')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A complex narrative with deep philosophical insights.', 'book_id' => Book::where('title', 'Dune')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'The Hobbit'
            ['content' => 'A delightful prelude to the Lord of the Rings saga.', 'book_id' => Book::where('title', 'The Hobbit')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Tolkien’s magical world captivates readers of all ages.', 'book_id' => Book::where('title', 'The Hobbit')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A fantastic adventure full of memorable characters.', 'book_id' => Book::where('title', 'The Hobbit')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A beautifully crafted tale of courage and friendship.', 'book_id' => Book::where('title', 'The Hobbit')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'Gone Girl'
            ['content' => 'A thrilling psychological mystery with unexpected twists.', 'book_id' => Book::where('title', 'Gone Girl')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Gillian Flynn’s writing keeps you on the edge of your seat.', 'book_id' => Book::where('title', 'Gone Girl')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A dark and compelling story of deceit and intrigue.', 'book_id' => Book::where('title', 'Gone Girl')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'The narrative structure and character development are superb.', 'book_id' => Book::where('title', 'Gone Girl')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'The Girl with the Dragon Tattoo'
            ['content' => 'A gripping thriller with an unforgettable heroine.', 'book_id' => Book::where('title', 'The Girl with the Dragon Tattoo')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Stieg Larsson’s debut novel is a masterclass in suspense.', 'book_id' => Book::where('title', 'The Girl with the Dragon Tattoo')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A dark and intricate story that keeps you guessing.', 'book_id' => Book::where('title', 'The Girl with the Dragon Tattoo')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'An excellent blend of mystery, drama, and psychological depth.', 'book_id' => Book::where('title', 'The Girl with the Dragon Tattoo')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'Sapiens: A Brief History of Humankind'
            ['content' => 'A fascinating exploration of the human species from the dawn of time.', 'book_id' => Book::where('title', 'Sapiens: A Brief History of Humankind')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Yuval Noah Harari provides insightful analysis of human history.', 'book_id' => Book::where('title', 'Sapiens: A Brief History of Humankind')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A thought-provoking read that challenges conventional perspectives.', 'book_id' => Book::where('title', 'Sapiens: A Brief History of Humankind')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'An engaging narrative that makes complex history accessible.', 'book_id' => Book::where('title', 'Sapiens: A Brief History of Humankind')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'The Immortal Life of Henrietta Lacks'
            ['content' => 'A powerful and moving story about scientific ethics and human dignity.', 'book_id' => Book::where('title', 'The Immortal Life of Henrietta Lacks')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Rebecca Skloot’s investigation brings to light a forgotten heroine.', 'book_id' => Book::where('title', 'The Immortal Life of Henrietta Lacks')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'An incredible tale of science, race, and medical ethics.', 'book_id' => Book::where('title', 'The Immortal Life of Henrietta Lacks')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A deeply moving and enlightening biography.', 'book_id' => Book::where('title', 'The Immortal Life of Henrietta Lacks')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'How to Win Friends and Influence People'
            ['content' => 'A timeless guide to effective communication and personal success.', 'book_id' => Book::where('title', 'How to Win Friends and Influence People')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Dale Carnegie’s principles are practical and impactful.', 'book_id' => Book::where('title', 'How to Win Friends and Influence People')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A classic book on interpersonal skills and relationship building.', 'book_id' => Book::where('title', 'How to Win Friends and Influence People')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Essential reading for anyone looking to improve their social interactions.', 'book_id' => Book::where('title', 'How to Win Friends and Influence People')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'Pride and Prejudice'
            ['content' => 'A delightful romance that explores the social dynamics of its time.', 'book_id' => Book::where('title', 'Pride and Prejudice')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Jane Austen’s wit and social commentary shine through in this classic.', 'book_id' => Book::where('title', 'Pride and Prejudice')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A timeless story of love, misunderstandings, and societal expectations.', 'book_id' => Book::where('title', 'Pride and Prejudice')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A beautifully written novel with enduring characters and themes.', 'book_id' => Book::where('title', 'Pride and Prejudice')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'The Night Circus'
            ['content' => 'A magical and enchanting story with stunning imagery.', 'book_id' => Book::where('title', 'The Night Circus')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Erin Morgenstern creates a captivating world of wonder and mystery.', 'book_id' => Book::where('title', 'The Night Circus')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A beautifully imaginative tale that immerses you in its magical setting.', 'book_id' => Book::where('title', 'The Night Circus')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A mesmerizing blend of fantasy, romance, and magical realism.', 'book_id' => Book::where('title', 'The Night Circus')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'All the Light We Cannot See'
            ['content' => 'A hauntingly beautiful portrayal of love and war.', 'book_id' => Book::where('title', 'All the Light We Cannot See')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A moving story of two lives intersecting amidst the chaos of WWII.', 'book_id' => Book::where('title', 'All the Light We Cannot See')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Anthony Doerr’s prose creates a vivid and poignant narrative.', 'book_id' => Book::where('title', 'All the Light We Cannot See')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A beautifully crafted novel that shines a light on human resilience.', 'book_id' => Book::where('title', 'All the Light We Cannot See')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],

            // Comments for 'The Hunger Games'
            ['content' => 'A gripping dystopian adventure with a strong and relatable heroine.', 'book_id' => Book::where('title', 'The Hunger Games')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'Suzanne Collins’ world-building and plot twists keep you hooked.', 'book_id' => Book::where('title', 'The Hunger Games')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A powerful exploration of survival and rebellion.', 'book_id' => Book::where('title', 'The Hunger Games')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            ['content' => 'A captivating read that raises important questions about society and power.', 'book_id' => Book::where('title', 'The Hunger Games')->first()->id, 'user_id' => User::inRandomOrder()->first()->id],
            // Add more comments as needed to reach 40
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
}
}
