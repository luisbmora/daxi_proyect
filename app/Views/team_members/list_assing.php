<div class="tab-content">
    <?php echo form_open(get_uri("team_members/save_assing"), array("id" => "general-info-form", "class" => "general-form dashed-row white", "role" => "form")); ?>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <h6><strong>Selecciona a los usuarios que se les podra asignar leads</strong></h6>
            <?php
            foreach ($assing_list as $member) {
                
            ?>
                <div class="row"> 
                    <div class=" col-md-10">
                     <?php
                        echo form_input(array(
                            "id" => "first_name",
                            "name" => "first_name",
                            "value" => $member->fullName,
                            "class" => "form-control",
                            "placeholder" => app_lang('first_name'),
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required")
                        ));
                        ?>
                    </div>
                    <div class=" col-md-2">
                        <input type="hidden" name="id[]" value="<?=$member->id?>">
                        <input type="checkbox"name="assing[]" value="<?=$member->id?>" <?php  if($member->assing==1){echo "checked";}?>>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
         </div>
        <div class="card-footer rounded-0" align="right">
            <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#general-info-form").appForm({
            isModal: false,
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                setTimeout(function () {
                    $('#ajaxModal').modal('toggle');
                }, 500);
            }
        });
    });
</script>    