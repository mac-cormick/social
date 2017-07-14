<?php

class News
{
	public static function edit($title, $text, $date, $user_id)
	{
		$db = Db::getConnection();

		$sql = 'INSERT INTO news (title, text, date, user_id) VALUES (:title, :text, :date, :user_id)';

		$result = $db->prepare($sql);
		$result->bindParam(':title', $title, PDO::PARAM_STR);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		$result->bindParam(':date', $date, PDO::PARAM_STR);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);

		return $result->execute();
	}

	public static function getNewsItemById($id)
	{
		$id = intval($id);

		if ($id) {

			$db = Db::getConnection();

			$result = $db->query('SELECT * FROM news WHERE id =' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();
			return $newsItem;
		}
	}

	public static function getNewsList()
	{
		$db = Db::getConnection();

		$newsList = array();

		$result = $db->query('SELECT * FROM news ORDER BY date DESC');

		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['text'] = $row['text'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['user_id'] = $row['user_id'];
			$i++;
		}

		return $newsList;
	}

	public static function deleteNews($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();

			$result = $db->query('DELETE FROM news WHERE id=' . $id);

			return $result;
		}
	}

	public static function editNews($id, $text, $title)
	{
		$db = Db::getConnection();

		$sql = "UPDATE news SET title = :title, text = :text WHERE id = :id";

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':title', $title, PDO::PARAM_INT);
		$result->bindParam(':text', $text, PDO::PARAM_INT);
		return $result->execute();
	}

}

?>