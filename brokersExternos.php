<?php
//Mukta
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

$nombreCliente = htmlspecialchars($_POST["Nombre_del_Cliente"]);

$nombreBroker=htmlspecialchars($_POST["Nombre_del_Broker"]);
$apellidoBroker=htmlspecialchars($_POST["Apellido_del_Broker"]);
$telefonoBroker=htmlspecialchars($_POST["Telefono_del_Broker"]);
$emailBroker=htmlspecialchars($_POST["Email_del_Broker"]);



/*$lastName=htmlspecialchars($_POST["Apellido del Broker"]);



$name=htmlspecialchars($_POST["Nombre del cliente"]);
$email = htmlspecialchars($_POST["Email del Broker"]);
$phone = htmlspecialchars($_POST["Teléfono"]);
$city = '';
$address='';


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
    mysqli_query($conn, "update _assing_status set count =count+1 where id_user=".$id_User);

}




mysqli_query($conn, "insert into _clients (company_name,address, city,created_date,website, phone,starred_by,group_ids,is_lead,lead_status_id,owner_id,created_by,lead_source_id,last_lead_status,client_migration_date) values ('".$company_name."', '".$address."', '".$city."' , NOW(), '".$email."', '".$phone."', '', '',1,1,".$id_User.",".$id_User.",6,1,NOW())");
$ClientID = mysqli_insert_id($conn);

mysqli_query($conn, "INSERT INTO `_users` VALUES (null, '".$name."', '".$lastName."', 'lead', 0, 0, '".$email."', NULL, NULL, 'active', NULL, ".$ClientID.", NULL, 1, 'Sin definir', 0, NULL, NULL, NULL, '".$phone."', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 0)");

     $UserID = mysqli_insert_id($conn);


mysqli_query($conn, "INSERT INTO `_notifications` VALUES (null,".$UserID.", 'Lead-".$UserID."', '".date('Y-m-d h:i:s')."', '".$id_User."', ' ', 'lead_created', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ".$ClientID.", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)");


if(htmlspecialchars($_POST["Mensaje"]) != ''){
    mysqli_query($conn, "INSERT INTO `_notes` VALUES (null, 1, NOW(), '".$_POST['Mensaje']."', '', 0, ".$ClientID.", ".$UserID.", '', 'a:0:{}', 0, 0);");
}




  


  
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
     $mail->AddAddress('$emailUser');
     
    
    // Contenido
    $mail->isHTML(true);                          
    $mail->Subject = 'Leads de Brokers Externos';

    $mail->Body = '<div style="background-color: #eeeeef;padding: 50px 0; background-image: url(http://grupodaxi.com/crm/files/system/system_file616467badd94e-proyectos-inmobiliarios.jpeg);">
    <div style="max-width:640px; margin:0 auto; ">
        <div
            style="color: #fff; text-align: center; background-color:#101011; padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;">
            <h1>Lead nuevo</h1>
        </div>
        <div style="padding: 20px; background-color: rgb(255, 255, 255);">
            <p style=""><span
                    style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">Hola,'.$company_name.'</span><span
                    style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><span
                        style="font-weight: bold;"><br></span></span></p>
            <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><span
                        style="font-weight: bold;">Se ha puesto en contacto un lead nuevo mediante Brokers Externos</span></span></p>
            <br>
            <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">
                    Nombre: '.$company_name.'<br>
                    Télefono: '.$phone.'<br>
                    Email: '.$email.'<br>
                    Mensaje: '.$htmlspecialchars($_POST["Mensaje"]).'<br>
                    Formulario: Brokers Externos
                </span></p>
            <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><br></span></p>
            <center>
                <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><a
                            style="background-color: #00b393; padding: 10px 15px; color: #ffffff; text-decoration:none;"
                            href="https://www.grupodaxi.site/index.php/leads/view/'.$ClientID.'" target="_blank">Ver
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

*/
