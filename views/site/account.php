<?php include ROOT.'\views\layouts\header.php' ?>;

<div class="container">
	<div class="row profile">

		<div class="col-md-4 col-md-offset-4">
		<h1>Редактирование профиля</h1>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li class="text-danger"> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="first_name">Имя</label>
					<input class="form-control" type="text" name="first_name" id="first_name" value="">
				</div>
				<div class="form-group">
					<label for="city">Город</label>
					<input class="form-control" type="text" name="city" id="city" value="">
				</div>
				<div class="form-group">
					<label for="age">Возраст</label>
					<input class="form-control" type="text" name="age" id="age" value="">
				</div>
				<div class="form-group">
					<label for="image">Фото (только .jpg)</label>
					<input type="file" name="image" class="form-control" id="image">
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="Редактировать"></input>
			</form>


		</div>
	</div>
</div>

<?php include ROOT.'\views\layouts\footer.php' ?>;