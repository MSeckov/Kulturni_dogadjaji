<?php

namespace App\Controllers;

use App\Models\Tabels;
use App\Models\Logs;
use Config\Services;
use CodeIgniter\Pager\Pager;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\BaseResult;

class Admin extends BaseController
{   
    protected $tableModel;
    protected $fieldID;
    protected $fields;
    

	public function __construct()
	{
		$this->tableModel = new Tabels();
	}
    protected function make_builder($table)
    {
        $db = \Config\Database::connect();
        return $db->table($table);
    }
    protected function data_about_fields($table)
    {
        $this->tableModel->get_table($table);
        $this->fields = $this->tableModel->get_fields($table);
        $this->fieldID = array_shift($this->fields);//get id  from columns and remove from columns
    }
    protected function insert_update($table, $id = null, bool $insert = false)
    {
        $builder = $this->make_builder($table);
        $this->data_about_fields($table);
        $fieldID_name = $this->fieldID->name;

        foreach($this->fields as $field){

            // two way validation

            if($insert){
                if($field->name != 'is_active' && $field->name != $table.'_image')// make this filds not required
                $check[] = $this->validate([$field->name => 'required']);
                else if($field->name != 'is_active'){// make this filds not required
                $check[] = $this->validate([$field->name => 'required',$table.'_image' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded['.$table.'_image]'
                        . '|is_image['.$table.'_image]'
                        . '|mime_in['.$table.'_image,image/jpg,image/jpeg,image/gif,image/png]',
                ],]);
            }
            }
            else {
                if($field->name != 'is_active' && $field->name != $table.'_image')// make this filds not required
                $check[] = $this->validate([$field->name => 'required']);
            }
        }
        if(in_array(false,$check)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        else { 
            foreach($this->fields as $field){
                if(!$this->request->getPost($field->name)){
                    $record[$field->name] = 0; //set default value if not exists
                }
                else {
                $record[$field->name] = esc($this->request->getPost($field->name));
                }
              
            }
            
            
            if($insert){
                $builder->insert($record);
            }
            else {
                array_pop($record);//pop up img filde because it is not require in editing 
                $builder->update($record,[$this->fieldID->name => $id]);
                $logModel =  new Logs();
                $log_reason = $_POST['reason'] ?? '';
                $logModel->log('edited',$table,$id,$log_reason);
            }
			
            //inserting img in database
            foreach($this->fields as $field){
                if($field->name == $table.'_image'){
                    if(!$_FILES[$table.'_image']['error'] == UPLOAD_ERR_NO_FILE){ 
                        $builder->selectMax($this->fieldID->name);
                        $query = $builder->get();

                        foreach ($query->getResult() as $row => $r) {
                            $recordID = $r->$fieldID_name;
                        }
                        
                        //  grab MIME type
                        $mime_type = $_FILES[$table.'_image']['type'];
                        $mime_type = str_replace('image/','',$mime_type);
                    
                        
                        $posterName = $recordID . ".".$mime_type;
                        $poster = $this->request->getFile($table.'_image');
                        $poster->move('../public/assets/images/'.$table, $posterName, true);
                        $record[$table.'_image'] = $posterName;
                        $builder->update($record,[$fieldID_name => $recordID]);
                        
                    }
                }
            }
            if($insert){
                return redirect()->to('admin/add/'.$table)->with('message', 'Successfully added');
            }
            else {
                return redirect()->to('admin/edit/'.$table.'/'.$id)->with('message', 'Successfully edited');
            }
        }
    }
    public function index()
    {   
        return view('admin/index');
    }
    public function find($table)
    {
        $data = $this->tableModel->get_table($table);
        return view('admin/findDefault',['data'=>$data,'heading'=>$table,'pager' => $this->tableModel->pager,]);
    }
    public function add($table)
    {
        $fields = $this->tableModel->get_fields($table);
        $foreign_keys = $this->get_foreign_tables($table);
        array_shift($fields);
        return view('admin/add',['fields' => $fields,'heading'=>$table,'fkeys'=>$foreign_keys]);
    }
    public function insert($table)
    {   
      return $this->insert_update($table,null,true);
    }
    
    protected function get_foreign_tables($table)
    {
        $foreign_keys = $this->tableModel->get_foreign_keys($table);

        if($foreign_keys){
        foreach($foreign_keys as $foreign_key){
            $tableModel = new Tabels();/**make for each new model */
            $arr_of_fk[$foreign_key->column_name] = $tableModel->get_table($foreign_key-> foreign_table_name);
        }
        
        foreach($arr_of_fk as $arr=>$a){
            foreach($a as $obj){
                $arrA[$arr][] = array_slice(get_object_vars($obj),0,2);
            }
           
        }
        return $arrA;
    }
        return [];
    }
    public function delete($table,$id)
    {
        $builder = $this->make_builder($table);

        $this->data_about_fields($table);
        
        $builder->delete([$this->fieldID->name => $id]);
        $logModel =  new Logs();
        $log_reason = $_POST['reason'] ?? '';
        $logModel->log('deleted',$table,$id,$log_reason);
        return redirect()->to('admin/find/'.$table)->with('message', 'Successfully deleted');
    }
    public function edit($table,$id)
    {
        $fields = $this->tableModel->get_fields($table);
        $foreign_keys = $this->get_foreign_tables($table);
        array_shift($fields);
        $row = $this->tableModel->get_row($id);
        return view('admin/edit',['fields' => $fields,'heading'=>$table,'fkeys'=>$foreign_keys,'id'=>$id,'row'=>$row]);
    }
    public function update($table,$id)
    {
       return $this->insert_update($table,$id,false);
    }
    public function show_logs()
    {
        $logModel =  new Logs();
        $data =  $logModel->view_logs();
        return view('admin/logs',['data'=>$data,'pager' => $logModel->pager,]);
    }
    public function search($table)
    {   
       
        $word =  $this->request->getVar('search');
        $col = $this->request->getVar('column');

        if($word == ''){
            $data = $this->tableModel->get_table($table);
        }

        $data = $this->tableModel->search($table,$col,$word,8);
        if(!$data){
            return view('admin/noresult');
        }
        
        return view('admin/search',['data'=>$data,'heading'=>$table,'pager' => $this->tableModel->pager,]);
      
    }
    
    
}
