<?php

namespace App\Models;

class Email_templates_model extends Crud_model
{

    protected $table = null;

    public function __construct()
    {
        $this->table = 'email_templates';
        parent::__construct($this->table);
    }

    public function get_details($options = array())
    {
        $email_templates_table = $this->db->prefixTable('email_templates');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where = " AND $email_templates_table.id=$id";
        }

        $sql = "SELECT $email_templates_table.*
        FROM $email_templates_table
        WHERE $email_templates_table.deleted=0 $where";
        return $this->db->query($sql);
    }

    public function get_final_template($template_name = "")
    {
        $email_templates_table = $this->db->prefixTable('email_templates');

        $sql = "SELECT $email_templates_table.default_message, $email_templates_table.custom_message, $email_templates_table.email_subject,
            signature_template.custom_message AS signature_custom_message, signature_template.default_message AS signature_default_message
        FROM $email_templates_table
        LEFT JOIN $email_templates_table AS signature_template ON signature_template.template_name='signature'
        WHERE $email_templates_table.deleted=0 AND $email_templates_table.template_name='$template_name'";
        $result = $this->db->query($sql)->getRow();

        $info = new \stdClass();
        $info->subject = $result->email_subject;
        $info->message = $result->custom_message ? $result->custom_message : $result->default_message;
        $info->signature = $result->signature_custom_message ? $result->signature_custom_message : $result->signature_default_message;

        return $info;
    }

    public function get_templates($options = array())
    {
        $mail_table = $this->db->prefixTable('email_templates');
        $where = "";

        $user_id = get_array_value($options, "user_id");
        $admin = get_array_value($options, "admin");

        if ($admin != 1) {
            if ($user_id) {
                $where .= "and $mail_table.user_id='$user_id'";
            }
        }

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select * FROM $mail_table where deleted=0 and user_id != '' " . $where;

        return $this->db->query($sql);

    }

    public function get_emails($options = array())
    {

        $send_table = $this->db->prefixTable('sendmail');
        $user_table = $this->db->prefixTable('users');

        $where = "";
        $owner_id = get_array_value($options, "owner_id");

        $start_date = get_array_value($options, "start_date");
        if ($start_date) {
            $where .= " AND DATE($send_table.date)>='$start_date'";
        }
        $end_date = get_array_value($options, "end_date");
        if ($end_date) {
            $where .= " AND DATE($send_table.date)<='$end_date'";
        }

        $this->db->query('SET SQL_BIG_SELECTS=1');

        if (get_array_value($options, "admin") != 1) {

            if ($owner_id) {
                $where .= " AND $send_table.owner_id=$owner_id";
            }
        } else {

            if (isset($owner_id)) {
                    if($owner_id != ''){
                        $where .= " AND $send_table.owner_id=$owner_id";
                    }
            }
        }


        $sql = "SELECT
        $send_table.id,
        $send_table.email,
        concat($user_table.first_name, ' ',$user_table.last_name) as fullName,
        $send_table.subject,
        $send_table.date
        FROM
        $send_table
        INNER JOIN $user_table ON $send_table.owner_id = $user_table.id" . $where;

        return $this->db->query($sql);
    }

    public function view_detail_mail($id)
    {

        $send_table = $this->db->prefixTable('sendmail');
        $user_table = $this->db->prefixTable('users');

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "SELECT
        $send_table.id,
        $send_table.email,
        concat($user_table.first_name, ' ',$user_table.last_name) as fullName,
        $send_table.subject,
        $send_table.date,
        $send_table.template
        FROM
        $send_table
        INNER JOIN $user_table ON $send_table.owner_id = $user_table.id where $send_table.id=" . $id;
        
        return $this->db->query($sql);

    }

    public function ci_save_new($template_name, $custom_message, $id)
    {
        $mail_table = $this->db->prefixTable('email_templates');

        $bodytag = str_replace("~", "=", $custom_message);

        $sql = "insert into $mail_table values(null, '" . $template_name . "','" . $template_name . "', '" . $bodytag . "', '" . $bodytag . "', 0, " . $id . ")";
        return $this->db->query($sql);
    }

    public function save_mail_send($options = array())
    {
        $table = $this->db->prefixTable('sendmail');

        $owner_id = get_array_value($options, "owner_id");
        $email = get_array_value($options, "email");
        $date = get_array_value($options, "date");
        $subject = get_array_value($options, "subject");
        $template = get_array_value($options, "template");

        $sql = "insert into $table values(null, '" . $owner_id . "','" . $email . "', '" . $date . "','" . $options['subject'] . "','" . $template . "')";
        return $this->db->query($sql);

    }

    public function delete_reg($id)
    {
        $mail_table = $this->db->prefixTable('email_templates');

        $sql = "delete from $mail_table where id=" . $id;
        return $this->db->query($sql);
    }

    public function save_data($id, $template_name, $email_subject, $custom_message)
    {
        $mail_table = $this->db->prefixTable('email_templates');

        $sql = "update $mail_table set template_name='" . $template_name . "', email_subject='" . $email_subject . "',default_message='" . $custom_message . "', custom_message='" . $custom_message . "' where id=" . $id;
        return $this->db->query($sql);
    }

    public function data_host_mail($options = array())
    {
        $mail_table = $this->db->prefixTable('settings');

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select * from $mail_table where setting_name like '%email%'";
        return $this->db->query($sql);
    }
}
