<?php

namespace App\Models;

use CodeIgniter\Model;

class Dogadjaji extends Model
{
    protected $table      = 'dogadjaji';
    protected $primaryKey = 'id_dogadjaj';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['dogadjaj_naslov','dogadjaj_tekst','id_kat','id_mesto','id_starost','id_prostor','dogadjaj_datum_od','dogadjaj_datum_do','dogadjaj_vreme_od','dogadjaj_vreme_do','id_organ','is_active','id_dogadjaj'];

    /** get all evants */
    public function get_all_events($mesto_search,$kat_search,$datum_search)
    {
        $array_of_tables = ['kategorije'=>'id_kat','mesto'=>'id_mesto','organizacija'=>'id_organ','starosno_doba'=>'id_starost','karakteristika_prostora'=>'id_prostor'];
        foreach($array_of_tables as $table => $column){
            $this->join($table,'dogadjaji.'.$column.'='.$table.'.'.$column);
        }
        
        //sql query
        $uslov = "is_active=1";
        if($mesto_search) {
            $uslov .= " AND mesto_naziv=".$this->escape($mesto_search);
        }
        if($kat_search) {
            $uslov .= " AND kat_naziv=".$this->escape($kat_search);;
        }
        if($datum_search) {
            $uslov .= " AND dogadjaj_vreme_od >=".$this->escape($datum_search);;
        }
       
        $this->where($uslov);
        return $this->findAll();
    }
    /**f-n for finding first 3 events by date */
    public function nearest_dates ()
    {
        $this->select('*')->where('is_active=1')->orderBy('dogadjaj_vreme_od','ASC');
        return $this->findAll(3);
    }
    
    /**Automatic archiving */

    public function archive_event()
    {
        $this->where('is_active',1);
        $objects = $this->findAll();
        $data = [
            'is_active' => 0,
        ];
        foreach($objects as $object){
            if(strtotime($object->dogadjaj_vreme_do)  < strtotime(date('Y-m-d H:i:s'))){
                $this->update($object->id_dogadjaj,$data);
            }
        }
    }

}