<?php
require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class AuthorModel extends Model
{
    public static function addAuthor()
    {
        $DB = Database::getConnection();
        $stmt = $DB->prepare("INSERT INTO authors (name, bio) VALUES (:name, :bio)");
        $stmt->execute(([
            "name" => Request::DataSpecific('authorName'),
            "bio" => Request::DataSpecific('authorBio')
        ]));

        $author_id = $DB->lastInsertId();

        $stmt = $DB->query("SELECT * FROM authors WHERE id = '{$author_id}'");

        $result = $stmt ->fetch();

        return $result;
    }
}
