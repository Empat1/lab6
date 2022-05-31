<?php

namespace App\Pdo;

use PDO;

class ScreenshotPdo extends DB
{

    public function getScreenshots($id)
    {
        if ($id == 1) {
            $sql = "SELECT * FROM screenshot WHERE id >= ? ORDER BY id DESC LIMIT 10";
        } else {
            $sql = "SELECT * FROM screenshot WHERE id < ? ORDER BY id DESC LIMIT 10";
        }

        $screenshots = $this->pdo->prepare($sql);
        $screenshots->bindValue(1, $id, PDO::PARAM_INT);
        $screenshots->execute();
        $result = $screenshots->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getScreenshotByUuid($uuid)
    {
        $sql = "SELECT name, url, date_added, uuid FROM screenshot WHERE uuid = ?";

        $screenshot = $this->pdo->prepare($sql);
        $screenshot->bindValue(1, $uuid);
        $screenshot->execute();
        $result = $screenshot->fetch();

        return $result;
    }

    public function saveScreenshot($url, $userId, $name)
    {
        $uuid = uniqid();
        $added_url = htmlspecialchars($url);
        $added_name = htmlspecialchars($name);

        $sql = <<< END
            INSERT INTO screenshot(date_added, uuid, url, user_id, name)
            VALUES(NOW(), :uuid, :url, :user_id, :name);
        END;
        $screenshot = $this->pdo->prepare($sql);
        $screenshot->bindParam(":uuid", $uuid);
        $screenshot->bindParam(":url", $added_url);
        $screenshot->bindParam(":user_id", $userId);
        $screenshot->bindParam(":name", $added_name);
        $screenshot->execute();

        return $uuid;
    }
}