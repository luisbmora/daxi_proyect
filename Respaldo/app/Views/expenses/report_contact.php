<div id="page-content" class="page-wrapper clearfix">
    <div class="card">
        <div class="table-responsive">
            <table id="template-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#template-table").appTable({
            source: '<?php echo_uri("expenses/report_list_data") ?>',
            order: [[1, 'desc']],
            dateRangeType: "yearly",
            columns: [
                {targets: [1], visible: false},
                {title: '<?php echo app_lang("template_name");?>'},
                {title: '<?php echo "Asunto";?>'},
                {title: "<i data-feather='menu' class='icon-16'></i>", "class": "text-center option w100"}
            ]
        });
        
    });
</script>


