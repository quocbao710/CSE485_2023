<?php
require_once __DIR__ . '../../services/ArticleService.php';
require_once __DIR__ . '../../services/CategoryService.php';
require_once __DIR__ . '../../services/AuthorService.php';

class ArticleController
{
    private ArticleService $articleService;
    private CategoryService $categoryService;
    private AuthorService $authorService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
        $this->categoryService = new CategoryService();
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
            $articles = $this->articleService->getAllArticles();
            $this->render('article/article', ['articles' => $articles]);
        } catch (Exception $e) {
            echo "Error fetching articles: " . $e->getMessage();
        }
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $authors = $this->authorService->getAllAuthors();
        $this->render('article/add_article', ['categories' => $categories, 'authors' => $authors]);
    }

    public function store()
    {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $songName = filter_input(INPUT_POST, 'songName', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $authorId = filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);
        $imgUrl = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);

        $message = '';

        if (!$title || !$songName || !$categoryId || !$summary || !$authorId) {
            $message = "Vui lòng nhập đầy đủ thông tin.";
            $this->render('article/add_article', ['message' => $message]);
            return;
        }

        try {
            $this->articleService->createArticle($title, $songName, $categoryId, $summary, $content, $authorId, $imgUrl);
            $message = "Thêm bài viết thành công.";
            $this->render('article/add_article', ['message' => $message]);
            // $this->redirect('index.php?controller=Article&action=index');
        } catch (Exception $e) {
            echo "Error creating article: " . $e->getMessage();
        }
    }

    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $categories = $this->categoryService->getAllCategories();
        $authors = $this->authorService->getAllAuthors();

        if (!$id) {
            echo "Invalid article ID.";
            return;
        }

        try {
            $article = $this->articleService->getArticleById($id);
            $this->render(
                'article/edit_article',
                ['article' => $article, 'categories' => $categories, 'authors' => $authors]
            );
        } catch (Exception $e) {
            echo "Error fetching article: " . $e->getMessage();
        }
    }

    public function update()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $songName = filter_input(INPUT_POST, 'songName', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
        $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $authorId = filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);

        $message = '';

        if (!$id || !$title || !$songName || !$categoryId || !$summary || !$authorId) {
            $message = "Vui lòng nhập đầy đủ thông tin.";
            $this->render('article/edit_article', ['message' => $message]);
            return;
        }

        try {
            $this->articleService->updateArticle($id, $title, $songName, $categoryId, $summary, $content, $authorId);
            $this->redirect('index.php?controller=Article&action=index');
        } catch (Exception $e) {
            echo "Error updating article: " . $e->getMessage();
        }
    }

    public function delete()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            echo "Invalid article ID.";
            return;
        }

        try {
            $this->articleService->deleteArticle($id);
            $this->redirect('index.php?controller=Article&action=index');
        } catch (Exception $e) {
            echo "Error deleting article: " . $e->getMessage();
        }
    }
}
