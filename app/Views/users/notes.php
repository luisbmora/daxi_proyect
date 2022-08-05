<div class="tab-content">
    <?php
    $url = "leads";
    $show_submit = true;
    if ($user_info->user_type === "client") {
        $url = "clients";
        if (isset($can_edit_clients) && !$can_edit_clients) {
            $show_submit = false;
        }
    }
 
    echo form_open(get_uri($url . "/save_notes/" . $user_info->id), array("id" => "account-info-form", "class" => "general-form dashed-row white", "role" => "form"));
    ?>
    <div class="card">
        <div class=" card-header">
            <h4><?php echo app_lang('account_notes'); ?></h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label for="notes" class=" col-md-2"><?php echo app_lang('notes'); ?></label>
                    <input type="hidden" name="client_id" value="<?=$model_info->id;?>">
                    <div class=" col-md-10">
                        <?php
                        
                        echo form_textarea(array(
                            "id" => "notes",
                            "name" => "notes",
                            "value" => $model_info->notes,
                            "class" => "form-control",
                            "placeholder" => app_lang('notes') . "...",
                            "data-rich-text-editor" => true
                        ));
                        ?>
                    </div>
                </div>
            </div>
   

        </div>
        <?php if ($show_submit) { ?>
            <div class="card-footer rounded-0">
                <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
            </div>
        <?php } ?>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#account-info-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
            }
        });
        $("#account-info-form .select2").select2();
 
    });
</script>    