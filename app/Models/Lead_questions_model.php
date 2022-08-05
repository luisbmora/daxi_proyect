<?php

namespace App\Models;

class Lead_questions_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'questions';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $lead_question_table = $this->db->prefixTable('questions');


        $sql = "SELECT $lead_question_table.* FROM $lead_question_table";
        return $this->db->query($sql);
        
    }

}
