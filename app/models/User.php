<?php

namespace app\models;

use rrt\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class User extends AppModel {

    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'role' => 'user',
        'img' => 'co.png',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['name'],
            ['email'],
            ['phone'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ],
    ];

    public function getImg(){
        if(!empty($_SESSION['single'])){
            $this->attributes['img'] = $_SESSION['single'];
            unset($_SESSION['single']);
        }
    }

    public function checkUnique(){
        $user = \R::findOne('user', 'login = ? OR email = ? OR phone = ?', [$this->attributes['login'], $this->attributes['email'], $this->attributes['phone']]);
        if($user){
            if($user->login == $this->attributes['login']){
                $this->errors['unique'][] = 'Цей логін вже зайнято';
            }

            if($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'Цей email вже зайнято';
            }
            if($user->phone == $this->attributes['phone']){
                $this->errors['unique'][] = 'Цей номер вже зареєстрований';
            }
            return false;
        }
        return true;
    }

    public function login($isAdmin = false){
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if($login && $password){
            if($isAdmin){
                $user = \R::findOne('user', "login = ? AND role = 'admin'", [$login]);
            }else{
                $user = \R::findOne('user', "login = ?", [$login]);
            }
            if($user){
                if(password_verify($password, $user->password)){
                    foreach($user as $k => $v){
                        if($k != 'password') $_SESSION['user'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public static function checkAuth(){
        return isset($_SESSION['user']);
    }

    public static function isAdmin(){
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }

    public static function sentMail($user_email){
        try{
            // Create the Transport
            $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
                ->setUsername(App::$app->getProperty('smtp_login'))
                ->setPassword(App::$app->getProperty('smtp_password'))
            ;
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message for user
            ob_start();
            require APP . '/views/mail/mail_to_user.php';
            $body = ob_get_clean();

            $message_client = (new Swift_Message("Ви успішно зареєструвались " . App::$app->getProperty('site_name')))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
                ->setTo($user_email)
                ->setBody($body, 'text/html')
            ;

            // Create a message for admin
            ob_start();
            require APP . '/views/mail/mail_to_admin.php';
            $body = ob_get_clean();

            $message_admin = (new Swift_Message("В чаті зареєстрований новий користувач"))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('site_name')])
                ->setTo(App::$app->getProperty('admin_email'))
                ->setBody($body, 'text/html')
            ;

            // Send the message
            $result = $mailer->send($message_client);
            $result = $mailer->send($message_admin);
        } catch (\Exception $e){

        }
    }

    public function uploadImg($name, $wmax, $hmax){
        $uploaddir = WWW . '/images/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 4194304){
            $res = array("error" => "Помилка! Максимальна вага зображення - 4 Mб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Помилка! Можливо, файл занадто великий.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Дозволені розширення - .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'single'){
                $_SESSION['single'] = $new_name;
            }else{
                $_SESSION['multi'][] = $new_name;
            }
            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

    /**
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */
    public static function resize($target, $dest, $wmax, $hmax, $ext){
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = 1; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

        if($ext == "png"){
            imagesavealpha($newImg, true); // сохранение альфа канала
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
            imagefill($newImg, 0, 0, $transPng); // заливка
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }

}