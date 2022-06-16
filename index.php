<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['submit'])){

$name=input($_POST['name']);
$subject=input($_POST['subject']);
$body=input($_POST['body']);

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'realcreativeprogrammer@gmail.com';                     //SMTP username
    $mail->Password   = 'FAE5B674A3300AEF90DD5AC8DC63DE8F01B1';                               //SMTP password
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('realcreativeprogrammer@gmail.com', 'programmer');
    $mail->addAddress('realcreativeprogrammer@gmail.com',$name);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = '<p>'.$body.'</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function input($value){
    $newvalue=trim($value);
    $newvalue=htmlspecialchars($newvalue);
    $newvalue=stripslashes($newvalue);
    return $newvalue;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class='container'>
        <form method='post'>
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type='text' name='name' class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Subject:</label>
                <input type='text' name='subject' class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Body:</label>
                <input type='text' name='body' class="form-control">
            </div>

            <input type="submit" value="Send Email" name="submit"  class='btn btn-success'>

        </form>

    </div>
</body>
</html>