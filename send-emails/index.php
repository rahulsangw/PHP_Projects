<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <div class="py-5 text-center">
        <h2>Mailing Service</h2>
        <p class="lead">Send an Email to anyone..Today!!!</p>
    </div>


    <div class="col-4 contact-form container" id="contact">
        <form action="index.php" method="post">

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sender's Name</label>
                <input type="text" class="form-control" name="sname">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sender's email</label>
                <input type="text" class="form-control" name="semail" required>
            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Recipient's Name</label>
                <input type="text" class="form-control" name="rname">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Recipient's email</label>
                <input type="text" class="form-control" name="remail" required>
            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Subject</label>
                <input type="text" class="form-control" name="subject">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Your Message</label>
                <textarea class="form-control" aria-label="With textarea" type="text" name="message" required></textarea>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit" name="submit">Send</button>
            </div>
        </form>
    </div>

</body>
</html>


<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);//creating object of class PHPMailer


if(isset($_POST['submit'])){
    
    $s_name=$_POST['sname'];
    $s_email=$_POST['semail'];
   
    $r_name=$_POST['rname'];
    $r_email=$_POST['remail'];

    $message=$_POST['message'];
    $subject=$_POST['subject'];


    try {
        //Server settings
       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $s_email;         //SMTP username
        $mail->Password   = 'sjaz cccq odzy uwgn';                               //SMTP password
       // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //sender
        $mail->setFrom($s_email, $s_name);
        $mail->addAddress($s_email, 'Joe User');     //Add a recipient

        //recipient
        $mail->addAddress($r_email);               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}

?>
