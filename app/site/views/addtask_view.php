<div class="container">
	<div class="row">
		<div class="col-12 col-md-8 mx-auto">
			<div class="row">
				<?php if (isset($success)): ?>
				<div class="alert alert-success w-100" role="alert">
				  <?php echo $success; ?>
				</div>
				<?php endif; ?>
				<?php if (isset($errors)): ?>
				<div class="alert alert-danger w-100" role="alert">
				  <?php
				  	foreach ($errors as $error) {
				  		echo '<p>' . $error . '</p>';
				  	}
				  ?>
				</div>
				<?php endif; ?>				
				<form class="w-100" action="" method="post">
				  <div class="form-group">
				    <label for="user-name">Имя пользователя</label>
				    <input type="text" class="form-control" id="user-name" name="user_name">
				  </div>
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" name="email">
				  </div>
				  <div class="form-group">
				    <label for="text">Текст</label>
				    <textarea class="form-control" id="text" rows="3" name="text"></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary" name="add_task">Добавить</button>
				</form>			
			</div>
		</div>
	</div>
</div>			
