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

        $hashedPassword = $row->Password;

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

    public function getRole() {
        $this->db->query('SELECT Role FROM User WHERE UserID = :userId');

        //Bind values
        $this->db->bind(':userId', $_SESSION['user_id']);

        $row = $this->db->single();

        $role = $row->role;

        return $role;
    }
}
