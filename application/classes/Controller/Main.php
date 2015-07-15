<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Mycontroller {

    public function action_index(){

        $data = Model_Portfolio::getAll();

        $content = View::factory('homeview');
        $content->bind('data',$data);
        $this->template->content =$content;
    }
} // End
