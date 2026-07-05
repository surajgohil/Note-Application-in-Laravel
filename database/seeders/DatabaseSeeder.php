<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Folders;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Suraj Gohil',
            'email' => 'suraj@gmail.com',
            'password' => Hash::make('suraj@123')
        ]);

        $this->call([
            FolderSeeder::class,
            NoteSeeder::class
        ]);
    }
}
