<?php defined('SYSPATH') or die('No direct script access.');

class Myadmincontroller extends Mycontroller {

    public $template = 'mainview';

    public function before(){
        parent::before();
        if(!Auth::instance()->get_user()){HTTP::redirect('Auth');}
    }


} // End Welcome
