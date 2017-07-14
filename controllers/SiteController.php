<?php

class SiteController 
{
	public function actionFront()
	{
		$userId = User::checkLogged();

		$user_id = User::checkLogged();
		$date = date("Y-m-d H:i:s");

		$result = false;

		if (isset($_POST['submit'])) {
			$title = $_POST['title'];
			$text = $_POST['text'];

			$errors = false;

			if (empty($title)) {
				$errors[] = 'Введите название новости!';
			}

			if (empty($text)) {
				$errors[] = 'Введите текст новости!';
			}

			if ($errors == false) {
				$result = News::edit($title, $text, $date, $user_id);
			}

		}

		require_once(ROOT.'/views/site/front.php');

		return true;
	}

}