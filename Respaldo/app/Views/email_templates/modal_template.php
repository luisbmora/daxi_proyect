<div class="card">
    <div class='card-header'>
        <i data-feather="mail" class='icon-16 mr10'></i><?php echo "Plantilla nueva"; ?>
    </div>
    <?php echo form_open(get_uri("email_templates/new"), array("id" => "email-template-form", "class" => "general-form", "role" => "form")); ?>
    <div class="modal-body clearfix">
        <div class='row'>
            <div class="form-group">
                <div class=" col-md-12">
                    <?php
                    echo form_input(array(
                        "id" => "email_subject",
                        "name" => "template_name",
                        "value" => "",
                        "class" => "form-control",
                        "placeholder" => app_lang('name_template'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required")
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
                        "value" => '<div style="background-color: #eeeeef; padding: 50px 0; ">
                        <div style="max-width:640px; margin:0 auto; ">
                            <div
                                style="color: #fff; text-align: center; background-color:#33333e; padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;">
                                <h1>TITULO DEL CORREO</h1>
                            </div>
                            <div style="padding: 20px; background-color: rgb(255, 255, 255);">TEXTO DEL CORREO<br>
                                <div dir="ltr" data-smartmail="gmail_signature">
                                    <div dir="ltr">
                                    <br><br><br><br>
                                    <a href="https://api.whatsapp.com/send?phone=+52'.$user_info->phone.'"><img src="https://grupodaxi.site/files/images/whatsapp.png" data-image-whitelisted="" class="CToWUd" width="260" height="90">
                                    </a>
                                    <br><br>
                                    
                                        <table style="color:rgb(34,34,34);font-size:medium;vertical-align:-webkit-baseline-middle;font-family:Arial"
                                            cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align:top">
                                                        <table style="vertical-align:-webkit-baseline-middle;font-family:Arial" cellspacing="0"
                                                            cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align:center"><img
                                                                            src="https://ci3.googleusercontent.com/proxy/RSK3XtwVsDh1UwWZybkaUix-yL_NO9SuCQH-FivBLi1XKRmJaU8M7yzrXjULLNFQgjG6NAhsBPmMDuZ-A7rkKTeNfnHRqT1eO1EqxOpKu28-M_M=s0-d-e1-ft#https://drive.google.com/uc?id=1F3LAJClUqUSRBpNyPLDUb_CTY0Wwsg_0"
                                                                            style="max-width:128px;display:block" class="CToWUd" width="130"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align:center">
                                                                        <table
                                                                            style="vertical-align:-webkit-baseline-middle;font-family:Arial;display:inline-block"
                                                                            cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><a href="https://www.facebook.com/muktaresidencial/"
                                                                                            color="#F2B854"
                                                                                            style="color:rgb(17,85,204);display:inline-block;padding:0px;background-color:rgb(242,184,84)"
                                                                                            target="_blank"
                                                                                            data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/muktaresidencial/&amp;source=gmail&amp;ust=1642131810359000&amp;usg=AOvVaw0oOCtnE8wQ6nLXxKyy4ntW"><img
                                                                                                src="https://ci6.googleusercontent.com/proxy/CsU8Viqi3BJDAFLrGZPksmkYgWVO33uPMuUPYTdIjlZGkYPTUoI_vJDzFKjQFwApPgNeOzuP2McTvftBr9y45oU4K7hT_3YVrqR7L-3VwYbeIS13VrCdWig_8JnKG5CZ_mBs7omd-uFCFStjfCVo=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/facebook-icon-2x.png"
                                                                                                alt="facebook" color="#F2B854"
                                                                                                style="max-width:135px;display:block" class="CToWUd"
                                                                                                height="24"></a></td>
                                                                                    <td width="5">
                                                                                        <div></div>
                                                                                    </td>
                                                                                    <td><a href="https://www.linkedin.com/in/grupo-daxi-6983771a0/"
                                                                                            color="#F2B854"
                                                                                            style="color:rgb(17,85,204);display:inline-block;padding:0px;background-color:rgb(242,184,84)"
                                                                                            target="_blank"
                                                                                            data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/in/grupo-daxi-6983771a0/&amp;source=gmail&amp;ust=1642131810359000&amp;usg=AOvVaw3mVFVX_7GRqazuG-uaxHg3"><img
                                                                                                src="https://ci6.googleusercontent.com/proxy/8VnMNxHLCZ0mb5p6kFUeerh69ZxNFn796FO-bPB4zCIy6zKpR1zhFWOLua5F0V0VgIit8AVUmjEgifJrk7e9BwF3wOGdMevsrii7gV2oBOFEo5guBdtnCAwg1eRcW3MR-HHxsstpA8fhJPI5apj8=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/linkedin-icon-2x.png"
                                                                                                alt="linkedin" color="#F2B854"
                                                                                                style="max-width:135px;display:block" class="CToWUd"
                                                                                                height="24"></a></td>
                                                                                    <td width="5">
                                                                                        <div></div>
                                                                                    </td>
                                                                                    <td><a href="https://www.instagram.com/muktaresidencial/"
                                                                                            color="#F2B854"
                                                                                            style="color:rgb(17,85,204);display:inline-block;padding:0px;background-color:rgb(242,184,84)"
                                                                                            target="_blank"
                                                                                            data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/muktaresidencial/&amp;source=gmail&amp;ust=1642131810359000&amp;usg=AOvVaw2dtld3teHFftmkz88Xis0S"><img
                                                                                                src="https://ci4.googleusercontent.com/proxy/N8g6tZ7eglyo7c_6d8oDw66CnB6TXXjsEzJARvc9fD3jikHSnoEtAs2zQjlpsa6zX3aAyD6apMdrUeWhCbbT_8rbyW-AqHOjfQQWIa_UrT_KpQ4kKh1zjDP5nh-osDYyAh4XeiSmeBBT1nFHzi8PtQ=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/instagram-icon-2x.png"
                                                                                                alt="instagram" color="#F2B854"
                                                                                                style="max-width:135px;display:block" class="CToWUd"
                                                                                                height="24"></a></td>
                                                                                    <td width="5">
                                                                                        <div></div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="46">
                                                        <div></div>
                                                    </td>
                                                    <td style="padding:0px;vertical-align:middle">
                                                        <h3 color="#000000" style="font-family:Arial;margin:0px;font-size:18px;color:rgb(0,0,0)">&nbsp;
                                                            &nbsp; &nbsp;'.$user_info->first_name.' '.$user_info->last_name.'</h3>
                                                        <p color="#000000"
                                                            style="font-family:Arial;margin:0px;color:rgb(0,0,0);font-size:14px;line-height:22px">&nbsp;
                                                            &nbsp; &nbsp; &nbsp;<span
                                                                style="font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color:rgb(34,34,34);font-size:medium">--PUESTO--&nbsp;</span></p>
                                                        <p color="#000000"
                                                            style="font-family:Arial;margin:0px;color:rgb(0,0,0);font-size:14px;line-height:22px">&nbsp;
                                                            &nbsp; &nbsp; &nbsp;Grupo Daxi</p>
                                                        <table
                                                            style="color:rgb(255,255,255);font-family:Arial;vertical-align:-webkit-baseline-middle;width:646px"
                                                            cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td color="#f2b854"
                                                                        style="width:30%;border-bottom:1px solid rgb(242,184,84);border-left:none;display:block"
                                                                        height="1"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table style="color:rgb(255,255,255);font-family:Arial;vertical-align:-webkit-baseline-middle"
                                                            cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr style="vertical-align:middle" height="25">
                                                                    <td style="vertical-align:middle" width="30">
                                                                        <table style="vertical-align:-webkit-baseline-middle;font-family:Arial"
                                                                            cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:bottom"><span color="#f2b854" width="11"
                                                                                            style="display:block;background-color:rgb(242,184,84)"><img
                                                                                                src="https://ci6.googleusercontent.com/proxy/Xq3hntJEq2rjJzR0uWCVm3clsSla7NsI7xyRuy0B6esGxKEs0TJKSCBJd0PTJnw80_-gOm3yRwJoGtSWipm4TqjnmSCEllHm6WPq2oze68mmA8DO6Mj2dGBHroByKflVGCBL0c-wyQ3vCF92=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/phone-icon-2x.png"
                                                                                                color="#f2b854" style="display:block" class="CToWUd"
                                                                                                width="13"></span></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding:0px;color:rgb(0,0,0)"><a href="tel:800+942+2740" color="#000000"
                                                                            style="color:rgb(0,0,0);font-size:12px" target="_blank">800 942
                                                                            2740&nbsp;</a>
                                                                        <font size="2">| 9981200180</font>
                                                                    </td>
                                                                </tr>
                                                                <tr style="vertical-align:middle" height="25">
                                                                    <td style="vertical-align:middle" width="30">
                                                                        <table style="vertical-align:-webkit-baseline-middle;font-family:Arial"
                                                                            cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:bottom"><span color="#f2b854" width="11"
                                                                                            style="display:block;background-color:rgb(242,184,84)"><img
                                                                                                src="https://ci5.googleusercontent.com/proxy/u9Dqq8IRTYcA9pxGhij8X1100IBTEBNk6GfgLex2wy5mIUGt4EvtpI__1csTElV-MUMrqJCa2SjWZkRDmYNbTv260GIk6RQb8BWD6Fub4s38olgLolJ-Y0ZMzSkDaCxhCmOgByGso4GxlMz7=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/email-icon-2x.png"
                                                                                                color="#f2b854" style="display:block" class="CToWUd"
                                                                                                width="13"></span></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding:0px"><a href="mailto:'.$user_info->email.'" color="#000000"
                                                                            style="color:rgb(0,0,0);font-size:12px"
                                                                            target="_blank">'.$user_info->email.'</a></td>
                                                                </tr>
                                                                <tr style="vertical-align:middle" height="25">
                                                                    <td style="vertical-align:middle" width="30">
                                                                        <table style="vertical-align:-webkit-baseline-middle;font-family:Arial"
                                                                            cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:bottom"><span color="#f2b854" width="11"
                                                                                            style="display:block;background-color:rgb(242,184,84)"><img
                                                                                                src="https://ci5.googleusercontent.com/proxy/bDGbdhNSZAZaKWHjXdHMW3DL3PklwLU9F5lSquHVukVuOVNDm_0LSPw8ckOtJwduaqdVOyJnATN5reUqPaX3QjUNCZkwbG2Ac8UdOzrywgI_nREPLk66UFxOhX3uiKMJOqLfWEBJyXQ51Tk=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/link-icon-2x.png"
                                                                                                color="#f2b854" style="display:block" class="CToWUd"
                                                                                                width="13"></span></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding:0px"><a href="https://www.mukta.com.mx/" color="#000000"
                                                                            style="color:rgb(0,0,0);font-size:12px" target="_blank"
                                                                            data-saferedirecturl="https://www.google.com/url?q=https://www.mukta.com.mx/&amp;source=gmail&amp;ust=1642131810359000&amp;usg=AOvVaw0EW7IcDcf0KuLqwJnS-FgT">www.mukta.com.mx</a>
                                                                    </td>
                                                                </tr>
                                                                <tr style="vertical-align:middle" height="25">
                                                                    <td style="vertical-align:middle" width="30">
                                                                        <table style="vertical-align:-webkit-baseline-middle;font-family:Arial"
                                                                            cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:bottom"><span color="#f2b854" width="11"
                                                                                            style="display:block;background-color:rgb(242,184,84)"><img
                                                                                                src="https://ci5.googleusercontent.com/proxy/PMsX6QYblfid2-Aq_atF0w8D-5O2KEMGfclrImAJEOsQqE_sbKhMfAd7gH3akRnGu3ErEwVfaOuRfuDxpUBCSL-LKhPfwPnP1FnJHgaOjcrmV2CgMlczkQKYJb-bo0qnAEo7PcQNq51IElkIZFk=s0-d-e1-ft#https://cdn2.hubspot.net/hubfs/53/tools/email-signature-generator/icons/address-icon-2x.png"
                                                                                                color="#f2b854" style="display:block" class="CToWUd"
                                                                                                width="13"></span></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="padding:0px"><span color="#000000"
                                                                            style="font-size:12px;color:rgb(0,0,0)">MX: Blvd. Cumbres Mz. 109 Plaza la
                                                                            Roca Local 18 Smz. 310 Cancún Q.Roo. ,<br>US: 759SW Federal Highway Suite
                                                                            304, Stuart, FL 34994 United States.</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>',
                        "class" => "form-control"
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default cancel-upload" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
            <button id="submit-btn" type="submit" class="btn btn-primary mr15"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>       
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