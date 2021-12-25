<?php

namespace app\models;

class Chat extends AppModel {

    public $attributes = [
        'comment' => '',
        'user_id' => '',
        'dead_time' => '',
        'user_login' => '',
        'user_role' => '',
        'to_whom' => '',
        'private' => '0',
        'user_img' => '',
    ];

    public function getFile(){
        if(!empty($_SESSION['file'])){
            $this->attributes['original_name'] = $_SESSION['original_name'];
            $this->attributes['file_name'] = $_SESSION['file'];
            unset($_SESSION['file']);
            unset($_SESSION['original_name']);
        }
    }

    public static function uploadFile($name){
        $uploaddir = WWW . '/uploaded_files/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("text/plain", "image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png", "image/bmp", "application/pdf", "application/x-zip-compressed", "application/msword", "application/vnd.ms-excel", "audio/mp3", "video/mp4", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 94371840){
            $res = 'Помилка! Максимальний розмір файла - 90 Мб!';
            exit($res);
        }
        if($_FILES[$name]['error']){
            $res = 'Помилка! Можливо файл занадто великий.';
            exit($res);
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = 'Дозволяються наступні типи файлів - .txt, .jpg, .png, .jpeg, .gif, .bmp, .zip, .pdf, .doc, .docs, .xls, .xlsx, .mp3, .mp4"';
            exit($res);
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'file'){
                $_SESSION['file'] = $new_name;
                $_SESSION['original_name'] = $_FILES[$name]['name'];
            }
            $res = 'Ваш файл успішно завантажений, оберіть адресата та натисніть "Надіслати" або "Приватне"';
            exit($res);
        }
    }

}