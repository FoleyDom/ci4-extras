<?php

namespace App\Models;

use CodeIgniter\Model;

class MoodsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'moods';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
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


    public function getMoods()
    {
        $model = new MoodsModel();

        $moods = $model->findAll();

        return $moods;
    }

    public function getEvents()
    {
        $model = new MoodsModel();

        $events = $model->findAll();

        return $events;
    }

    public function postEvent($id = null)
    {
        $model = new MoodsModel();

        $events = $model->save($id);

        return $events;
    }
}
