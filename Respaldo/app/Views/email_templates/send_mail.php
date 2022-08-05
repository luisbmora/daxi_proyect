<div class="card">
    <?php echo form_open(get_uri("email_templates/send_email_template"), array("id" => "email-send-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
        <div class='row'>

        <div class="form-group">
                <div class=" col-md-12">
                    <label><strong>Nombre de la plantilla:</strong></label>
                    <?php
                        echo form_dropdown(
                            "template_name", $templates_dropdown, array(), 
                            "class='select2 form-control' 
                            id='template_select' 
                            data-rule-required='true', 
                            name='template_name'");    
                    ?>
                    <span id="unsupported-title-variable-error" class="text-danger inline-block mt5 hide"></span>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                <label><strong>Asunto del correo:</strong></label>
                <input type="text" id="email_subject" name="email_subject" value="" class= "form-control" placeholder ="Asunto del correo" autofocus = "true" required>
                </div>
            </div>
            <div class="form-group">
                <div class=" col-md-12">
                    <label><strong>Correo de destino:</strong></label>
                    <input type="email" id="email" name="email" class= "form-control" placeholder ="Correo a donde se enviará el correo " autofocus = "true" required>
                    <span id="unsupported-title-variable-error" class="text-danger inline-block mt5 hide"></span>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                    <textarea name="custom_message" class="form-control" id="custom_message"><p id="txt_template"></p></textarea>
                </div>
            </div>

             <div class="form-group">
                <div class="col-md-12">
                    <input name="file_names" id="file_names" type="file" class="form-control">
                </div>
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default cancel-upload" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
            <button id="submit-btn" type="submit" class="btn btn-primary mr15"><span data-feather="check-circle" class="icon-16"></span> <?php echo "Enviar correo"; ?></button>       
        </div>

    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        select_template($('#template_select').val());

        $("#email-send-form").appForm({
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

       
                    
            $("#submit-btn").click(function() {
                $('#ajaxModal').modal('toggle');
                    appAlert.success("Correo enviado correctamente", {duration: 10000});
            });



    

        initWYSIWYGEditor("#custom_message", {height: 480});

        $("#email-template-form .select2").select2();


        $("#template_select").change(function() {
            var id = $(this).val();
               $.ajax({                        
                    type: "POST",                 
                    url: "data",                    
                    data: {'id': id},
                    success: function(response)            
                    {
                        var parsed_data = JSON.parse(response);

                        $('#email_subject').val(parsed_data.email_subject);
                        $('#template_email').val(parsed_data.template_name);
                        $('#txt_template').html(parsed_data.default_message);
                    
                    }
                });
        });

        function select_template(id){
               $.ajax({                        
                    type: "POST",                 
                    url: "data",                    
                    data: {'id': id},
                    success: function(response)            
                    {
                        var parsed_data = JSON.parse(response);

                        $('#email_subject').val(parsed_data.email_subject);
                        $('#template_email').val(parsed_data.template_name);
                        $('#txt_template').html(parsed_data.default_message);
                    
                    }
                });
        }
    });
</script>    