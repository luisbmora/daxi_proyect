<?php
   foreach ($model_info as &$valor) {
    $email= $valor->email;
    $subject=$valor->subject;
    $date=$valor->date;
    $template=$valor->template;
    $fullName=$valor->fullName;
   
}
?>
<div class="card">
    <div class='card-header'>
        <i data-feather="mail" class='icon-16 mr10'></i><?php echo "Correo enviado"; ?>
</div>
    <div class="modal-body clearfix">
        <div class='row'>

        <div class="form-group">
                <div class=" col-md-12">
                <label><strong>Enviado a:</strong></label>
                    <?=$email;?>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                <label><strong>Asunto del correo:</strong></label>
                    <?=$subject;?>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                <label><strong>Hora y fecha:</strong></label>
                    <?=$date;?>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                <label><strong>Usuario:</strong></label>
                    <?=$fullName;?>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                   <?=$template;?>
                </div>
            </div>
        </div>
    </div>
</div>
