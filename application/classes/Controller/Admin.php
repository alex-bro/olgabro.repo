<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Myadmincontroller {

    public  function action_hpass(){
        $auth = Auth::instance();
        $this->template->content = $auth->hash_password('Frt141076');
    }

    public function action_index(){

        $portfolio = new Model_Portfolio();
        $data =array('menu' => Kohana::$config->load('portfolio')->get('menu'),
                   'portfolio' => $portfolio->getAll(),
        );
        $content = View::factory('adminview');
        $content->bind('data',$data);
        $this->template->content =$content;
    }

    public function action_add(){
        $data =array();
        $portfolio = new Model_Portfolio();
        if ($this->request->method() === Request::POST){
            if($portfolio->addPortfolio(false))$data['msg'] = Kohana::message('portfolio', 'add');
            else $data['msg'] = Kohana::message('portfolio', 'addNot');
        }
        $data['menu'] = Kohana::$config->load('app')->get('dirApp').'admin/';
        $data['portfolio'] = $portfolio->getAll();

        $content = View::factory('addview');
        $content->bind('data',$data);
        $this->template->content =$content;
    }

    public function action_test(){
        $data =array();



        $content = View::factory('adminview');
        $content->bind('data',$data);
        $this->template->content =$content;
    }
    public function action_delete(){
        $code = $this->request->param('id');
        $portfolio = new Model_Portfolio();
        $portfolio->delPortfolio($code);
        HTTP::redirect($_SERVER['HTTP_REFERER']);
    }

    public function action_edit(){
        $data =array('edit'=>array());
        $code = $this->request->param('id');
        $portfolio = new Model_Portfolio();
        $data['edit']= $portfolio->getRecord($code);
        if(!$data['edit']){
            $data['edit']=array(
                'id' => '',
                'no' => '',
                'name' => '',
                'path' => '',
                'type' => '',
            );

        }
        if ($this->request->method() === Request::POST){
            if($portfolio->editPortfolio($code))$data['msg'] = Kohana::message('portfolio', 'edit');
            else $data['msg'] = Kohana::message('portfolio', 'editNot');
        }
        $data['menu'] = Kohana::$config->load('app')->get('dirApp').'admin/';
        $data['portfolio'] = $portfolio->getAll();

        $content = View::factory('editview');
        $content->bind('data',$data);
        $this->template->content =$content;
    }

    public function action_up(){
        $code = $this->request->param('id');
        $portfolio = new Model_Portfolio();
        $portfolio->setUp($code);
        HTTP::redirect($_SERVER['HTTP_REFERER']);
    }
    public function action_down(){
        $code = $this->request->param('id');
        $portfolio = new Model_Portfolio();
        $portfolio->setDown($code);
        HTTP::redirect($_SERVER['HTTP_REFERER']);
    }
} // End
