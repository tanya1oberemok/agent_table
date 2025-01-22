<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Requisition;
use App\Models\Status;
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
         User::factory(10)->create();

         $categories = [
             'Disconnect',
             'Checking/cheapening',
             'Technical issues',
             'Other',
         ];

         foreach($categories as $category) {
             Category::factory()->create([
                 'name' => $category,
             ]);
         }

         $statuses = [
             'New',
             'In progress',
             'Resolved',
         ];

         foreach($statuses as $status) {
             Status::factory()->create([
                 'name' => $status,
             ]);
         }

         Requisition::factory(1000)->create();
    }
}
