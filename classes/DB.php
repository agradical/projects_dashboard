<?php

class DB {
	var $user;
	var $password;
	var $server;
	var $db;

    public function DB($connection = array()) {
        $defaults = array(
                        'user' => 'root',
                        'password' => 'qwerty',
                        'server' => 'localhost',
                        'database' => 'projects'
                    );
        $connection = array_merge($defaults, $connection);

        $this->user = $connection['user'];
        $this->password = $connection['password'];
        $this->server = $connection['server'];
        $this->db = $connection['database'];
    }

	public function getConnection() {
		return  new mysqli($this->server,
                    $this->user,
                    $this->password,
                    $this->db
                    );
	}
}

?>
