<?php

class UserController
{
	public function actionLogin()
	{
		$email = '';
		$password = '';

		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			$userId = User::checkUserData($email, $password);

			if($userId == false) {
				$errors[] = 'Неверный e-mail или пароль!';
			} else {
				User::auth($userId);

				header("Location: /front/");
			}
		}

		require_once(ROOT.'/views/site/index.php');

		return true;
	}

	public function actionLogout()
	{
		unset($_SESSION['user']);
		header("Location: /");
	}

	public function actionRegister()
	{
		$name = '';
		$email = '';
		$password = '';
		$result = false;

		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			if (!User::checkName($name)) {
				$errors[] = 'Логин должен содержать не менее двух символов';
			}

			if (!User::checkEmail($email)) {
				$errors[] = 'Некорректный E-mail';
			}

			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль должен содержать не менее 6 символов';
			}

			if (User::checkEmailExists($email)) {
				$errors[] = 'Данный E-mail занят';
			}

			if ($errors == false) {
				$result = User::register($name, $email, $password);
				$userId = User::checkUserData($email, $password);
				User::auth($userId);

				header("Location: /front");
			}		

		}

		require_once(ROOT.'/views/site/register.php');

		return true;
	}

	public function actionAccount()
	{
		$userId = User::checkLogged();

		$user = User::getUserById($userId);

		$result = false;

		if (isset($_POST['submit'])) {
			$first_name = $_POST['first_name'];
			$age = $_POST['age'];
			$city = $_POST['city'];

			$uploaddir = './template/images/';
			$image = basename($_FILES['image']['name']);
			$uploadfile = $uploaddir.$image;

			$errors = false;

			if (!User::checkName($first_name)) {
				$errors[] = 'Имя не должно быть короче 2-х символов!';
			}

			if (!User::checkAge($age)) {
				$errors[] = 'Поле возраст должно содержать только числа!';
			}

			if (!User::checkCity($city)) {
				$errors[] = 'Название города должно быть больше 2-х символов!';
			}

			if (!copy($_FILES['image']['tmp_name'], $uploadfile))
			{
				$errors[] = 'Не удалось загрузить изображение!';
			}

			if ($errors == false) {
				$result = User::edit($userId, $first_name, $age, $city, $image);

				header("Location: /front");
			}

		}

		require_once(ROOT.'/views/site/account.php');

		return true;
	}
}

?>