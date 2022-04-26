<?php

namespace App\Models;

use CodeIgniter\Model;

class Logs extends Model
{
    protected $table      = 'admin_logs';
    protected $primaryKey = 'id_log';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['id_log','date_time','action','name_table','id_record','reason'];

    public function log($action,$table,$id,$log_reason){
        $data = [
            'date_time' => date("Y-m-d h:i:s"),
            'action' => $action,
            'name_table' => $table,
            'id_record' => $id,
            'reason' => $log_reason,
        ];
        $this->insert($data);
    }
    public function view_logs()
    {
       /*return $this->findAll();*/
       return $this->paginate(8);
    }

}