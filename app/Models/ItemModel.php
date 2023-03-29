<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ItemModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'uuid',
        'umkm',
        'category',
        'name_item',
        'img',
        'stock',
        'price',
        'description',

        //Timestamp
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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

    public function createItem($item_object){
        $uuid4 = Uuid::uuid4();
        $generatedUUID = $uuid4;
        $this->save([
            'uuid' => $generatedUUID,
            'umkm' => $item_object['umkm'],
            'category' => $item_object['category'],
            'name_item' => $item_object['name_item'],
            'img' => $item_object['img'],
            'stock' => $item_object['stock'],
            'price' => $item_object['price'],
            'description' => $item_object['description'],
        ]);
        return [
            'id' => $this->getInsertID(),
            'uuid' => $generatedUUID,
            'name_item' => $item_object['name_item'],
        ];
    }

    public function updateItem($item_uuid, $item_object){
        $this->where('uuid', $item_uuid)->set([
            'umkm' => $item_object['umkm'],
            'category' => $item_object['category'],
            'name_item' => $item_object['name_item'],
            'img' => $item_object['img'],
            'stock' => $item_object['stock'],
            'price' => $item_object['price'],
            'description' => $item_object['description'],           
        ])->update();
    }
}
