<?php

 /**
 * Class Controller
 * Abstract Class for Backend and Frontend
 */
namespace App\Controller;

use App\Session\Session;

abstract class Controller
{
	/**
	 * @param string $view path view
	 * @param string $template path template
	 * @param array $variable tranfert variables
	 */
	public function render($view,$template,$variable = [])
	{	
		if (!empty($view)) {
			ob_start();
			extract($variable);
			require $view;
			$content = ob_get_clean();
			require $template;
		} else {
			extract($variable);
			require $template;
		}
	}

	/**
	 * @return return page 404  
	 */
	public function page404()
	{
		$userSession = Session::get('user');
		$title = '404 Error';
		$this->render('view/404.php','view/template/page.php', compact('userSession','title'));
	}
}
