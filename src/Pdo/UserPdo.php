<?php

namespace App\Pdo;

use PDO;
use PDOException;

class UserPdo extends DB
{

    public function save($user): bool
    {
        try {
            $sql = "INSERT INTO user (login, email, phone, password)
                VALUES (?, ?, ?, ?)";

            $password_hash = password_hash($user['password'], PASSWORD_DEFAULT);

            $query = $this->pdo->prepare($sql);
            $query->bindValue(1, htmlspecialchars($user['login']));
            $query->bindValue(2, htmlspecialchars($user['email']));
            $query->bindValue(3, htmlspecialchars($user['phone']));
            $query->bindValue(4, $password_hash);
            $query->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

        return true;
    }

    public function IsEmailUnique($email): bool
    {
        $sql = "SELECT * FROM user WHERE email = ?";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(1, $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC) === false;
    }

    public function getUserIdByEmail($email)
    {
        $sql = "SELECT id FROM user WHERE email = ?";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(1, $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getUserByLogin($login)
    {
        $sql = "SELECT * FROM user WHERE login = ?";

        $query = $this->pdo->prepare($sql);
        $query->bindValue(1, $login);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserIfPasswordVerify($login, $password)
    {
        $user = $this->getUserByLogin($login);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }
}