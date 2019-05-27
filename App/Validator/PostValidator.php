<?php

namespace App\Validator;

class PostValidator extends Validator
{
	const TITLE_EMPTY = 'le champ Titre est vide';
	const CONTENT_EMPTY = 'le champ Contenu est vide';
	const CHAPO_EMPTY = 'le champ Chapo est vide';
	const IMG_INVALID = 'un problème est survenu sur l\'image';
	const IMG_EXT = 'l\'extension doit etre un jpg ou png';
	const AUTHOR_ID_INVALID = 'une erreur est survenu';

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

	public function checkAuthorId($authorId)
	{
		if (empty($authorId)) {
			$this->errors[] = self::AUTHOR_ID_INVALID;
		}
	}

	public function checkImg(array $img)
	{
		$ext = ['jpg', 'png'];
		$imgExt = strtolower(substr($img['name'], -3));

		if ($img['error'] > 0) {
			$this->errors[] = self::IMG_INVALID;
		} elseif (!in_array($imgExt, $ext)) {
			$this->errors[] = self::IMG_EXT;
		} 
	}
}
