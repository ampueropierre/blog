<?php
namespace App\Validator;

/**
 * 
 */
class CommentValidator extends Validator
{
	const COMMENT_EMPTY = 'le champ Commentaire est vide';

	public function checkComment($comment)
	{
		if (empty($comment)) {
			$this->errors[] = self::COMMENT_EMPTY;
		}
	}
}