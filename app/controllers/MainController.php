<?php

namespace app\controllers;

class MainController extends AppController {

    public function indexAction(){

        $this->setMeta('Чат друзів', 'Чат друзей', 'Чат друзей');
    }

}