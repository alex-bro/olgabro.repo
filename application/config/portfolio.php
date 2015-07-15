<?php defined('SYSPATH') OR die('No direct access allowed.');
return array(
    'filePath' => DOCROOT.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'ob'.DIRECTORY_SEPARATOR,
    'menu'=>array(
        "<a href='".Kohana::$config->load('app')->get('dirApp')."'>Главная</a>",
        "<a href='".Kohana::$config->load('app')->get('dirApp')."admin/add'>Добавить</a>",
        "<a href='".Kohana::$config->load('app')->get('dirApp')."auth/logout'>Выход</a>",
    ),
);