<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        PermissionsSeeder::class,
        AdminRoleSeeder::class,
        AdminUserSeeder::class,
        GallerySeeder::class,
       ]);
    }
}
