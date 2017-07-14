<?php include ROOT.'\views\layouts\header.php' ?>;

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Регистрация</h1>

            <?php if ($result): ?>
                <p>Вы зарегистрированы!</p>
            <?php else: ?>
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li class="text-danger"> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            <form action="#" method="post">
                <div class="form-group">
                    <label for="first_name">Ваш логин</label>
                    <input class="form-control" type="text" name="name" id="first_name" value="<?php echo $name ?>">
                </div>
                <div class="form-group">
                    <label for="email">Ваш E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Ваш пароль</label>
                    <input class="form-control" type="password" name="password" id="password" value="<?php echo $password ?>">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Зарегистрировать"></input>
            </form>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php include ROOT.'\views\layouts\footer.php' ?>;