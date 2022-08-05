<div id="page-content" class="page-wrapper clearfix">
    <ul class="nav nav-tabs bg-white title" role="tablist">
        <li class="title-tab"><h4 class="pl15 pt10 pr15"><?php echo 'Reporte de clientes / prospectos' ?></h4></li>
    </ul>

    <div class="card">
        <div class="table-responsive">
            <table id="lead-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

    $("#lead-table").appTable({
        order: [[ 0, "asc" ]],
    source: '<?php echo_uri("leads/list_report_source") ?>',
            columns: [
            {title: "<?php echo app_lang('id') ?>"},
            {title: "<?php echo app_lang('source') ?>"},
            {title: "<?php echo "Contador de leads" ?>"},
            ],
            filterDropdown: [
                {name: "source_id", class: "w200", options: <?php echo json_encode($lead_sources); ?>}
            ],
    });
    }
    );
</script>

<?php echo view("leads/update_lead_status_script"); ?>