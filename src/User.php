<?php 
class User {

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    protected $mailer;
    protected $db;

    function setMailer(Mailer $mailer) {
        $this->mailer = $mailer;
    }

    function setDB($db) {
        $this->db = $db;
    }

    function __construct($firstname = '', $lastname = '') {

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }    

    function greet() {
        echo "<html><body>";
        echo "<h1>Hello there, {$this->getFullname()}</h1>";
        echo "<h3>The time now is <span id='time'></span></h3>";
    }

    function getFullname() {
        return trim("{$this->firstname} {$this->lastname}");
    }

    function notify(){
        // $mailer = new Mailer;
        return $this->mailer->sendMessage($this->email, 'Sila beri perhatian');
    }

    function save() {
        $sql = "insert into users (firstname, lastname, email) values (
        '{$this->firstname}',
        '{$this->lastname}',
        '{$this->email}'
        )";
        $this->db->query($sql);
        return true;
    }

    function get($id) {
        $sql = "select * from users where id = $id";
        $result = $this->db->query($sql);
        
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->email = $row['email'];  
            $this->id = $id;
        } else {
            throw new Exception('User not found');
        }

        return true;

    }




}