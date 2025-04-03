<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../vendor/phpmailer/PHPMailer.php';
  require '../vendor/phpmailer/SMTP.php';
  require '../vendor/phpmailer/Exception.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
      // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com'; // Hostinger SMTP Server
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@dynobuilders.com'; // Your email
        $mail->Password = 'Admin@6599#'; // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
        $mail->Port = 587; // 465 for SSL, 587 for TLS

        // Email Headers
        $mail->setFrom('noreply@dynobuilders.com', 'DYNO Builders'); // Sender
        $mail->addAddress('Dynobuilders1@gmail.com'); // Recipient
        //$mail->addAddress('parthgrover1994@gmail.com'); // Recipient
        $mail->addReplyTo($email, $name); // User's email

        // Email Content
        $mail->Subject = "New Contact Form Submission from " . $name;
        $mail->Body = "Name: $name\nEmail: $email\Phone: $phone\nMessage:\n$message";

        // Send email
        if ($mail->send()) {
           // echo "success";
            $response = ["status" => "success", "message" => "Email sent successfully!"];
        } else {
            //echo "Email not sent.";
            $response = ["status" => "error", "message" => "Email not sent."];
        }
    } catch (Exception $e) {
       // echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        $response = ["status" => "error", "message" => "Mailer Error: {$mail->ErrorInfo}"];
    }

  }

  echo json_encode($response);
  exit;

  // $receiving_email_address = 'contact@example.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = 'Request for a quote';

  // // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // /*
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  // */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['phone'], 'Phone');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();
?>
