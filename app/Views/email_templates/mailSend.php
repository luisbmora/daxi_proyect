<div id="page-content" class="page-wrapper clearfix">
    <div class="card">
        <div class="page-title clearfix">
            <h1> <?php echo 'Correos Enviados';?></h1>
            <div class="title-button-group">
            <?php echo modal_anchor(get_uri("email_templates/send_mail"), "<i data-feather='at-sign' class='icon-16'></i> Enviar correo", array("class" => "btn btn-default", "title" =>"Enviar correo")); ?>    
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
            source: '<?php echo_uri("email_templates/list_data_mails") ?>',
            order: [[1, 'asc']],
            columns: [
                
                {title: '<?php echo "Id";?>'},
                {title: '<?php echo "Enviado A";?>'},
                {title: '<?php echo "Propietario";?>'},
                {title: '<?php echo "Asunto";?>'},
                {title: '<?php echo "Fecha";?>'},
                {title: "<i data-feather='menu' class='icon-16'></i>", "class": "text-center option w100"}
            ],
            filterDropdown: [
                <?php if ($login_user->is_admin==1) { ?>
                 {name: "owner_id", class: "w200", options: <?php echo json_encode($owners_dropdown); ?>}
                <?php } ?>
                
            ],
            rangeDatepicker: [{startDate: {name: "start_date", value: ""}, endDate: {name: "end_date", value: ""}, showClearButton: true}]
        });
        
    });
</script>


