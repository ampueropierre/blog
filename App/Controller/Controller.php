<?php

/**
 * Class Controller
 * Abstract Class pour Backend et Frontend
 */
namespace App\Controller;

abstract class Controller
{
	/**
	 * @param string $view La vue a affiché
	 * @param string $template Le template utilisé
	 * @param array $variable
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
	 * @return $_SESSION si connecté ou null
	 */
	protected function userSession()
	{
		if (isset($_SESSION['user'])) {
			return unserialize($_SESSION['user']);
		}

		return null;
	}

	/**
	 * @return La page 404  
	 */
	public function page404()
	{
		$userSession = $this->userSession();
		$title = '404 Error';
		$this->render('view/404.php','view/template/page.php', compact('userSession','title'));
	}
}
