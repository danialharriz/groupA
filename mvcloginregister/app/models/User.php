<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    //signup
    public function signup($data) {
        $this->db->query('INSERT INTO user (UserID, Email, Name, Password, Role, ProfilePic) VALUES(:userId, :email, :name, :password, :role, :profilePic)');

        //Bind values
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':profilePic', $data['profilePic']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //login
    public function login($email, $password) {
        $this->db->query('SELECT * FROM user WHERE Email = :email');

        //Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row !== false) {
            $hashedPassword = $row->Password;
        } else {
            // Handle the case when $row is false
            return false;
        }

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //get the greatest user id, if no user, return false
    public function getLastUserId() {
        $this->db->query('SELECT MAX(UserID) AS maxUserId FROM user');

        $row = $this->db->single();

        if ($row) {
            return $row->maxUserId;
        } else {
            return false;
        }
    }
    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        // Prepared statement
        $this->db->query('SELECT * FROM user WHERE Email = :email');

        // Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            return $row;
        } else {
            return false;
        }
    }
    public function getUserById($userId) {
        $this->db->query('SELECT * FROM user WHERE UserID = :userId');

        // Email param will be binded with the email variable
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($row) {
            return $row;
        } else {
            return false;
        }
    }
    public function addRole($role) {
        $this->db->query('UPDATE User SET Role = :role WHERE UserID = :userId');

        //Bind values
        $this->db->bind(':userId', $_SESSION['user_id']);
        $this->db->bind(':role', $role);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function setRole($userid, $role) {
        $this->db->query('UPDATE User SET Role = :role WHERE UserID = :userId');

        //Bind values
        $this->db->bind(':userId', $userid);
        $this->db->bind(':role', $role);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }
    //get Role  
    public function getRole() {
        $this->db->query('SELECT Role FROM user WHERE UserID = :userId');

        //Bind values
        $this->db->bind(':userId', $_SESSION['user_id']);

        $row = $this->db->single();

        if ($row) {
            return $row->Role;
        } else {
            return false;
        }
    }
    //update user profile
    public function updateUser($data) {
        $this->db->query('UPDATE user SET Name = :name, Email = :email, Phone = :phone WHERE UserID = :userId');

        //Bind values
        $this->db->bind(':userId', $_SESSION['user_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);



        if ($data['phone'] !== null) {
            $this->db->bind(':phone', $data['phone']);
        } else {
            $this->db->bind(':phone', null, PDO::PARAM_NULL);
        }

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePassword($data) {
        $this->db->query('UPDATE user SET Password = :password WHERE UserID = :userId');

        //hash password
        $password = password_hash($data['new_password'], PASSWORD_DEFAULT);

        //Bind values
        $this->db->bind(':userId', $_SESSION['user_id']);
        $this->db->bind(':password', $password);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateProfilePic($data){
        $this->db->query('UPDATE user SET ProfilePic = :profilePic WHERE UserID = :userId');

        //Bind values
        $this->db->bind(':userId', $_SESSION['user_id']);
        $this->db->bind(':profilePic', $data['profilePic']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserCount() {
        $this->db->query('SELECT COUNT(*) AS userCount FROM user');

        $row = $this->db->single();

        if ($row) {
            return $row->userCount;
        } else {
            return false;
        }
    }
}
