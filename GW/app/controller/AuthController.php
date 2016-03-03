<?php
namespace app\controller;

use app\App;
use app\sql\Auth;
use app\lib\Module;
use app\lib\Session;

class AuthController extends App
{
    private $authService;
    private $module;
    private $session;

    public function __construct()
    {
        $this->authService = Auth::ins();
        $this->module = Module::ins();
        $this->session = Session::ins();
    }

    public function index()
    {
        if ($this->session->has(['vaildError'])) {
            $errMsg = $this->session->get('vaildError');
            return $this->module->view('app/view/login.php', compact('errMsg'));
        }
        return $this->module->view('app/view/login.php');
    }

    /**
     * do login
     */
    public function login()
    {
        $inputData = $_POST;
        if (empty($inputData['mailaddress']) || empty($imput['password'])) {
            return $this->module->redirect('/')->with(['vaildError' => 'ログインに失敗しました。']);
        }

        if ($this->authService->login()){
            return $this->module->redirect('/Bbs/index')->with();
        }
    }
}
