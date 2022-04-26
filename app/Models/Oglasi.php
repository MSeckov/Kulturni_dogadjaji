<?php

namespace App\Models;

use CodeIgniter\Model;

class Oglasi extends Model
{
    protected $table      = 'oglasi';
    protected $primaryKey = 'id_oglas';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['oglas_naslov','oglas_tekst','oglas_datum_od','is_active','id_organ','id_oglas','oglas_datum_do'];
    
    /**get all ads */
    
    public function get_all_ads()
    {
        $this->join('organizacija',' oglasi.id_organ=organizacija.id_organ');
        $this->where('is_active',1);
        return $this->findAll();
    }

    /**Automatic archiving */

    public function archive_ad()
    {
        $this->where('is_active',1);
        $objects = $this->findAll();
        $data = [
            'is_active' => 0,
        ];
        foreach($objects as $object){
            if(strtotime($object->oglas_datum_do)  < strtotime(date('Y-m-d H:i:s'))){
                $this->update($object->id_oglas,$data);
            }
        }
    }

}