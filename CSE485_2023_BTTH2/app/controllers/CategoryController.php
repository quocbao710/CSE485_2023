<?php
require_once __DIR__ . '../../services/CategoryService.php';

class CategoryController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
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
            $categories = $this->categoryService->getAllCategories();
            $this->render('category/category', ['categories' => $categories]);
        } catch (Exception $e) {
            echo "Error fetching categories: " . $e->getMessage();
        }
    }

    public function create()
    {
        $this->render('category/add_category');
    }

    public function store()
    {
        $name = filter_input(INPUT_POST, 'txtCatName', FILTER_SANITIZE_STRING);

        if (!$name) {
            echo "Invalid category name.";
            return;
        }

        try {
            $this->categoryService->createCategory($name);
            $this->redirect('index.php?controller=Category&action=index');
        } catch (Exception $e) {
            echo "Error creating category: " . $e->getMessage();
        }
    }

    public function edit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            echo "Invalid category ID.";
            return;
        }

        try {
            $category = $this->categoryService->getCategoryById($id);

            if (!$category) {
                echo "Category not found.";
                return;
            }

            $this->render('category/edit_category', ['category' => $category]);
        } catch (Exception $e) {
            echo "Error fetching category: " . $e->getMessage();
        }
    }

    public function update()
    {
        $id = filter_input(INPUT_POST, 'txtCatId', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'txtCatName', FILTER_SANITIZE_STRING);

        if (!$id || !$name) {
            echo "Invalid input.";
            return;
        }

        try {
            $this->categoryService->updateCategory($id, $name);
            $this->redirect('index.php?controller=Category&action=index');
        } catch (Exception $e) {
            echo "Error updating category: " . $e->getMessage();
        }
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            echo "Invalid category ID.";
            return;
        }

        try {
            $this->categoryService->deleteCategory($id);
            $this->redirect('index.php?controller=Category&action=index');
        } catch (Exception $e) {
            echo "Error deleting category: " . $e->getMessage();
        }
    }
}
