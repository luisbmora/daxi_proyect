<div id="page-content" class="page-wrapper clearfix">
    <div class="card">
        <div class="table-responsive">
            <table id="source-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

    $("#source-table").appTable({
        order: [[ 0, "asc" ]],
    source: '<?php echo_uri("leads/list_report") ?>',
            columns: [
            {title: "<?php echo app_lang('id') ?>"},
            {title: "<?php echo 'Cliente'; ?>"},
            {title: "<?php echo "Teléfono"; ?>"},
            {title: "<?php echo "Email"; ?>"},
            {title: "<?php echo "Ciudad"; ?>"},
            {title: "<?php echo "Estado"; ?>"}
            ],
            filterDropdown: [
                {name: "source_id", class: "w200", options: <?php echo json_encode($lead_sources); ?>}
            ],
    });
    }
    );
</script>

