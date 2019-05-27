<?php

namespace App\Controller;

abstract class Controller
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
		if (isset($_SESSION['user'])) {
			return unserialize($_SESSION['user']);
		}

		return null;
	}
}
