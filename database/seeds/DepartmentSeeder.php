<?php

use Illuminate\Database\Seeder;
use App\Department;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('departments')->insert([
            [
                'department' => 'Yazılım'
            ],
            [
                'department' => 'Ağ'
            ],
            [
                'department' => 'Destek'
            ]
        ]);
    }
}
