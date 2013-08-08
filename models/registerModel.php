<?php
class registerModel {
	private $db;
	public function __construct($dsn, $user, $pass) {
		try {
			$this->db = new \PDO($dsn, $user, $pass);
			$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		catch (\PDOException $e) {
			var_dump($e);
		}
	} // __construct
	
	public function addUser($username, $first_name, $last_name, $email, $password, $salt) {
		$query = $this->db->prepare("
			INSERT INTO members 
			SET username = '$username',
			first_name = '$first_name',
			last_name = '$last_name',
			email = '$email',
			salt = '$salt',
			password = MD5(CONCAT(salt, '$password'))
		");
		try {
			if ($query->execute()) {
				echo "<p class='useradded'>Added an account for <em>$username</em>. (<a href='auth.php'>Log in</a>)<br /><br /></p>";
			}
		}
		catch (\PDOException $e) {
			var_dump($e);
			echo "<p class='useradded'>Unable to add new user to the database.</p>";
		}
	}//addUser
	
	public function getUser($name, $pass) { // start getUser
            $stmt = $this->db->prepare("
                SELECT id, username, password, email, salt, first_name, last_name
                FROM members
                WHERE (username = :name)
                AND (password = MD5(CONCAT(salt, :pass)))
            ");

            if ($stmt->execute(array(':name' => $name, ':pass' => $pass))) {
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (count($rows) === 1) {
                    return $rows[0];
                }
            }

            return false;
        }
}
?>