<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeLevel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'grade_level';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'level'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Create and save grade level
    public function add_grade_level($data){
        $this -> insert($data);
        return $this-> getInsertID();
    }

    // Fetch all saved grade level
    public function get_all_grade_level(){
        return $this-> findAll();
    }

    public function update_grade_level($grade_level_id, $data){
        $this->update($grade_level_id, $data);
        return $this->affectedRows();
    }


    public function delete_grade_level($grade_level_id)
    {
        $this->delete($grade_level_id);
        return $this->affectedRows();
    }
    
}
