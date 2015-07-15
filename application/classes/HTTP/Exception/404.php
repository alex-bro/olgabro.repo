<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception_404 extends Kohana_HTTP_Exception_404 {
	
	  /**
     * Generate a Response for the 404 Exception.
     *
     * The user should be shown a nice 404 page.
     * 
     * @return Response
     */
    public function get_response()
    {
        //return;
        $view = View::factory('404view');

        // Remembering that `$this` is an instance of HTTP_Exception_404
       // $view->message = $this->getMessage();
        $view->message = "Страница не найдена";

        $response = Response::factory()
            ->status(404)
            ->body($view->render());

        return $response;
    }
}
