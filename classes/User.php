<?php
class User extends DB {
    var $user_id;
    var $firstname;
    var $lastname;
    var $username;

    public function __construct($username="") {
        if($username != '') {
            $DB = new DB();
            $conn = $DB->getConnection();

            $stmt = $conn->prepare('SELECT u.user_id, u.username, u.firstname, u.lastname
                                FROM users u
                                WHERE u.username = ?
                                ');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($this->user_id, $this->username, $this->firstname, $this->lastname);
            $stmt->fetch();
        }
    }
    
    

    public function generateSalt() {
        return md5(time());
    }
    
    public function registerNewSession($user_id, $session_id) {
        $DB = new DB();
        $conn = $DB->getConnection();
        $stmt = $conn->prepare('INSERT INTO ilance_sessions (sesskey, userid) VALUES (?,?)');
        $stmt->bind_param('ss',$session_id, $user_id);
        $stmt->execute();
    }

    
    public function registerNewUser($username, $password, $firstname, $lastname) {
        $DB = new DB();
        $conn = $DB->getConnection();
        
        $salt = $this->generateSalt();
        
        $salt_password = md5(md5($password).$salt);

        $stmt = $conn->prepare('INSERT INTO users (username, password, firstname, lastname, row_salt)
                        VALUES (?,?,?,?,?)');
        $stmt->bind_param('sssss', $this->username, $salt_password, $this->firstname, $this->lastname, $salt);
        $stmt->execute();
        $this->user_id = $stmt->insert_id;
        if (!$stmt->error) {
            return $this->user_id;
        }
        else {
            return 0;
        }
        
        $stmt->close();

    }

    public function checkCredentials ($username, $password) {
        $DB = new DB();
        $conn = $DB->getConnection();
        
        $stmt = $conn->prepare('SELECT user_id, password, row_salt FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($this->user_id, $salt_password, $salt);
        $stmt->fetch();
        if($salt_password == md5(md5($password).$salt)) {
            return $this->user_id;
        }
        else {
            return 0;
        }

    }
}
?>
