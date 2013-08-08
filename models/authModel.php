<?php
    class authModel {
        public $db;

        public function __construct($dsn, $user, $pass) {
            try {
                $this->db = new \PDO($dsn, $user, $pass);
                $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                var_dump($e);
            }
        } // __construct

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

        public function getUsers() {//getUsers
        $statement = $this->db->prepare("
              SELECT id, user_name, user_fullname, street_address, zip_code, user_created, user_bio
              FROM users
              ORDER BY id, user_name
              LIMIT 20
        ");

            try {
                if ($statement->execute()) {
                    $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
                    return $rows;
                }
            } catch (\PDOException $e) {
                echo "Couldn't query the database.";
                var_dump($e);
            }

            return false;
        }

        //addUser
        public function addUser($user_name, $user_fullname, $email, $user_password, $user_salt, $user_created) {
            $query = $this->db->prepare("
                INSERT INTO users
                SET user_name = '$user_name',
                user_fullname = '$user_fullname',
                email = '$email',
                user_salt = '$user_salt',
                user_created = '$user_created',
                user_password = MD5(CONCAT(user_salt, '$user_password'))
            ");

            try {
                if ($query->execute()) {
                    echo "<p class='useradded'>Added an account for <em>$user_fullname</em>. (<a href='login.php'>Log in</a>)<br /><br /></p>";
                }
            } catch (\PDOException $e) {
                var_dump($e);
                echo "<p class='useradded'>Unable to add new user to the database.</p>";
            }
        }

        public function getUserDetails($u_num) {
            $statement = $this->db->prepare("
                SELECT *
                FROM users
                WHERE id = :u
            ");

            try {
                if ($statement->execute(array(":u"=>$u_num))) {
                    $details = $statement->fetchAll(\PDO::FETCH_ASSOC);
                    return $details;
                }
            } catch (\PDOException $e) {
                echo "Couldn't query the database.";
                var_dump($e);
            }

            return array();
        }

        public function NewPassword() { //start to NewPassword
            $chars = "abcdefghijkmnopqrstuvwxyz023456789";
            srand((double)microtime()*1000000);
            $i = 0;
            $pass = '';

            while ($i <= 9) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }

            return $pass;
        }
    }
?>