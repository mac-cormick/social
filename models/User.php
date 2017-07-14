<?php

class User
{
	public static function checkLogged()
	{
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}
		header("Location: /");
	}

	public static function isGuest()
	{
		if (isset($_SESSION['user'])) {
			return false;
		}
		return true;
	}

	public static function checkUserData($email, $password)
	{
		$db = Db::getConnection();

		$sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_INT);
		$result->bindParam(':password', $password, PDO::PARAM_INT);
		$result->execute();

		$user = $result->fetch();
		if($user) {
			return $user['id'];
		}
		return false;
	}

	public static function auth($userId)
	{
		$_SESSION['user'] = $userId;
	}

	public static function register($name, $email, $password) {

		$db = Db::getConnection();

		$sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);

		return $result->execute();
	}

	public static function checkName($name) {
		if (strlen($name) >= 2) {
			return true;
		}
		return false;
	}

	public static function checkCity($city) {
		if (strlen($city) >= 2) {
			return true;
		}
		return false;
	}

	public static function checkPassword($password) {
		if (strlen($password) >= 6) {
			return true;
		}
		return false;
	}

	public static function checkEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	public static function checkAge($age) {
		if (is_numeric($age)) {
			return true;
		}
		return false;
	}

	public static function checkEmailExists($email) {

		$db = Db::getConnection();

		$sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();

		if ($result->fetchColumn()) {
			return true;
		}
		return false;
	}

	public static function getUserById($id)
	{
		if ($id) {
			$db = Db::getConnection();
			$sql = 'SELECT * FROM users WHERE id = :id';

			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);

			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();

			return $result->execute();
		}
	}

	public static function getPersonById($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();
			$sql = 'SELECT * FROM users WHERE id =' . $id;

			$result = $db->query($sql);

			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result->fetch();
		}
	}

	public static function edit($id, $first_name, $age, $city, $image)
	{
		$db = Db::getConnection();
		$sql = "UPDATE users SET first_name = :first_name, age = :age, city = :city, image = :image WHERE id = :id";

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':first_name', $first_name, PDO::PARAM_STR);
		$result->bindParam(':age', $age, PDO::PARAM_INT);
		$result->bindParam(':city', $city, PDO::PARAM_STR);
		$result->bindParam(':image', $image, PDO::PARAM_STR);
		return $result->execute();
	}

}

?>