<?php defined('SYSPATH') or die('No direct script access.');

class Mycontroller extends Controller_Template {

    public $template = 'mainview';

    public function before(){
        parent::before();
        View::set_global('title', 'Olgabro портфолио');
        View::set_global('description', 'Olgabro портфолио');
        View::set_global('keywords', 'Olgabro, портфолио');
        View::set_global('email', 'tsemishon@gmail.com');
        View::set_global('phone', '+38 (099) 45 987 43');
        View::bind_global('data', $data);
        $this->template->content = '';
        $this->template->styles = array('main');;
        $this->template->scripts = '';

    }


} // End
