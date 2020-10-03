<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'role_id' => 1,
                'permission_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
            ],
        ];

        DB::table('permission_role')->insert($data);
    }
}
