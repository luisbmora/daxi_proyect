<div id="page-content" class="page-wrapper clearfix">
    <div class="card">
        <div class="page-title clearfix">
            <h1> <?php echo "Reporte de prospectos";?></h1>
            <div class="title-button-group">
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
            source: '<?php echo_uri("reports/list_data_clients") ?>',
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


