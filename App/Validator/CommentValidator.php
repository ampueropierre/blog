<?php

namespace App\Validator;

class CommentValidator extends Validator
{
	const COMMENT_EMPTY = 'le champ Commentaire est vide';
	const STATUS_INVALID = 'une erreur est survenue';

	public function checkComment($comment)
	{
		if (empty($comment)) {
			$this->errors[] = self::COMMENT_EMPTY;
		}
	}

	public function checkStatus(int $status)
	{
		if ($status != 0 && $status != 1) {
			$this->errors[] = self::STATUS_INVALID;
		}
	}
}
