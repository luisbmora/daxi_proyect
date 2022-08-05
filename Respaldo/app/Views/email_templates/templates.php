<div id="page-content" class="page-wrapper clearfix">
    <div class="card">
        <div class="page-title clearfix">
            <h1> <?php echo app_lang('email_templates');?></h1>
            <div class="title-button-group">
            <?php echo modal_anchor(get_uri("email_templates/send_mail"), "<i data-feather='at-sign' class='icon-16'></i> Enviar correo", array("class" => "btn btn-default", "title" =>"Enviar correo")); ?>    
            <?php echo modal_anchor(get_uri("email_templates/modal_template"), "<i data-feather='plus-circle' class='icon-16'></i> Añadir plantilla de correo", array("class" => "btn btn-default", "title" => app_lang('email_templates'))); ?>
            </div>
        </div>
        <div class="table-responsive">
            <table id="template-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#template-table").appTable({
            source: '<?php echo_uri("email_templates/list_data") ?>',
            order: [[1, 'desc']],
            columns: [
                {targets: [1], visible: false},
                {title: '<?php echo app_lang("template_name");?>'},
                {title: '<?php echo "Asunto";?>'},
                {title: "<i data-feather='menu' class='icon-16'></i>", "class": "text-center option w100"}
            ]
        });
        
    });
</script>


