<div class="card">
    <div class='card-header'>
        <i data-feather="mail" class='icon-16 mr10'></i><?php echo $model_info->template_name; ?>
    </div>
    <?php echo form_open(get_uri("email_templates/save_template"), array("id" => "email-template-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
        <div class='row'>

        <div class="form-group">
                <div class=" col-md-12">
                    <label><strong>Nombre de la plantilla:</strong></label>
                    <?php
                    echo form_input(array(
                        "id" => "template_name",
                        "name" => "template_name",
                        "value" => $model_info->template_name,
                        "class" => "form-control",
                        "placeholder" => app_lang('name_template'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ));
                    ?>
                    <span id="unsupported-title-variable-error" class="text-danger inline-block mt5 hide"></span>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                <label><strong>Asunto del correo:</strong></label>
                    <?php
                    echo form_input(array(
                        "id" => "email_subject",
                        "name" => "email_subject",
                        "value" => $model_info->email_subject,
                        "class" => "form-control",
                        "placeholder" => app_lang('subject'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ));
                    ?>
                    <span id="unsupported-title-variable-error" class="text-danger inline-block mt5 hide"></span>
                </div>
            </div>
            <div class="form-group">
                <div class=" col-md-12">
                    <?php
                    echo form_textarea(array(
                        "id" => "custom_message",
                        "name" => "custom_message",
                        "value" => $model_info->default_message,
                        "class" => "form-control"
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default cancel-upload" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
            <button id="submit-btn" type="submit" class="btn btn-primary mr15"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>       
        </div>

    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#email-template-form").appForm({
            isModal: false,
            beforeAjaxSubmit: function (data) {
                var custom_message = encodeAjaxPostData(getWYSIWYGEditorHTML("#custom_message"));
                $.each(data, function (index, obj) {
                    if (obj.name === "custom_message") {
                        data[index]["value"] = custom_message;
                    }
                });
            },
            onSuccess: function (result) {
                if (result.success) {
                   $('#ajaxModal').modal('toggle');
                    appAlert.success(result.message, {duration: 100});
                    window.location.replace("templates");
                } else {
                    appAlert.error(result.message);
                }
            }
        });

    

        initWYSIWYGEditor("#custom_message", {height: 480});

    });
</script>    