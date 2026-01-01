<?php
require_once __DIR__ . '/../core/QueryBuilder.php';

class User extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct('users');
    }

    // ======================
    // LOGIN USER
    // ======================
    public function login($email, $password)
    {
        $email = $this->db->real_escape_string($email);

        $result = $this->db->query(
            "SELECT * FROM $this->table WHERE email='$email' LIMIT 1"
        );

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    // ======================
    // CEK EMAIL
    // ======================
    public function emailExists($email)
    {
        $email = $this->db->real_escape_string($email);
        $result = $this->db->query(
            "SELECT id_user FROM $this->table WHERE email='$email'"
        );
        return $result->num_rows > 0;
    }

    // ======================
    // REGISTER USER
    // ======================
    public function register($data)
    {
        if ($this->emailExists($data['email'])) {
            return false;
        }

        $data['password'] = password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        );

        return $this->insert($data);
    }
}
