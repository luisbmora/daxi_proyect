<?php
//Faccebook Mukta
function conectarse(){

    $servername = "localhost";
    $database = "grupodax_crm";
    $username = "grupodax_user";
    $password = "MDLFIuFo0iJ45n9y";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
 }
 
 
 
$conn=conectarse();

$data = json_decode(file_get_contents('php://input'), true);

//var_dump($_REQUEST);

$id='';
$company_name="";
$Owner="";
$emailUser='';
$id_User='';


$id=htmlspecialchars($_REQUEST['Id']);
$company_name = htmlspecialchars($_REQUEST['Name']);
$Owner = htmlspecialchars($_REQUEST['Owner']);



$notes='';

$last=mysqli_query($conn, "SELECT
_assing_status.id_user,
_assing_status.assing,
_assing_status.count,
_users.email
FROM
_assing_status
INNER JOIN _users ON _assing_status.id_user = _users.id
ORDER BY
_assing_status.count ASC
LIMIT 0, 1");
while($row=mysqli_fetch_array($last)){
    $id_User=$row[0];
    $emailUser=$row[3];
}

$correo=mysqli_query($conn,"SELECT _users.email FROM _clients INNER JOIN _users ON _clients.owner_id = _users.id WHERE _clients.id =".$id);

while($rows=mysqli_fetch_array($correo)){
    $emailOwner_Nw=$rows[0];
    
}




mysqli_query($conn, "INSERT INTO `_notifications` VALUES (null,".$Owner.", 'Lead-".$Owner."', '".date('Y-m-d h:i:s')."', '".$Owner."', ' ', 'lead_reasiggned', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ".$id.", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)");


 // Impotar algunas clases de phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Cargar phpmailer via composer
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
try {
    //Si el correo no te llega, quita el comentario
    //de la linea de abajo, para mas información
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
    $mail->isSMTP();
    $mail->Host       = 'mail.grupodaxi.site';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'crm@grupodaxi.site';
    $mail->Password   = 'r.(A6y_95lzL';
    $mail->SMTPSecure = 'tls';
    //$mail->SMTPDebug = 1; 
    $mail->Port       = 587;
    
    //Destinatarios
    $mail->setFrom('crm@grupodaxi.site', 'CRM Grupo Daxi');
    $mail->AddAddress($emailOwner_Nw);
   // $mail->AddAddress('alejandro.huitron@yocontigo-it.com');
    
     
    
    // Contenido
    $mail->isHTML(true);                          
    $mail->Subject = 'Reasignacion de leads CRM';

    $mail->Body = '<div style="background-color: #eeeeef;padding: 50px 0; background-image: url(http://grupodaxi.com/crm/files/system/system_file616467badd94e-proyectos-inmobiliarios.jpeg);">
    <div style="max-width:640px; margin:0 auto; ">
        <div style="color: #fff; text-align: center; background-color:#101011; padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;">
            <h1>Reasignación de Lead</h1>
        </div>
        <div style="padding: 20px; background-color: rgb(255, 255, 255);">
            <p align="center"><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">Se te ha reasignado el lead con el nombre de ,'.$company_name.'</span><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><span style="font-weight: bold;"> se te ha asignado un lead nuevo&nbsp; <br></span></span></p><br><p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><br></span></p>
            <center>
                <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><a style="background-color: #00b393; padding: 10px 15px; color: #ffffff; text-decoration:none;" href="https://www.grupodaxi.site/index.php/leads/view/'.$Id.'" target="_blank">Ver
                            Prospecto</a></span></p>
            </center>

            <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><br></span></p><br>
        </div>
    </div>
</div>';



    $mail->AltBody = 'Version en texto plano del correo (No HTML, no formato)';
    $mail->send();
    echo 'El correo fue enviado';
} catch (Exception $e) {
    echo "Ocurrio un error: {$mail->ErrorInfo}";
}




