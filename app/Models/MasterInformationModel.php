<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class MasterInformationModel extends Model
{
    // protected $table = 'master_food_request'; 
    // protected $primaryKey = 'id'; 

  

    public function __construct(ConnectionInterface &$db) {

        $this->db =& $db;

    }

    public function insert_entry($data,$tablename){

        $this->db->table($tablename)->insert($data);



        $insert_id = $this->db->insertID();

        return $insert_id;



    }

    public function insert_entry2($data,$tablename){

        $secondDb = DatabaseDefaultConnection();

        $secondDb->table($tablename)->insert($data);

        $insert_id = $secondDb->insertID();

        return $insert_id;

    }

    public function display_all_records($tablename ,$oreder = 'ASE'){

        $result = $this->db->table($tablename)->orderBy('id', $oreder)->get();

        return json_encode($result->getResult());

    }

    public function delete_entry3($tablename, $delete_id) {
        $db3 = DatabaseDefaultConnection();
    
        $result = $db3->table($tablename)->where('id', $delete_id)->delete();
    
        return $result;
    }

    public function delete_entry4($tablename, $delete_id) {
        $db3 = DatabaseDefaultConnection();
    
        $result = $db3->set('requestype', NULL)->where('id', $delete_id)->update($tablename);
    
        return $result;
    }
    
   
    public function insert_entry3($data,$tablename){

        $secondDb = DatabaseDefaultConnection();
        
        $secondDb->table($tablename)->insertBatch($data);
        
        $insert_id = $secondDb->insertID();
        
        return $insert_id;
        
        }

    public function display_all_records2($tablename ,$oreder = 'ASE'){

        $secondDb = DatabaseDefaultConnection();

        $result = $secondDb->table($tablename)->orderBy('id', $oreder)->get();

        return json_encode($result->getResult());

    }

 

    public function edit_entry($tablename,$edit_id){

        $result = $this->db->table($tablename)->where("id", $edit_id)->get();

        return $result->getResult();

    }


    public function database_wise_edit_entry($database_wise = "",$tablename,$edit_id){
        $database = \Config\Database::connect($database_wise);

        $result = $database->table($tablename)->where("id", $edit_id)->get();

        return $result->getResult();

    }

    public function edit_entry2($tablename,$edit_id){

        $secondDb = DatabaseDefaultConnection();

        $result = $secondDb->table($tablename)->where("id", $edit_id)->get();

        return $result->getResult();

    }

    

    public function edit_entry_all($tablename,$edit_id,$id = 'id' , $oreder = 'ASC'){

        $result = $this->db->table($tablename)->where($id, $edit_id)->orderBy('id', $oreder)->get();

        return $result->getResult();

    }

    public function edit_entry_all2($tablename,$edit_id,$id = 'id' , $oreder = 'ASC'){

        $secondDb = DatabaseDefaultConnection();

        $result = $secondDb->table($tablename)->where($id, $edit_id)->orderBy('id', $oreder)->get();

        return $result->getResult();

    }



    public function update_entry($id,$data,$tablename){

        $result = $this->db

                        ->table($tablename)

                        ->where(["id" => $id])

                        ->set($data)

                        ->update();

        return $result;

    }

    public function get_entry_by_id($inquiry_id, $table) {
        $db = DatabaseDefaultConnection();
        $sql = 'SELECT * FROM ' . $table . ' WHERE inquiry_id = ?';
        $query = $db->query($sql, [$inquiry_id]);
        return $query->getRow() !== null;
    }
    public function update_entry2($id,$data,$tablename){

        $secondDb = DatabaseDefaultConnection();

        $result = $secondDb

                        ->table($tablename)

                        ->where(["id" => $id])

                        ->set($data)

                        ->update();

        return $result;

    }
    public function update_entry4($inquiry_id,$data,$tablename){

        $secondDb = DatabaseDefaultConnection();

        $result = $secondDb

                        ->table($tablename)

                        ->where(["inquiry_id" => $inquiry_id])

                        ->set($data)

                        ->update();

        return $result;

    }
    

    public function get_json_data($delete_id)
    {
        $db = DatabaseDefaultConnection();

        $query = $db->table('admin_bot_setup')
                    ->select('menu_message')
                    ->where('id', $delete_id)
                    ->get();
        if ($query->getResult()) {
            $row = $query->getRowArray();
            return $row['menu_message'];
        } else {
            return null;
        }
    }

    public function update_entry_bot2($id, $data, $tablename)
    {
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb
            ->table($tablename)
            ->where(["id" => $id])
            ->set('menu_message', $data) 
            ->update();
    
        return $result;
    }

    public function delete_entry($tablename,$delete_id){

        $result = $this->db->table($tablename)->where("id", $delete_id)->delete();

        return $result;

    }

    
    public function delete_entry2($tablename,$delete_id,$field = 'id'){
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb->table($tablename)->where($field, $delete_id)->delete();
        return $result;
    }


    public function join_entry($tablename, $tablename2, $field, $field2){

        $table = $this->db

                        ->table($tablename)

                        ->select('*')

                        ->join($tablename2, $tablename.'.'.$field. '=' .$tablename2.'.'.$field2);

        $query = $table->get();

        $results = $query->getResult();



        // print_r($query);

        return $results;

    }

    public function join_entry2($tablename, $tablename2, $field, $field2){

        $secondDb = DatabaseDefaultConnection();

        $table = $secondDb

                        ->table($tablename)

                        ->select('*')

                        ->join($tablename2, $tablename.'.'.$field. '=' .$tablename2.'.'.$field2);

        $query = $table->get();

        $results = $query->getResult();



        // print_r($query);

        return $results;

    }



    public function set_entry($tablename, $id, $column_name, $tablename2 = null){

        $table = $this->db

                    ->table($tablename)

                    ->select('*')

                    ->set($tablename.'.'.$id = $tablename2.'.'.$column_name);

        $query = $table->get();

        $results = $query->getResult();



        return $results;

    }



    public function inquiry_souece_join_entry($tablename, $tablename2, $field, $field2){

        $table = $this->db

                        ->table($tablename)

                        ->select("$tablename2.id, $tablename.$field2 , $tablename2.source, $tablename2.description")

                        ->join($tablename2, $tablename.'.'.$field. '=' .$tablename2.'.'.$field2);

        $query = $table->get();

        $results = $query->getResult();



        // pre($results);

        return $results;

    }



    public function inquiry_souece_join_entry2($tablename, $tablename2, $field, $field2){

        $secondDb = DatabaseDefaultConnection();

        $table = $secondDb

                        ->table($tablename)

                        ->select("$tablename2.id, $tablename.$field2 , $tablename2.source, $tablename2.description")

                        ->join($tablename2, $tablename.'.'.$field. '=' .$tablename2.'.'.$field2);

        $query = $table->get();

        $results = $query->getResult();



        // pre($results);

        return $results;

    }

    // protected $table = 'urvi_user';

    function get_username($tablename,$username) {

		$sql = "SELECT * FROM  ".$tablename." WHERE username = '".$username."' LIMIT 1";

		$query = $this->db->query($sql, [$username]);

		$row = $query->getRow();

		if ($row) {

			return true;

		}

		return false;

	}

	 function get_username2($tablename,$username) {

        $secondDb = DatabaseDefaultConnection();

		$sql = "SELECT * FROM  ".$tablename." WHERE username = '".$username."' LIMIT 1";

		$query = $secondDb->query($sql, [$username]);

		$row = $query->getRow();

		if ($row) {

			return true;

		}

		return false;

	}


    public function get_chatting_record($insert_data, $table_name) {
        $secondDb = DatabaseDefaultConnection();

		$query = $secondDb->table($table_name)
			->where('client_name', $insert_data['client_name']) 
			->get();
	
		return $query->getResult();
	}


    public function checkDuplicateData($Data,$tablename) {

        $multiClause = $Data;   

        $result = $this->db

                    ->table($tablename)

                    ->where($multiClause)->get();

        $count_row = $result->getNumRows();

        if ($count_row > 0) {

            return FALSE; // here I change TRUE to false.

         } else {

            return TRUE; // And here false to TRUE

         }

    }

    public function checkDuplicateData2($Data,$tablename) {

        $secondDb = DatabaseDefaultConnection();

        $multiClause = $Data;   

        $result = $secondDb

                    ->table($tablename)

                    ->where($multiClause)->get();

        $count_row = $result->getNumRows();

        if ($count_row > 0) {

            return FALSE; // here I change TRUE to false.

         } else {

            return TRUE; // And here false to TRUE

         }

    }

   

    public function filter_data($tablename, $query)

    {



        $query = "SELECT * FROM " . $tablename . " WHERE  " . $query . " ORDER by id DESC";



        // pre( $query);

        // die();

        $result = $this->db->query($query);

        return json_encode($result->getResult());



    }


    //for bot sequence
   


}

