<?php

$firstname = $name = $email = $phone = $message = "";

$firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
$isSuccess = false;
$emailTo = "bercy.cedric@hotmail.fr";


    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname = verifyInput($_POST["firstname"]);
        $name = verifyInput($_POST["name"]);
        $email = verifyInput($_POST["email"]);
        $phone = verifyInput($_POST["phone"]);
        $message = verifyInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";

        if(empty($firstname))
        {
            $firstnameError = "Je veux connaitre ton prenom !";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Firstname: $firstname\n";
        }
            
        if(empty($name))
        {
            $nameError = "et oui je veux tout savoir. Même ton nom !";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Name: $name\n";
        }
            
       
        if(!isEmail($email))
        {
            $emailError = "Met un vrai email stp !!!";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Email: $email\n";
        }

        if(!isPhone($phone))
        {
            $phoneError = "Que des chiffres et des espaces, concentre toi !";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Phone: $phone\n";
        }

        if(empty($message))
        {
            $messageError = "Tu veux quoi Morray !";
            $isSuccess = false;
        }
        else
        {
            $emailText .= "Message: $message\n";
        }
         
        if($isSuccess)
        {
            $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
            mail($emailTo, "Un message de votre site", $emailText , $headers);
            $firstname = $name = $email = $phone = $message = "";
        }
    

    }
    function isPhone($var)
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }


?>


<!DOCTYPE html> 
<html>
    <head>
        <title>Contactez-moi !</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/script.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="divider"></div>
                <div class="heading">
                    <h2>Contactez-moi</h2>
                </div>    
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstname">Prénom<span class="blue"> *</span></label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                                    <p class="comments"><?php echo $firstnameError; ?></p>
                                </div>

                                <div class="col-md-6">
                                    <label for="name">Nom<span class="blue"> *</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>">
                                    <p class="comments"><?php echo $nameError; ?></p>
                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email<span class="blue"> *</span></label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>">
                                    <p class="comments"><?php echo $emailError; ?></p>
                                </div>
 
                                <div class="col-md-6">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre numéro de Téléphone" value="<?php echo $phone; ?>">
                                    <p class="comments"><?php echo $phoneError; ?></p>
                                </div>

                                <div class="col-md-12">
                                    <label for="message">Message<span class="blue"> *</span></label>
                                    <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"><?php echo $message; ?></textarea>
                                    <p class="comments"><?php echo $messageError; ?></p>
                                </div>

                                <div class="col-md-12">
                                   <p class="blue"><strong>* Ces informations sont requises</strong></p>
                                </div>

                                <div class="col-md-12">
                                   <input type="submit" class="button1" value="Envoyer">
                                </div>
                            </div>
                            
                            <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none'; ?>">Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>
                        </form>
                    </div>

                </div>   

        </div>
    </body>


</html>    