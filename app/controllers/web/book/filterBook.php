<?php
require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/DB/DBModel.php";
require_once __DIR__ . "/../../../models/orders/orderModel.php";
require_once __DIR__ . "/../../../models/Books/BookModel.php";
class bookFilter extends Controller
{
    private function normalizeFilterValue($value): string
    {
        return trim(preg_replace('/\s+/', ' ', (string) $value));
    }

    public function filterBooks()
    {
        $minPrice = Request::DataSpecific('BookMin', '') == '' ? 0 : Request::DataSpecific('BookMin');
        $maxPrice = Request::DataSpecific('BookMax', '') == '' ? null : Request::DataSpecific('BookMax');
        $wheres = [];

        $title = $this->normalizeFilterValue(Request::DataSpecific('BookTitle', ''));
        $author = $this->normalizeFilterValue(Request::DataSpecific('BookAuthor', ''));
        $stock = $this->normalizeFilterValue(Request::DataSpecific('BookStock', ''));
        $minPrice = $this->normalizeFilterValue(Request::DataSpecific('BookMin', ''));
        $maxPrice = $this->normalizeFilterValue(Request::DataSpecific('BookMax', ''));

        if ($title !== '') {
            $wheres[] = ['books.title', 'LIKE', "%{$title}%"];
        }

        if ($author !== '') {
            $wheres[] = ['authors.name', 'LIKE', "%{$author}%"];
        }

        if ($stock !== '') {
            $wheres[] = ['books.stock', '=', $stock];
        }

        if ($minPrice !== '') {
            $wheres[] = ['books.price', '>=', $minPrice];
        }

        if ($maxPrice !== '') {
            $wheres[] = ['books.price', '<=', $maxPrice];
        }

        $sort = Request::DataSpecific('BookSort', 'DESC');

        $sort = strtoupper($sort) === 'ASC'
            ? 'ASC'
            : 'DESC';

        $page = (int) Request::DataSpecific('CurrentPage', 1);

        $books = BookModel::getDataOfBooks(
            $wheres,
            $sort,
            $page
        );

        Response::json_response($books);
    }

    public function addBook()
    {
        // Response::json_response([Request::hasFile('BookImage')]);
        $errors = Request::validate([
            'AuthorId'  => ['required', ['exists', 'authors', 'id']],
            'BookDes'   => ['required'],
            'BookPrice' => ['required'],
            'BookStock' => ['required'],
            'BookTitle' => ['required']
        ]);
        if (!empty($errors)) {
            Response::json_response($errors, "", 422);
        }
        $newBook =  BookModel::addBook();
        Response::json_response($newBook);
    }
}
