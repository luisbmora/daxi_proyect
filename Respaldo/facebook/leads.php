<?php

function conectarse(){

  $servername = "localhost";
  $database = "grupodax_crm";
  $username = "root";
  $password = "";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $database);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  return $conn;
}

function checkmail($email){

  $conn=conectarse();
  $query=mysqli_query($conn, "select * from _users where user_type='lead' and email='".$email."'");
  return  mysqli_num_rows($query);

}


include("class.phpmailer.php");
include("class.smtp.php");

require __DIR__ . '/vendor/autoload.php';

use FacebookAds\Object\Ad;
use FacebookAds\Object\Lead;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;



$access_token = 'EAAF3AyBN1JQBAHzmy0uKzj9Ct5nilyB81ewWZC5iDOLCZAXRlgt4Nnsre3jWJgOyO75LYyZBLFKCrR3quoe4RuR3FtfwEuOaFxD10m39zCv1enyCsh4ezAThEceZB8qDv5y35EvTdQLIQnY7gjkSwF88pvSu3ODBbXTS42h7i3G5WwNiHhlvWotIzcqNQegZD';
$app_secret = '0b6363be21ec421b013a35e295ec84e3';
$app_id = '412330287289492';
$id = '221305926555267';


$api = Api::init($app_id, $app_secret, $access_token);
$api->setLogger(new CurlLogger());

$fields = array(
);
$params = array(
);
echo json_encode((new Ad($id))->getLeads(
  $fields,
  $params
)->getResponse()->getContent(), JSON_PRETTY_PRINT);



$conn=conectarse();
$company_name = htmlspecialchars($_POST["Nombre"]);
$lastName=htmlspecialchars($_POST["Apellido"]);

$company_name=$company_name." ".$lastName;

$name=htmlspecialchars($_POST["Nombre"]);
$email = htmlspecialchars($_POST["Email"]);
$phone = htmlspecialchars($_POST["Telefono"]);
$city = '';
$address='';


$notes='';

$last=mysqli_query($conn, "SELECT
_assing_status.id_user,
_assing_status.assing,
_assing_status.count,
concat(_users.first_name,'',
_users.last_name) as nameComplete,
_users.email
FROM
_assing_status
INNER JOIN _users ON _assing_status.id_user = _users.id
ORDER BY
_assing_status.count ASC
LIMIT 0, 1
");
while($row=mysqli_fetch_array($last)){
    $id_User=$row[0];
    $nameComplate=$row['nameComplete'];
    $emailUser=$row['email'];
    mysqli_query($conn, "update _assing_status set count =count+1 where id_user=".$id_User);

}


if(checkmail($email) == 1){
  echo "Ya existe";
  exit();
}


mysqli_query($conn, "insert into _clients (company_name,address, city,created_date,website, phone,starred_by,group_ids,is_lead,lead_status_id,owner_id,created_by,lead_source_id,last_lead_status,client_migration_date) values ('".$company_name."', '".$address."', '".$city."' , NOW(), '".$email."', '".$phone."', '', '',1,1,".$id_User.",".$id_User.",6,1,NOW())");
$ClientID = mysqli_insert_id($conn);

mysqli_query($conn, "INSERT INTO `_users` VALUES (null, '".$name."', '".$lastName."', 'lead', 0, 0, '".$email."', NULL, NULL, 'active', NULL, ".$ClientID.", NULL, 1, 'Sin definir', 0, NULL, NULL, NULL, '".$phone."', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 0)");

     
     




$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com';					
	$mail->SMTPAuth = true;							
  $mail->Username   = 'crm.grupodaxi@gmail.com' ;// SMTP account username  			
	$mail->Password   = 'r.(A6y_95lzL';  				
	$mail->SMTPSecure = 'ssl';							
	$mail->Port	 = 465;
  $mail->SetFrom('crm.grupodaxi@gmail.com', 'CRM Grupo Daxi');
  $mail->AddAddress("alejandro.huitron@yocontigo-it.com", "PERSONAL ADMINISTRATIVO");
	
	$mail->isHTML(true);								
	$mail->Subject = 'Lead nuevo por facebook';
	$mail->Body = '<div style="background-color: #eeeeef; padding: 50px 0; ">
  <div style="max-width:640px; margin:0 auto; ">
      <div style="color: #fff; text-align: center; background-color:#33333e; padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;">
          <h1>Lead nuevo</h1>
      </div>
      <div style="padding: 20px; background-color: rgb(255, 255, 255);">
          <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">Hola,'.$nameComplate.'</span><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><span style="font-weight: bold;"><br></span></span></p>
          <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><span style="font-weight: bold;">Se ha puesto en contacto un lead nuevo mediante facebook se ha puesto en contacto con GrupoDaxi.</span></p>
          <br>
          <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">
          Nombre: '.$company_name.'<br>
          Télefono: '.$phone.'<br>
          Email: '.$email.'<br>
          Formulario: EK BALAM SEP 2021
          <br></span></p>
          
          <p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;"><br></span></p><br></div>
  </div>
</div>';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}





?>

