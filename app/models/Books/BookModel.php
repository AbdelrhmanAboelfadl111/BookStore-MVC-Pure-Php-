<?php
require_once __DIR__ . "/../../../core/DataBase.php";
require_once __DIR__ . "/../Model.php";

class BookModel extends Model
{
    public static function getDataOfBooks(array $wheres = [], string $sort = "DESC",int $page = 1): array
    {
        $DB = Database::getConnection();
        $whereQuery = Model::prepareWhereQuery($wheres);
        // $whereBetQuery = Model::prepareWhereQuery($between);
        $offset = ($page * 10) - 10;

        $stmt = $DB->query("SELECT books.*,authors.name AS author_name FROM books LEFT JOIN authors ON authors.id = books.author_id {$whereQuery} ORDER BY books.id {$sort} LIMIT 10 OFFSET {$offset} ;");
        
        $data = $stmt->fetchAll();

        $stmt = $DB->query("SELECT COUNT(*) AS total FROM books LEFT JOIN authors ON authors.id = books.author_id {$whereQuery};");
        $total = $stmt->fetch()['total'];
        return [
            'data' => $data,
            'total' => $total,
            'current_page' => $page
        ];
    }

    public static function filterBooks(){
        $DB = Database::getConnection();

    }

    public static function addBook(){
        $DB = Database::getConnection();
        $stmt = $DB->prepare("INSERT INTO books (author_id ,title, image, description, price, stock) VALUES (:author_id , :title, :image, :description, :price, :stock)");
        $stmt ->execute([
            "author_id" => Request::DataSpecific('AuthorId'),
            "title" => Request::DataSpecific('BookTitle'),
            "image" => self::uploadImg('BookImage'),
            "description" => Request::DataSpecific('BookDes'),
            "price" => Request::DataSpecific('BookPrice'),
            "stock" => Request::DataSpecific('BookStock')
        ]);
        $newBook = $DB->lastInsertId();

        $newBook = self::getDataOfBooks([['books.id', '=', $newBook]])['data'][0];

        return  $newBook;

        
    }

    public static function uploadImg(string $fileName): ?string
    {
        if (Request::hasFile($fileName)) {

            $file = Request::file($fileName);

            $originalName = $file['name'];
            $fileTemp = $file['tmp_name'];

            $allowedExt = ['png', 'jpg', 'jpeg'];

            $fileOriginalName = pathinfo(
                $originalName,
                PATHINFO_FILENAME
            );

            $fileOriginalEx = strtolower(
                pathinfo($originalName, PATHINFO_EXTENSION)
            );

            if (!in_array($fileOriginalEx, $allowedExt)) {
                Response::error("This file type is not allowed", 403);
            }

            $fileNewName =
                $fileOriginalName . "_" . time() . "." . $fileOriginalEx;

            $uploadDir = __DIR__ . "/../../../public/assets/imgs/uploads";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadPath = $uploadDir . "/" . $fileNewName;

            if (!move_uploaded_file($fileTemp, $uploadPath)) {
                Response::error("Error Uploading", 403);
            }

            return $fileNewName;
        }

        return "book.png";
    }
}
