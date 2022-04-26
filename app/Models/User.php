<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'organizacija';
    protected $primaryKey = 'id_organ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['organ_naziv','kontakt_osoba','kontakt_tel','email','info','web_sajt','id_user','id_ulica','id_delovanje','id_mesto','id_organ'];

    public function get_all_users(){
        $array_of_tables = ['ulica'=>'id_ulica','mesto'=>'id_mesto','oblast_delovanja'=>'id_delovanje'];
        foreach($array_of_tables as $table => $column){
            $this->join($table,'organizacija.'.$column.'='.$table.'.'.$column);
        }
        return $this->findAll();
    }

}