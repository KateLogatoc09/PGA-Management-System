<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GradeLevel extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'name'=>'Kinder',
                'level'=>'1 & 2'
            ],
            [
                'name'=>'Elementary',
                'level'=>'1'
            ],
            [
                'name'=> 'Elementary',
                'level'=>'2'
            ],
            [
                'name'=> 'Elementary',
                'level'=>'3'
            ],
            [
                'name'=> 'Elementary',
                'level'=>'4'
            ],
            [
                'name'=> 'Elementary',
                'level'=>'5'
            ],
            [
                'name'=> 'Elementary',
                'level'=>'6'
            ],
            [
                'name'=> 'Junior Highschool',
                'level'=>'7'
            ],
            [
                'name'=> 'Junior Highschool',
                'level'=>'8'
            ],
            [
                'name'=> 'Junior Highschool',
                'level'=>'9'
            ],
            [
                'name'=> 'Junior Highschool',
                'level'=>'10'
            ],
            [
                'name'=> 'Senior Highschool',
                'level'=>'11'
            ], [
                'name' => 'Senior Highschool',
                'level' => '12'
            ],
        ];

        $this->db->table('grade_level')->insertBatch($data);

    }
}
