<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * Table model for automatic making table models and quiering tables 
 */
class Tabels extends Model
{
    protected $table      = '';
    protected $primaryKey = '';
    protected $fields = ''; 
    protected $foreign_keys = '';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [];
    
    protected function get_primary_key()
    {
        $this->fields = $this->db->getFieldData($this->table);
        foreach($this->fields as $res){
            if($res->primary_key){
                $this->primaryKey = $res->name;
            }
        }
        return $this->primaryKey;
       
    }
    protected function set_allowed_fields()
    {
        $this->fields = $this->db->getFieldData($this->table);
        foreach($this->fields as $field => $f){
           $this->allowedFields[] = $f;
        }
    }
    public function get_table($table,$pagin = true)
    {
        $this->table = $table;
        $this->get_primary_key();
        $this->set_allowed_fields();
        if($pagin) return $this->paginate(8);
        else return $this->findAll();
        
        
    }
    public function get_fields($table)
    {   $this->get_table($table);
        $this->fields = $this->db->getFieldData($this->table);
        return $this->fields;
    }
    public function get_foreign_keys($table)
    {
        $this->foreign_keys = $this->db->getForeignKeyData($table);
        return $this->foreign_keys;
    }
    public function get_row($id)
    {
        return $this->find($id);
    }

    public function search($table,$col,$word,$perPage)
    {
        $this->table = $table;
        $this->get_primary_key();
        $this->set_allowed_fields();
        $this->select('*')->like($col,$word);
        return $this->paginate($perPage);
        
    }
}