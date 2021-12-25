<?php

namespace app\controllers;

use app\models\Chat;

class ChatController extends AppController {

    public function indexAction(){
        if(empty($_SESSION['user']['id'])){
            redirect(PATH);
        }
     //   $banners = \R::findAll('banners', "WHERE status = '1'");
        $this->setMeta('Чат друзів', 'Чат друзей', 'Чат друзей');
     //   $this->set(Compact('banners'));
    }

    public function mainAction(){

        $this->loadView('main');

    }

    public function loadusersAction(){

        $id = $_SESSION['user']['id'];
        $last_visit_user = \R::getAll( "SELECT last_visit FROM user WHERE id = $id");
        if ($last_visit_user < (time()-60)){
            unset($_SESSION['user']);
            redirect(PATH);
        }
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['last_visit'] = time();
        $user_online = \R::load('user', $id);
        $user_online->ip = $data['ip'];
        $user_online->last_visit = $data['last_visit'];
        $user_online = \R::store($user_online);
        $this->loadView('users');

    }

    public function addAction(){
	
		if(empty($_SESSION['user']['id'])){
            redirect(PATH);
        }

        if(isset($_POST['comment']) && ($_POST['comment'] != '') && $_POST['comment']!=" "){
            $comment = new Chat();
            $data['user_id'] = $_SESSION['user']['id'];
            $data['dead_time'] = time();
            $data['user_login'] = $_SESSION['user']['login'];
            $data['user_role'] = $_SESSION['user']['role'];
            $data['user_img'] = $_SESSION['user']['img'];
            $mess = h($_POST['comment']);
            $comment_to_whom = explode(']', $mess, '2');
            if (!empty($comment_to_whom['1'])){
                $mess = $comment_to_whom['1'];
                $login_to_whom = $comment_to_whom['0'];
                $login_to_whom = str_replace('[', '', $login_to_whom);
                $data['to_whom'] = $login_to_whom;
            };
            if (empty($login_to_whom)){
                $data['to_whom'] = '';
            }
            $mess_link = preg_replace('/(https?|ssh|ftp):\/\/[^\s"]+/', '<a href="$0" target="_blank">$0</a>', $mess);
            $data['comment'] = $mess_link;
            $comment->load($data);
            $comment->getFile();
            $comment->save('comments');
        }
        if($this->isAjax()){
            $this->loadView('main');
        }

    }

    public function privateAction(){
	
		if(empty($_SESSION['user']['id'])){
            redirect(PATH);
        }

        if(isset($_POST['comment']) && ($_POST['comment'] != '') && $_POST['comment']!=" "){
            $comment = new Chat();
            $data['user_id'] = $_SESSION['user']['id'];
            $data['dead_time'] = time();
            $data['user_login'] = $_SESSION['user']['login'];
            $data['user_role'] = $_SESSION['user']['role'];
            $data['user_img'] = $_SESSION['user']['img'];
            $data['private'] = '1';
            $mess = h($_POST['comment']);
            $comment_to_whom = explode(']', $mess, '2');
            if (!empty($comment_to_whom['1'])){
                $mess = $comment_to_whom['1'];
                $login_to_whom = $comment_to_whom['0'];
                $login_to_whom = str_replace('[', '', $login_to_whom);
                $data['to_whom'] = $login_to_whom;
            };
            if (empty($login_to_whom)){
                $data['to_whom'] = '';
                $data['private'] = '0';
            }
            $mess_link = preg_replace('/https?:\/\/[^\s"<>]+/', '<a href="$0" target="_blank">$0</a>', $mess); // это только для https
         //   $mess_link = preg_replace('/(https?|ssh|ftp):\/\/[^\s"]+/', '<a href="$0" target="_blank">$0</a>', $mess); это для https, ssh, ftp.
            $data['comment'] = $mess_link;
            $comment->load($data);
            $comment->getFile();
            $comment->save('comments');
        }
        if($this->isAjax()){
            $this->loadView('main');
        }

    }

    public function fileAction(){
	
		if(empty($_SESSION['user']['id'])){
            redirect(PATH);
        }
        if (isset($_SERVER["CONTENT_LENGTH"]) & ($_SERVER["CONTENT_LENGTH"]) > (104857600)){
            $res = 'Занадто великий файл! Максимальний розмір файла - 90 Мб!';
            exit($res);
        }
        if(isset($_GET['upload'])){
            $name = $_POST['name'];
            $comment = new Chat();
            $comment->uploadFile($name);

        }

    }

}