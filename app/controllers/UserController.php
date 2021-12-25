<?php

namespace app\controllers;

use app\models\User;
use rrt\App;

class UserController extends AppController {

    public function signupAction(){
        if(!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $lenth_login = $data['login'];
            $lenth_login = strlen($lenth_login);
            if ($lenth_login > 13){
                $_SESSION['error'] = 'login повинен містити не більше 13 символів!';
                redirect();
            }
            $user->load($data);
            if(!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if($user->save('user')){
                    $_SESSION['success'] = 'Ви успішно зареєстровані';
                    $user_email = ($data['email']);
                    User::sentMail($user_email);
                    redirect(PATH);
                }else{
                    $_SESSION['error'] = 'Помилка';
                }
            }

        }

        $this->setMeta('Реєстрація');
    }

    public function loginAction(){

        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                redirect('/chat/index');
            }else{
                $_SESSION['error'] = 'Логін/пароль введені невірно';
            }
            redirect();
        }
        $this->setMeta('Чат друзів', 'Чат друзей', 'Чат друзей');
    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect(PATH);
    }

    public function cabinetAction(){
        if(!User::checkAuth()) redirect(PATH);
        $id = $_GET['id'];
        $user_cabinet = \R::findOne('user',"id IN ($id)");
        if(!$user_cabinet){
            throw new \Exception('Такого користувача не існує', 404);
        }
        $this->setMeta('Особистий кабінет');
        $this->set(compact('user_cabinet'));
    }

    public function editAction(){
        if(!User::checkAuth()) redirect(PATH);
        if(!empty($_POST)){
            $user = new \app\models\admin\User();
            $data = $_POST;
            $data['id'] = $_SESSION['user']['id'];
            $data['role'] = $_SESSION['user']['role'];
            $data['login'] = $_SESSION['user']['login'];
            $user->getImg();
            $user->load($data);
            if(!$user->attributes['password']){
                unset($user->attributes['password']);
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if(!$user->validate($data) || !$user->checkUnique('id')){
                $user->getErrors();
                redirect();
            }
            if($user->update('user', $_SESSION['user']['id'])){
                foreach($user->attributes as $k => $v){
                    if($k != 'password') $_SESSION['user'][$k] = $v;
                }
                $_SESSION['success'] = 'Зміни збережені';
            }
            redirect();
        }

        $this->setMeta('Зміна особистих даних');
    }

    public function addImageAction(){
        if(isset($_GET['upload'])){
            $wmax = App::$app->getProperty('img_user_width');
            $hmax = App::$app->getProperty('img_user_height');
            $name = $_POST['name'];
            $user = new User();
            $user->uploadImg($name, $wmax, $hmax);
            $user->getImg();
        }
    }

}