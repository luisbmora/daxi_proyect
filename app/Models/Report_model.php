<?php

namespace App\Models;

class Report_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'settings';
        parent::__construct($this->table);
    }


    
    function get_list_contacts($options = array())
    {
        $var=array(1,2,3,1,2,3,1);
        return $var;
    }

    








}
