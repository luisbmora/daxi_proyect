<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

class Email_templates extends Security_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->access_only_admin_or_settings_admin();
    }

    private function _templates()
    {
        $templates_array = array(
            "account" => array(
                "login_info" => array("USER_FIRST_NAME", "USER_LAST_NAME", "DASHBOARD_URL", "USER_LOGIN_EMAIL", "USER_LOGIN_PASSWORD", "LOGO_URL", "SIGNATURE"),
                "reset_password" => array("ACCOUNT_HOLDER_NAME", "RESET_PASSWORD_URL", "SITE_URL", "LOGO_URL", "SIGNATURE"),
                "team_member_invitation" => array("INVITATION_SENT_BY", "INVITATION_URL", "SITE_URL", "LOGO_URL", "SIGNATURE"),
                "new_client_greetings" => array("CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "COMPANY_NAME", "DASHBOARD_URL", "CONTACT_LOGIN_EMAIL", "CONTACT_LOGIN_PASSWORD", "LOGO_URL", "SIGNATURE"),
                "client_contact_invitation" => array("INVITATION_SENT_BY", "INVITATION_URL", "SITE_URL", "LOGO_URL", "SIGNATURE"),
                "verify_email" => array("VERIFY_EMAIL_URL", "SITE_URL", "LOGO_URL", "SIGNATURE"),
            ),
            "project" => array(
                "project_completed" => array("PROJECT_ID", "PROJECT_TITLE", "USER_NAME", "PROJECT_URL", "LOGO_URL", "SIGNATURE"),
                "project_task_deadline_reminder" => array("APP_TITLE", "DEADLINE", "SIGNATURE", "TASKS_LIST", "LOGO_URL"),
            ),
            "invoice" => array(
                "send_invoice" => array("INVOICE_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "PROJECT_TITLE", "BALANCE_DUE", "DUE_DATE", "SIGNATURE", "INVOICE_URL", "LOGO_URL", "PUBLIC_PAY_INVOICE_URL"),
                "invoice_payment_confirmation" => array("INVOICE_ID", "PAYMENT_AMOUNT", "INVOICE_URL", "LOGO_URL", "SIGNATURE"),
                "invoice_due_reminder_before_due_date" => array("INVOICE_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "PROJECT_TITLE", "BALANCE_DUE", "DUE_DATE", "SIGNATURE", "INVOICE_URL", "LOGO_URL"),
                "invoice_overdue_reminder" => array("INVOICE_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "PROJECT_TITLE", "BALANCE_DUE", "DUE_DATE", "SIGNATURE", "INVOICE_URL", "LOGO_URL"),
                "recurring_invoice_creation_reminder" => array("CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "APP_TITLE", "INVOICE_URL", "NEXT_RECURRING_DATE", "LOGO_URL", "SIGNATURE"),
            ),
            "estimate" => array(
                "estimate_sent" => array("ESTIMATE_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "SIGNATURE", "ESTIMATE_URL", "LOGO_URL"),
                "estimate_accepted" => array("ESTIMATE_ID", "SIGNATURE", "ESTIMATE_URL", "LOGO_URL"),
                "estimate_rejected" => array("ESTIMATE_ID", "SIGNATURE", "ESTIMATE_URL", "LOGO_URL"),
                "estimate_request_received" => array("ESTIMATE_REQUEST_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "SIGNATURE", "ESTIMATE_REQUEST_URL", "LOGO_URL"),
                "estimate_commented" => array("ESTIMATE_ID", "USER_NAME", "COMMENT_CONTENT", "ESTIMATE_URL", "LOGO_URL", "SIGNATURE"),
            ),
            "contract" => array(
                "contract_sent" => array("CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "CONTRACT_ID", "CONTRACT_URL", "PUBLIC_PROPOSAL_URL", "PROJECT_TITLE", "SIGNATURE", "LOGO_URL"),
                "contract_accepted" => array("CONTRACT_ID", "CONTRACT_URL", "PROJECT_TITLE", "SIGNATURE", "LOGO_URL"),
                "contract_rejected" => array("CONTRACT_ID", "CONTRACT_URL", "PROJECT_TITLE", "SIGNATURE", "LOGO_URL"),
            ),
            "proposal" => array(
                "proposal_sent" => array("CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "PROPOSAL_ID", "PROPOSAL_URL", "PUBLIC_PROPOSAL_URL", "SIGNATURE", "LOGO_URL"),
                "proposal_accepted" => array("PROPOSAL_ID", "PROPOSAL_URL", "SIGNATURE", "LOGO_URL"),
                "proposal_rejected" => array("PROPOSAL_ID", "PROPOSAL_URL", "SIGNATURE", "LOGO_URL"),
            ),
            "order" => array(
                "new_order_received" => array("ORDER_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "SIGNATURE", "ORDER_URL", "LOGO_URL"),
                "order_status_updated" => array("ORDER_ID", "CONTACT_FIRST_NAME", "CONTACT_LAST_NAME", "SIGNATURE", "ORDER_URL", "LOGO_URL"),
            ),
            "ticket" => array(
                "ticket_created" => array("TICKET_ID", "TICKET_TITLE", "USER_NAME", "TICKET_CONTENT", "TICKET_URL", "LOGO_URL", "SIGNATURE"),
                "ticket_commented" => array("TICKET_ID", "TICKET_TITLE", "USER_NAME", "TICKET_CONTENT", "TICKET_URL", "LOGO_URL", "SIGNATURE"),
                "ticket_closed" => array("TICKET_ID", "TICKET_TITLE", "USER_NAME", "TICKET_URL", "LOGO_URL", "SIGNATURE"),
                "ticket_reopened" => array("TICKET_ID", "TICKET_TITLE", "USER_NAME", "TICKET_URL", "SIGNATURE", "LOGO_URL"),
            ),
            "message" => array(
                "message_received" => array("SUBJECT", "USER_NAME", "MESSAGE_CONTENT", "MESSAGE_URL", "APP_TITLE", "LOGO_URL", "SIGNATURE"),
            ),
            "common" => array(
                "general_notification" => array("EVENT_TITLE", "EVENT_DETAILS", "APP_TITLE", "COMPANY_NAME", "NOTIFICATION_URL", "LOGO_URL", "SIGNATURE"),
                "signature" => array(),
            ),
        );

        $tickets_template_variables = $this->Custom_fields_model->get_email_template_variables_array("tickets", 0, $this->login_user->is_admin, $this->login_user->user_type);
        if ($tickets_template_variables) {
            //marge custom variables with default variables
            $templates_array["ticket"]["ticket_created"] = array_merge($templates_array["ticket"]["ticket_created"], $tickets_template_variables);
            $templates_array["ticket"]["ticket_commented"] = array_merge($templates_array["ticket"]["ticket_commented"], $tickets_template_variables);
            $templates_array["ticket"]["ticket_closed"] = array_merge($templates_array["ticket"]["ticket_closed"], $tickets_template_variables);
            $templates_array["ticket"]["ticket_reopened"] = array_merge($templates_array["ticket"]["ticket_reopened"], $tickets_template_variables);
        }

        return $templates_array;
    }

    private function _get_owners_dropdown($view_type = "") {
        $team_members = $this->Users_model->get_all_where(array("user_type" => "staff", "deleted" => 0, "status" => "active"))->getResult();
        $team_members_dropdown = array();

        if ($view_type == "filter") {
            $team_members_dropdown = array(array("id" => "", "text" => "- " . app_lang("owner") . " -"));
        }

        foreach ($team_members as $member) {
            $team_members_dropdown[] = array("id" => $member->id, "text" => $member->first_name . " " . $member->last_name);
        }

        return $team_members_dropdown;
    }


    public function index()
    {
        $view_data["templates"] = $this->_templates();
        return $this->template->rander("email_templates/index", $view_data);
    }

    public function templates()
    {
        
        $view_data["templates"] = $this->_templates();
        return $this->template->rander("email_templates/templates", $view_data);

    }

    public function sendMail()
    {
        $view_data = array();

        return $this->template->view('email_templates/sendMail', $view_data);
    }

    public function mailSend()
    {
        $view_data['owners_dropdown'] = $this->_get_owners_dropdown("filter");
        $view_data["templates"] = $this->_templates();
        return $this->template->rander("email_templates/mailSend", $view_data);
    }

    public function send_mail($template_name = '')
    {

        $options = array();

        $options["user_id"] = $this->login_user->id;

        $list_data = $this->Email_templates_model->get_templates($options)->getResult();
        $result = array();

        foreach ($list_data as $data) {
            $user_name = $data->template_name;
            $view_data['templates_dropdown'][$data->id] = $user_name;
        }

        $view_data['model_info'] = $this->Email_templates_model->get_one_where(array("template_name" => $template_name));

        return $this->template->view('email_templates/send_mail', $view_data);

    }

    public function send_email_template()
    {

        $body_message = str_replace("~", "=", $this->request->getPost("custom_message"));

        $options["owner_id"]= $this->login_user->id;
        $options["email"]=$this->request->getPost('email');
        $options["date"]=date('Y-m-d h:m:i');
        $options["subject"]=utf8_decode($this->request->getPost('email_subject'));
        $options["template"]=$body_message;

      

        $mail = new PHPMailer(true);
        try {
            $options = array();

            $mail->isSMTP();
            $mail->Host = 'mail.grupodaxi.site';
            $mail->SMTPAuth = true;
            $mail->Username = 'crm@grupodaxi.site';
            $mail->Password = 'r.(A6y_95lzL';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('crm@grupodaxi.site', 'CRM Grupo Daxi');
            $mail->AddAddress($this->request->getPost('email'));

            if ($_FILES['file_names']['tmp_name'] != '') {
                $mail->AddAttachment($_FILES['file_names']['tmp_name'], $_FILES['file_names']['name']);
            }

            $mail->Host = 'mail.grupodaxi.site';
            $mail->SMTPAuth = true;
            $mail->Username = 'crm@grupodaxi.site';
            $mail->Password = 'r.(A6y_95lzL';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->isHTML(true);
            $mail->Subject = utf8_decode($this->request->getPost('email_subject'));

            $body_message = str_replace("~", "=", $this->request->getPost("custom_message"));

            $mail->Body = $body_message;

            $mail->AltBody = 'Version en texto plano del correo (No HTML, no formato)';
            $mail->send();

            $options["owner_id"]= $this->login_user->id;
            $options["email"]=$this->request->getPost('email');
            $options["date"]=date('Y-m-d h:m:i');
            $options["subject"]=$this->request->getPost('email_subject');
            $options["template"]=$body_message;

            $list_email=array();
            $list_email=$this->Email_templates_model->save_mail_send($options);

            var_dump($list_email);


            echo 'El correo fue enviado';
        } catch (Exception $e) {
            echo "Ocurrio un error: {$mail->ErrorInfo}";
        }

    }

    public function save()
    {
        $this->validate_submitted_data(array(
            "id" => "required|numeric",
        ));

        $id = $this->request->getPost('id');

        $data = array(
            "email_subject" => $this->request->getPost('email_subject'),
            "custom_message" => decode_ajax_post_data($this->request->getPost('custom_message')),
        );
        $save_id = $this->Email_templates_model->ci_save($data, $id);
        if ($save_id) {
            echo json_encode(array("success" => true, 'id' => $save_id, 'message' => app_lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    public function save_template()
    {
        $this->validate_submitted_data(array(
            "id" => "required|numeric",
        ));

        $id = $this->request->getPost('id');
        $template_name = $this->request->getPost('template_name');
        $email_subject = $this->request->getPost('email_subject');
        $custom_message = decode_ajax_post_data($this->request->getPost('custom_message'));

        $save_id = $this->Email_templates_model->save_data($id, $template_name, $email_subject, $custom_message);

        if ($save_id) {
            echo json_encode(array("success" => true, 'message' => app_lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    function new () {

        $template_name = $this->request->getPost('template_name');
        $custom_message = $this->request->getPost('custom_message');
        $id = $this->login_user->id;

        $save_id = $this->Email_templates_model->ci_save_new($template_name, $custom_message, $id);

        if ($save_id) {
            echo json_encode(array("success" => true, 'message' => 'Plantilla creada correctamente'));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    public function restore_to_default()
    {

        $this->validate_submitted_data(array(
            "id" => "required|numeric",
        ));

        $template_id = $this->request->getPost('id');

        $data = array(
            "custom_message" => "",
        );
        $save_id = $this->Email_templates_model->ci_save($data, $template_id);
        if ($save_id) {
            $default_message = $this->Email_templates_model->get_one($save_id)->default_message;
            echo json_encode(array("success" => true, "data" => $default_message, 'message' => app_lang('template_restored')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    /* load template edit form */

    public function form($template_name = "")
    {
        $view_data['model_info'] = $this->Email_templates_model->get_one_where(array("template_name" => $template_name));
        $variables_array = array_column($this->_templates(), $template_name);
        $variables = get_array_value($variables_array, 0);
        $view_data['variables'] = $variables ? $variables : array();
        $view_data['unsupported_title_variables'] = json_encode(array("SIGNATURE", "TASKS_LIST", "TICKET_CONTENT", "MESSAGE_CONTENT", "EVENT_DETAILS"));
        return $this->template->view('email_templates/form', $view_data);
    }

    public function modal_template($template_name = "")
    {

        $login_user_id = $this->Users_model->login_user_id();
        if (!$login_user_id) {
            show_404();
        }

        $user_info = $this->Users_model->get_one($login_user_id);
        $view_data["user_info"] = $user_info;

        $view_data['model_info'] = $this->Email_templates_model->get_one_where(array("template_name" => $template_name));
        $variables_array = array_column($this->_templates(), $template_name);
        $variables = get_array_value($variables_array, 0);
        $view_data['variables'] = $variables ? $variables : array();
        $view_data['unsupported_title_variables'] = json_encode(array("SIGNATURE", "TASKS_LIST", "TICKET_CONTENT", "MESSAGE_CONTENT", "EVENT_DETAILS"));
        return $this->template->view('email_templates/modal_template', $view_data);

    }

    public function list_data()
    {

        $options = array();

        $options["user_id"] = $this->login_user->id;

        $list_data = $this->Email_templates_model->get_templates($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    public function list_data_mails()
    {

        $options = array();
        $options = array(
            "owner_id" => $this->request->getPost('owner_id'),
            "start_date" => $this->request->getPost("start_date"),
            "end_date" => $this->request->getPost("end_date"),
        );
        

        $list_data = $this->Email_templates_model->get_emails($options)->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row_emails($data);
        }
        echo json_encode(array("data" => $result));
    }

    private function _make_row_emails($data)
    {

        $row_data = modal_anchor(get_uri("email_templates/view_mail"), "<i data-feather='eye' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('view_details'), "data-post-id" => $data->id));

        return array(
            $data->id,
            $data->email,
            $data->fullName,
            $data->subject,
            $data->date,
            $row_data
        );
    }

    private function _make_row($data)
    {

        $row_data = modal_anchor(get_uri("email_templates/edit_template"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_template'), "data-post-id" => $data->id))
        . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_template'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("email_templates/delete_reg"), "data-action" => "delete-confirmation"));

        return array(
            $data->id,
            $data->template_name,
            $data->email_subject,
            $row_data,
        );
    }

    public function delete_reg()
    {

        $id = $this->request->getPost('id');

        if ($this->Email_templates_model->delete_reg($id)) {

            echo json_encode(array("success" => true, 'message' => app_lang('record_deleted')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
        }
    }

    public function edit_template()
    {

        $id = $_REQUEST['id'];
        $view_data['model_info'] = $this->Email_templates_model->get_one_where(array("id" => $id));
        return $this->template->view('email_templates/modal_template_update', $view_data);
    }

    public function view_mail()
    {

        $id = $_REQUEST['id'];
        $view_data=array();
        $view_data['model_info'] = $this->Email_templates_model->view_detail_mail($id);
        return  $this->template->view('email_templates/view_mail', $view_data);

    }


    public function data()
    {
        $id = $_REQUEST['id'];
        $view_data = array();
        $view_data = $this->Email_templates_model->get_one_where(array("id" => $id));
        echo json_encode($view_data);
    }

}

/* End of file email_templates.php */
/* Location: ./app/controllers/email_templates.php */
