
<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/DataBase.php";

class adminModel extends Model
{
    public static function banUser()
    {
        $DB = Database::getConnection();

        $userId = Request::DataSpecific('userId');

        $stmt = $DB->prepare(
            "SELECT is_banned FROM users WHERE id = :userId"
        );

        $stmt->execute([
            'userId' => $userId
        ]);

        $oldBan = $stmt->fetchColumn();

        $newBan = ((int)$oldBan === 1) ? 0 : 1;

        $stmt = $DB->prepare(
            "UPDATE users SET is_banned = :newBan WHERE id = :userId"
        );

        $stmt->execute([
            'newBan' => $newBan,
            'userId' => $userId
        ]);
    }
}
