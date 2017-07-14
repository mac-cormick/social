<?php include ROOT.'\views\layouts\header.php' ?>


<?php
	$userId = User::checkLogged();
	$user = User::getPersonById($userId);
?>

<div class="container">
	<div class="row">

		<div class="col-md-2">
			<div class="sidebar-module">
				<h4>Archives</h4>
				<ol class="list-unstyled">
					<li><a href="#">March 2014</a></li>
					<li><a href="#">February 2014</a></li>
					<li><a href="#">January 2014</a></li>
					<li><a href="#">December 2013</a></li>
					<li><a href="#">November 2013</a></li>
					<li><a href="#">October 2013</a></li>
					<li><a href="#">September 2013</a></li>
					<li><a href="#">August 2013</a></li>
					<li><a href="#">July 2013</a></li>
					<li><a href="#">June 2013</a></li>
					<li><a href="#">May 2013</a></li>
					<li><a href="#">April 2013</a></li>
				</ol>
			</div>
		</div>

		<div class="col-md-10 main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 inform">
						<img src="/template/images/<?php echo $user['image']; ?>" alt="">
						<div class="about">
							<div class="about-item">
								<span>Имя</span>
								<p><?php echo $user['first_name']; ?></p>
							</div>
							<div class="about-item">
								<span><?php echo $user['age']; ?></span>
								<p>27</p>
							</div>
							<div class="about-item">
								<span><?php echo $user['city']; ?></span>
								<p>Москва</p>
							</div>
						</div>
					</div>

					<div class="col-md-8 my-news">
						<h2>Мои новости</h2>


						<?php if (isset($errors) && is_array($errors)): ?>
							<ul>
								<?php foreach ($errors as $error): ?>
									<li class="text-danger"> - <?php echo $error; ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

						<form action="" id="add_news" method="post">
							<input class="form-control" type="text" name="title" id="title" placeholder="Заголовок" value="">
							<textarea class="form-control" name="text" id="add_news" cols="30" rows="5" placeholder="Добавить новость"></textarea>
							<?php if ($result): ?>
							<span class="text-success">Новость добавлена!</span>
						<?php endif; ?>
							<input type="submit" name="submit" id="add_news" class="btn btn-primary" value="Добавить"></input>
						</form>

						<?php 
							$newsList = array();
							$newsList = News::getNewsList();

							foreach ( $newsList as $newsItem ):
						?>

						<div class="mynews-item" data-newsid="<?php echo $newsItem['id']; ?>">
							<img src="/template/images/<?php echo $user['image']; ?>" alt="">
							<div class="mynews-about">
								<span class="mynews-author"><?php echo $user['first_name']; ?></span>
								<p><?php echo $newsItem['date']; ?></p>
							</div>
							<h4><?php echo $newsItem['title']; ?></h4>
							<p><?php echo $newsItem['text']; ?></p>
							<div class="redact">
								<i class="fa fa-heart" aria-hidden="true"><span>Нравится</span></i>
								<a href="" class="news-edit">Редактировать</a>
								<a href="/newsdelete/<?php echo $newsItem['id']; ?>">Удалить новость</a>
							</div>
						</div>

					<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Редактировать новость</h4>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<input class="form-control" type="text" name="news-title" id="news-title" placeholder="Заголовок новости" value="">
								<textarea class="form-control" name="news-text" id="news-text" rows="5" placeholder="Текст новости"></textarea>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<button type="button" class="btn btn-primary" id="modal-save">Сохранить</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	</div>
</div>

<?php include ROOT.'\views\layouts\footer.php' ?>;