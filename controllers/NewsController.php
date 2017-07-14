<?php

class NewsController
{
	public function actionIndex()
	{
		$newsList = array();
		$newsList = News::getNewsList();

		require_once(ROOT.'/views/news/index.php');

		return true;
	}

	public function actionView($id)
	{
		if ($id) {
			$newsItem = News::getNewsItemById($id);

			echo '<pre>';
			print_r($newsItem);
			echo '</pre>';

			echo 'actionView';
		}

		return true;
	}

	public function actionDelete($newsId)
	{
		$result = News::deleteNews($newsId);

		header("Location: {$_SERVER['HTTP_REFERER']}");

		return true;
	}

	public function actionEdit()
	{
		$newsId = $_POST['newsId'];
		$newsText = $_POST['newstext'];
		$newsTitle = $_POST['newstitle'];

		$result = News::editNews($newsId, $newsText, $newsTitle);

		return true;
	}

}