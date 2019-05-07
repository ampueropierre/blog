<?php
namespace App\Validator;

/**
 * 
 */
class PostValidator extends Validator
{
	const TITLE_EMPTY = 'le champ Titre est vide';
	const CONTENT_EMPTY = 'le champ Contenu est vide';
	const CHAPO_EMPTY = 'le champ Chapo est vide';

	public function checkTitle($title)
	{
		if (empty($title)) {
			$this->errors[] = self::TITLE_EMPTY;
		}
	}

	public function checkContent($content)
	{
		if (empty($content)) {
			$this->errors[] = self::CONTENT_EMPTY;
		}
	}

	public function checkChapo($chapo)
	{
		if (empty($chapo)) {
			$this->errors[] = self::CHAPO_EMPTY;
		}
	}

}