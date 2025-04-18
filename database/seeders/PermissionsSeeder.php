<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'Dashboard',
                'slug' => 'Dashboard',
                'groupby' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Bermain',
                'slug' => 'Bermain',
                'groupby' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Bimbel',
                'slug' => 'Bimbel',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Berita',
                'slug' => 'Berita',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Add Berita',
                'slug' => 'Add Berita',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Edit Berita',
                'slug' => 'Edit Berita',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'name' => 'Delete Berita',
                'slug' => 'Delete Berita',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'name' => 'User',
                'slug' => 'User',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'name' => 'Add User',
                'slug' => 'Add User',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'name' => 'Edit User',
                'slug' => 'Edit User',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'name' => 'Delete User',
                'slug' => 'Delete User',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'name' => 'Role',
                'slug' => 'Role',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'name' => 'Add Role',
                'slug' => 'Add Role',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'name' => 'Edit Role',
                'slug' => 'Edit Role',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'name' => 'Delete Role',
                'slug' => 'Delete Role 5',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'name' => 'Layanan',
                'slug' => 'Layanan',
                'groupby' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'name' => 'Delete Bermain',
                'slug' => 'Delete Bermain',
                'groupby' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'name' => 'Journal',
                'slug' => 'Journal',
                'groupby' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'name' => 'Add Journal',
                'slug' => 'Add Journal',
                'groupby' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 20,
                'name' => 'Delete Journal',
                'slug' => 'Delete Journal',
                'groupby' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 21,
                'name' => 'Edit Journal',
                'slug' => 'Edit Journal',
                'groupby' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 22,
                'name' => 'Bimbel Delete',
                'slug' => 'Bimbel Delete',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 23,
                'name' => 'Bimbel Detail',
                'slug' => 'Bimbel Detail',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 24,
                'name' => 'Event',
                'slug' => 'Event',
                'groupby' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 25,
                'name' => 'Event_master',
                'slug' => 'Event_master',
                'groupby' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 26,
                'name' => 'Daycare',
                'slug' => 'Daycare',
                'groupby' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 27,
                'name' => 'Stimulasi',
                'slug' => 'Stimulasi',
                'groupby' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 28,
                'name' => 'Gallery',
                'slug' => 'Gallery',
                'groupby' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 29,
                'name' => 'Gallery Edit',
                'slug' => 'Gallery Edit',
                'groupby' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 30,
                'name' => 'Gallery Delete',
                'slug' => 'Gallery Delete',
                'groupby' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 31,
                'name' => 'Article',
                'slug' => 'Article',
                'groupby' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 32,
                'name' => 'Article Edit',
                'slug' => 'Article Edit',
                'groupby' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 33,
                'name' => 'Article Delete',
                'slug' => 'Article Delete',
                'groupby' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 34,
                'name' => 'Article Detail',
                'slug' => 'Article Detail',
                'groupby' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
