<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Section extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'name'=>'St. Joseph Husband of Mary',
                'grade_level_id'=>1,
            ],
            [
                'name'=>'Sts. Perpetua and Felicity',
                'grade_level_id'=>2,
            ],
            [
                'name' => 'St. Louise de Marillac',
                'grade_level_id' => 3,
            ],
            [
                'name' => 'St. Dominic Savio ',
                'grade_level_id' => 4,
            ],
            [
                'name' => 'St. Pedro Calungsod',
                'grade_level_id' => 5,
            ],
            [
                'name' => 'St Gemma Galgani',
                'grade_level_id' => 6,
            ],
            [
                'name' => 'St. Catherine of Siena',
                'grade_level_id' => 7,
            ],
            [
                'name' => 'St. Lawrence of Manila',
                'grade_level_id' => 8,
            ],
            [
                'name' => ' St. Pio of Pietrelcina',
                'grade_level_id' => 8,
            ],
            [
                'name' => 'St. Matthew the Evangelist',
                'grade_level_id' => 8,
            ],
            [
                'name' => 'SSC - St. Jerome of Stridon',
                'grade_level_id' => 8,
            ],
            [
                'name' => 'St. Francis of Assisi',
                'grade_level_id' => 9,
            ],
            [
                'name' => 'St. Luke the Evangelist',
                'grade_level_id' => 9,
            ],[
                'name' => '  SSC - St. Therese of Lisieux',
                'grade_level_id' => 9,
            ],[
                'name' => 'St. Cecelia',
                'grade_level_id' => 10,
            ],[
                'name' => ' St. Martin the Porres',
                'grade_level_id' => 10,
            ],[
                'name' => 'SSC - St. Albert the Great',
                'grade_level_id' => 10,
            ],[
                'name' => 'St. Stephen',
                'grade_level_id' => 11,
            ],[
                'name' => ' St. Francis Xavier',
                'grade_level_id' => 11,
            ],[
                'name' => 'SSC - St. John the Beloved',
                'grade_level_id' => 11,
            ],[
                'name' => ' St. Joseph Freinademetz',
                'grade_level_id' => 12,
            ],[
                'name' => 'St. Thomas Aquinas',
                'grade_level_id' => 12,
            ],[
                'name' => ' St. Arnold Janssen',
                'grade_level_id' => 12,
            ],[
                'name' => 'St. Agatha Sicily',
                'grade_level_id' => 13,
            ],[
                'name' => 'St. Scholastica',
                'grade_level_id' => 13,
            ]
            
        ];
        $this->db->table('sections')->insertBatch($data);

    }
}
