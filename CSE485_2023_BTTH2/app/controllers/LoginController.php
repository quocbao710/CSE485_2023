<?php
require_once __DIR__ . '/../services/AuthService.php';
class LoginController
{
    private AuthService $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
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
        require_once __DIR__ . '/../views/login/index.php';
    }
    public function login()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $message = '';
        $user = $this->authService->login($username, $password);
        if ($user) {
            $_SESSION['username'] = $user->getUsername();
            $this->redirect('index.php?controller=Admin&action=index');
        } else {
            $message = 'Sai tên đăng nhập hoặc mật khẩu';
            $this->render('login/index', ['message' => $message]);
        }
    }
    public function logout()
    {
        unset($_SESSION['username']);
        header('Location: ?controller=Home&action=index');
    }
}
