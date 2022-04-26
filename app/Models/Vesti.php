<?php

namespace App\Models;

use CodeIgniter\Model;

class Vesti extends Model
{
    protected $table      = 'vesti';
    protected $primaryKey = 'id_vesti';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['vesti_naziv','vesti_tekst','vesti_datum','vesti_image','is_active','id_organ','id_kat','id_vesti'];

    public function get_all_news(){
        $array_of_tables = ['kategorije'=>'id_kat','organizacija'=>'id_organ'];
        foreach($array_of_tables as $table => $column){
            $this->join($table,'vesti.'.$column.'='.$table.'.'.$column);
        }
        $this->where('is_active',1);
        return $this->findAll();
    }

    /**Automatic archiving */

    public function archive_news()
    {
        $this->where('is_active',1);
        $objects = $this->findAll();
        $data = [
            'is_active' => 0,
        ];
        
        foreach($objects as $object){
            $date = date_create($object->vesti_datum);
            date_add($date,date_interval_create_from_date_string('30 days')); //archiving news after 30 days
            if(strtotime(date_format($date, 'Y-m-d')) < strtotime(date('Y-m-d'))){
                $this->update($object->id_vesti,$data);
            }
        }
    }

}