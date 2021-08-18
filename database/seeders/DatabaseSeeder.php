<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Status;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role = Role::firstOrcreate(['name' => 'admin']);
        $role = Role::firstOrcreate(['name' => 'agents']);
        $role = Role::firstOrcreate(['name' => 'leads']);
        $role = Role::firstOrcreate(['name' => 'super_admin']);
        $status = Status::firstOrcreate(['name' => 'won']);
        $status = Status::firstOrcreate(['name' => 'hot']);
        $status = Status::firstOrcreate(['name' => 'cold']);
        $status = Status::firstOrcreate(['name' => 'in_progress']);
        $status = Status::firstOrcreate(['name' => 'lost']);
    }
}
