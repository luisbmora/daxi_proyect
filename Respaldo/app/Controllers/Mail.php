<?php

namespace App\Controllers;
require 'app/spreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Controllers\Notes;



class Mail extends Security_Controller {

    function __construct() {
        parent::__construct();

        //check permission to access this module
        $this->init_permission_checker("lead");
    }



    /* load leads list view */

    function templates() {
        $this->access_only_allowed_members();
        $this->check_module_availability("module_lead");

        return $this->template->rander("mail/index", '');
    }

}

/* End of file mail.php */
/* Location: ./app/controllers/mail.php */