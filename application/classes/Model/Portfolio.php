<?php defined('SYSPATH') or die('No direct script access.');

class Model_portfolio extends ORM{

    public function rules(){
        return array(
            'path' => array(
                array(array($this, 'unique'), array('path', ':value')),
            ),
        );
    }



    public function editPortfolio($code){
        $code = HTML::chars($code);
        $valid = Validation::factory(array('code'=>$code));
        $valid->rule('code','not_empty')
            ->rule('code','numeric');
        if($valid->check()){
            $record = ORM::factory('portfolio',$code);
            if($record->loaded()){
                if ($_FILES['portfolioSmall']['size']> 0 or $_FILES['portfolioBig']['size'] > 0){
                    $link = Kohana::$config->load('portfolio')->get('filePath').$record->path;
                    $oldNo=$record->no;
                    if(is_file($link.'.jpg') and is_file($link.'.png')){
                        unlink($link.'.jpg');
                        unlink($link.'.png');
                        $record->delete();
                    }
                    if($this->addPortfolio($oldNo))return true;
                    else return false;
                }else{
                    $record->name = HTML::chars($_POST['name']);
                    $record->type = HTML::chars($_POST['type']);
                    $record->update();
                    return true;
                }
            }
            else return false;
        }
        return false;
    }

    public function delPortfolio($code){
        $code = HTML::chars($code);
        $valid = Validation::factory(array('code'=>$code));
        $valid->rule('code','not_empty')
                ->rule('code','numeric');
        if($valid->check()){
            $record = ORM::factory('portfolio',$code);
            if($record->loaded()){
               $link = Kohana::$config->load('portfolio')->get('filePath').$record->path;
                if(is_file($link.'.jpg') and is_file($link.'.png')){
                    unlink($link.'.jpg');
                    unlink($link.'.png');
                }
               $record->delete();
                return true;
            }
            else return false;
        }
        return false;
    }

    public function addPortfolio($no){
        $tempFileName = 'file'.rand(10000000,99999999);
        $validationFiles = Validation::factory($_FILES)
            ->rules('portfolioSmall', array(
                array('Upload::not_empty'),
                array('Upload::image'),))
            ->rules('portfolioBig', array(
                array('Upload::not_empty'),
                array('Upload::image'),))
        ;
        $validationText = Validation::factory($_POST)
            ->rule('name','not_empty');
        if ($validationFiles->check() and $validationText->check()){
            Upload::save($validationFiles['portfolioSmall'],$tempFileName.'.png',Upload::$default_directory);
            Upload::save($validationFiles['portfolioBig'],$tempFileName.'.jpg',Upload::$default_directory);
            $tempFileNamePath = Upload::$default_directory.$tempFileName;
            $filePath = Kohana::$config->load('portfolio')->get('filePath');
            if (copy($tempFileNamePath.'.png',$filePath.$tempFileName.'.png')
                and copy($tempFileNamePath.'.jpg',$filePath.$tempFileName.'.jpg')){
                unlink($tempFileNamePath.'.png');
                unlink($tempFileNamePath.'.jpg');
                $this->path = $tempFileName;
                $this->name = HTML::chars($_POST['name']);
                $this->type = HTML::chars($_POST['type']);
                if (!$no) $this->no = (int)$this->maxNoPortfolio()+1;
                else $this->no = $no;
                $this->create();
                return true;
            }else return false;
        }else{
            return false;
        }
    }

    public function maxNoPortfolio(){
        $sql = 'select max(no) as maxno from portfolios';
        $query = DB::query(Database::SELECT, $sql)->execute()->as_array();
        return $query[0]['maxno'];
    }

    public static function getAll(){
        $data = null;
        $portfolio = ORM::factory('portfolio')
            ->order_by('no')
            ->find_all();
        foreach($portfolio as $port) {
            $data[] =
                array(
                    'no' => $port->no,
                    'id' => $port->id,
                    'name' => $port->name,
                    'type' => $port->type,
                    'link' => Kohana::$config->load('app')->get('dirApp').'public/images/ob/'.$port->path,
                    'path' => Kohana::$config->load('portfolio')->get('filePath').$port->path,
                    'del' => Kohana::$config->load('app')->get('dirApp').'admin/delete/'.$port->id,
                    'edit' => Kohana::$config->load('app')->get('dirApp').'admin/edit/'.$port->id,
                    'up' => Kohana::$config->load('app')->get('dirApp').'admin/up/'.$port->id,
                    'down' => Kohana::$config->load('app')->get('dirApp').'admin/down/'.$port->id,
                );
        }
        return $data;
    }

    public function getRecord($id){
        $id = HTML::chars($id);
        $portfolio = ORM::factory('portfolio')
            ->where('id','=',$id)
            ->find();
        if($portfolio->loaded()){
            return $portfolio->as_array();
        } else return false;
    }

    public function getMinMax($id){
        $data=array('min'=>false,'minId'=>false, 'max'=>false,'maxId'=>false);
        $all = $this->getAll();
        $n=0;
        foreach($all as $item){
            if($item['id'] === $id){
                if (isset($all[$n-1]['no'])){
                    $data['min'] = $all[$n-1]['no'];
                    $data['minId'] = $all[$n-1]['id'];
                }
                if (isset($all[$n+1]['no'])){
                    $data['max'] = $all[$n+1]['no'];
                    $data['maxId'] = $all[$n+1]['id'];
                }
            }
            $n++;
        }
        return $data;
    }

    public function setUp($id){
        $arr = $this->getMinMax($id);
        if($arr['min']){
            $portfolio = ORM::factory('portfolio')
                ->where('id','=',$id)
                ->find();
            if($portfolio->loaded()){
                $oldNo = $portfolio->no;
                $portfolio->no = $arr['min'];
                $portfolio->update();
                $portfolio = ORM::factory('portfolio')
                    ->where('id','=',$arr['minId'])
                    ->find();
                if($portfolio->loaded()){
                    $portfolio->no = $oldNo;
                    $portfolio->update();
                    return true;
                }
            }
        }
        return false;
    }

    public function setDown($id){
        $arr = $this->getMinMax($id);
        if($arr['max']){
            $portfolio = ORM::factory('portfolio')
                ->where('id','=',$id)
                ->find();
            if($portfolio->loaded()){
                $oldNo = $portfolio->no;
                $portfolio->no = $arr['max'];
                $portfolio->update();
                $portfolio = ORM::factory('portfolio')
                    ->where('id','=',$arr['maxId'])
                    ->find();
                if($portfolio->loaded()){
                    $portfolio->no = $oldNo;
                    $portfolio->update();
                    return true;
                }
            }
        }
        return false;
    }
} // end