<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class  CampaignModel extends Model
{
    // protected $table = 'master_food_request'; 
    // protected $primaryKey = 'id'; 

  

    public function __construct(ConnectionInterface &$db) {

        $this->db =& $db;

    }


public function get_record_count($table_name)
    {
        $secondDb = DatabaseDefaultConnection();
        $query = $secondDb->query("SELECT COUNT(*) AS record_count FROM $table_name");
        
        $result = $query->getRow();
        return $result->record_count;
    }
    public function get_max_sequence($table_name, $bot_id)
    {
        $secondDb = DatabaseDefaultConnection();
        $query = $secondDb->query("SELECT MAX(sequence) AS max_sequence FROM $table_name WHERE bot_id = $bot_id");
        
        $result = $query->getRow();
        return $result ? $result->max_sequence : null;
    }

    public function delete_question_sequence($table_name, $bot_id, $delete_sequence)
    {
        $secondDb = DatabaseDefaultConnection();

        $query = $secondDb->table($table_name)
                ->select('*')
                ->where('bot_id', $bot_id)
                ->where('sequence >', $delete_sequence)
                ->orderBy('sequence')
                ->get();

        $queryResult = $query->getResultArray();

        foreach ($queryResult as $question) {
            $secondDb->table($table_name)
                ->where('id', $question['id'])
                ->update(['sequence' => $question['sequence'] - 1]);
        }
    }


    public function get_sequence_by_id($table_name, $id)
    {
        // Assuming $id is the primary key of the question
        $db_connection = DatabaseDefaultConnection();
        $query = $db_connection->table($table_name)->select('sequence')->where('id', $id)->get();
        $result = $query->getRow();

        if ($result) {
            return $result->sequence;
        } else {
            return null;
        }
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
    public function update_entry_by_name($name, $data, $tablename)
    {
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb
            ->table($tablename)
            ->where('name', $name) // Match the name column
            ->set($data)
            ->update();

        return $result;
    }
    public function update_entry_by_audience_id($audience_id, $data, $tablename)
    {
        $secondDb = DatabaseDefaultConnection();
        $result = $secondDb
            ->table($tablename)
            ->where('audience_id', $audience_id) // Match the name column
            ->set($data)
            ->update();

        return $result;
    }

}

?>