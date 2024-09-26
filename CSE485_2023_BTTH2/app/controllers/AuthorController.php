<?php
require_once __DIR__ . '../../services/AuthorService.php';
require_once __DIR__ . '../../config/database.php';

class AuthorController
{
    private AuthorService $authorService;

    public function __construct()
    {
        $this->authorService = new AuthorService();
    }

    private function render(string $viewPath, array $data = [])
    {
        extract($data);
        include __DIR__ . "../../views/{$viewPath}.php";
    }

    private function redirect(string $url)
    {
        header("Location: {$url}");
        exit;
    }

    public function index()
    {
        try {
            $authors = $this->authorService->getAllAuthors();
            $this->render('author/author', ['authors' => $authors]);
        } catch (Exception $e) {
            echo "Error fetching authors: " . $e->getMessage();
        }
    }

    public function create()
    {
        $this->render('author/add_author');
    }

    public function store()
    {
        $name = filter_input(INPUT_POST, 'txtAuthorName', FILTER_SANITIZE_STRING);
        $message = '';
        if (!$name) {
            $message = 'Tên tác giả không được để trống';
            return;
        }

        try {
            $this->authorService->createAuthor($name);
            $message = 'Thêm tác giả thành công';
            $this->render('author/add_author', ['message' => $message]);
            // $this->redirect('index.php?controller=Author&action=index');
        } catch (Exception $e) {
            echo "Error creating author: " . $e->getMessage();
        }
    }

    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $message = '';
        if (!$id) {
            $message = 'Không tìm thấy tác giả';
            $this->render('author/edit_author', ['message' => $message]);
            return;
        }

        try {
            $author = $this->authorService->getAuthorById($id);
            $this->render('author/edit_author', ['author' => $author]);
        } catch (Exception $e) {
            echo "Error fetching author: " . $e->getMessage();
        }
    }

    public function update()
    {
        $id = filter_input(INPUT_POST, 'txtAuthorId', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'txtAuthorName', FILTER_SANITIZE_STRING);
        $imgUrl = null;
        $message = '';
        if (!$id || !$name) {
            $message = 'Thông tin không được để trống';
            $this->render('author/edit_author', ['message' => $message]);
            return;
        }

        try {
            $this->authorService->updateAuthor($id, $name, $imgUrl);
            $this->redirect('index.php?controller=Author&action=index');
        } catch (Exception $e) {
            echo "Error updating author: " . $e->getMessage();
        }
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            echo '<script>alert("Không tìm thấy tác giả");</script>';
            return;
        }

        try {
            $this->authorService->deleteAuthor($id);
            $this->redirect('index.php?controller=Author&action=index');
        } catch (Exception $e) {
            echo "Error deleting author: " . $e->getMessage();
        }
    }
}
