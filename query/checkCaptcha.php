<?php
require_once('recaptchalib.php');
$privatekey = "6LcTjfYSAAAAAKjl5F1fL7EoYAKfvMO6gwfXYU_j";
$resp = null;
if (isset($_POST["recaptcha_response_field"])) {
		
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
                echo "1";
        } else {
			if ($_POST["recaptcha_response_field"]==NULL) 
				echo "1";
			else
                echo "0";
        }
}
?>

