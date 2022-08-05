<?php


namespace App\Controllers;



class Reports extends Security_Controller {

    function __construct() {
        parent::__construct();
        $this->access_only_admin_or_settings_admin();
    }
    private function _templates(){

    }

    function index() {
       // $view_data["templates"] = $this->_templates();
       // return $this->template->rander("email_templates/index", $view_data);
    }

    function clients() {
        $view_data["templates"] = $this->_templates();
        return $this->template->rander("reports/clients", $view_data);
    }

    function list_data_clients(){

        $options = array();
        $options["user_id"] = $this->login_user->id;

        //$list_data = $this->Report_model->get_list_contacts($options = array());

        var_dump($this->Report_model->get_list_contacts($options = array()));
/*
            $result = array();
            foreach ($list_data as $data) {
                $result[] = $this->_make_row($data);
            }
          / echo json_encode(array("data" => $result));*/
    }

    private function _make_row($data) {
 

        
        $row_data = modal_anchor(get_uri("email_templates/edit_template"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_template'), "data-post-id" => $data->id))
        . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_template'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("email_templates/delete_reg"), "data-action" => "delete-confirmation"));


        return array(
            $data->id,
            $data->template_name,
            $data->email_subject,
            $row_data
        );
    }

    



}

/* End of file email_templates.php */
/* Location: ./app/controllers/email_templates.php */