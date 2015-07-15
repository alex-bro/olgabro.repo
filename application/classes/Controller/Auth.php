<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Mycontroller {

    public function action_index(){
        $data =array();

        $post = $this->request->post();
        if(count($post)>0){
            $login = HTML::chars($post['login']);
            $pass = HTML::chars($post['password']);
            if (Auth::instance()->login($login, $pass)){
                // Авторизация прошла успешно

                HTTP::redirect('Admin');
            }
            else {
                // Ошибка при авторизации
                HTTP::redirect('Auth');
            }
        }

        $content = View::factory('authview');
        $content->bind('data',$data);
        $this->template->content =$content;
    }

    public  function action_logout(){
        Auth::instance()->logout(TRUE);
        HTTP::redirect();
    }
} // End
