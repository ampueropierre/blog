<?php
namespace App\Controller;

/**
 * 
 */
class Controller
{
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

	protected function userSession()
	{
		$userSession = null;

		if (isset($_SESSION['user']))
		{
			return unserialize($_SESSION['user']);
		}
	}
}