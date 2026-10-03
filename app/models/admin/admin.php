<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/DataBase.php";

class adminModel extends Model
{
    public static function canManageUser(int $userId): bool
    {
        $DB = Database::getConnection();
        $currentUserId = auth('id');

        $stmt = $DB->prepare(
            "SELECT role FROM users WHERE id = :userId LIMIT 1"
        );
        $stmt->execute(['userId' => $userId]);
        $targetRole = $stmt->fetchColumn();

        if ($targetRole !== 'admin') {
            return true;
        }

        $stmt = $DB->query(
            "SELECT id FROM users WHERE role = 'admin' ORDER BY id ASC LIMIT 1"
        );
        $firstAdminId = (int) $stmt->fetchColumn();

        return $currentUserId == $firstAdminId;
    }

    public static function banUser()
    {
        $DB = Database::getConnection();

        $userId = Request::DataSpecific('userId');

        if (!self::canManageUser((int) $userId)) {
            Response::json_response([
                'message' => 'You do not have permission to ban or unban another admin.'
            ], 'Forbidden', 403);
        }

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
