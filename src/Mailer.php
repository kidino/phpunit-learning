<?php 

class Mailer {

    function sendMessage($email, $message) {

        if (empty($email)) {
            throw new Exception("Email is empty");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }

        sleep(3);
        echo "Send to $email with $message";
        return true;
    }
}