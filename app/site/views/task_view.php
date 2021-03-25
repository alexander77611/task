<div class="container">
	<div class="row">
		<?php if (isset($success)): ?>
		<div class="alert alert-success w-100" role="alert">
			<?php echo $success; ?>
		</div>
		<?php endif; ?>
		<?php if (isset($error)): ?>
		<div class="alert alert-danger w-100" role="alert">
			<?php echo $error; ?>
		</div>
		<?php endif; ?>			

		<div class="col-12 col-md-8 mx-auto">
			<div class="row">
				<form class="form-inline my-2 mx-1" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					  <input type="hidden" name="page" value="<?php echo $page; ?>">
				      <select class="custom-select my-1 mr-sm-2 mt-1" id="sort" name="sort">
				        <?php 
				        	if (isset($_GET['sort'])) {
				        		echo '<option selected></option>';
				        	} else {
				        		echo '<option></option>';
				        	}
				        	foreach ($sort as $value => $title) {
				        		if (isset($_GET['sort']) and $value == $_GET['sort']) {
				        			echo "<option value=\"$value\"  selected>$title</option>";
				        		} else {
				        			echo "<option value=\"$value\">$title</option>";				        			
				        		}				        		
				        	}
				        ?>
				      </select>
				      <select class="custom-select mr-sm-2 mt-1" id="order" name="order">
				        <?php 
				        	if (isset($_GET['order'])) {
				        		echo '<option selected></option>';
				        	} else {
				        		echo '<option></option>';
				        	}
				        	foreach ($order as $value => $title) {
				        		if (isset($_GET['order']) and $value == $_GET['order']) {
				        			echo "<option value=\"$value\" selected>$title</option>";
				        		} else {
				        			echo "<option value=\"$value\">$title</option>";				        			
				        		}				        		
				        	}
				        ?>
				      </select>

				  	  <button type="submit" class="btn btn-primary mt-1">Сортировать</button>
				</form>
			
			</div>
			<div class="row">
				<?php
					if (!empty($task)):
						foreach($task as $row):
					
				?>
				<div class="card w-100 mx-1 mb-2" id="task-<?php echo $row['task_id'];?>">
				  <div class="card-header">
				    <?php echo ($row['status'] ? 'Просмотрено' : 'Не просмотрено'); ?>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title"><?php echo $row['user_name']; ?></h5>
				    <a href="<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
				    <?php if ($is_admin): ?>
				    <form action="" method="post">
				    	<input type="hidden" name="task_id" value="<?php echo $row['task_id'];?>">
				    	<textarea class="form-control mt-2" name="text" rows="3"><?php echo $row['text']; ?></textarea>
				    	<div class="form-group form-check mt-2">
							<input type="checkbox" class="form-check-input" name="status" value="1" id="status-<?php echo $row['task_id'];?>" <?php echo ($row['status'] ? 'checked': ''); ?> >
							<label class="form-check-label" for="status-<?php echo $row['task_id'];?>">Просмотрено</label>
						</div>
				    	<button type="submit" name="ch_task" class="btn btn-primary">Изменить</button>
				    </form>
				    <?php else: ?>				    	
				    <p class="card-text"><?php echo $row['text']; ?></p>
				    <?php endif; ?>
				    
				  </div>	
				</div>
				<?php
						endforeach;
					else:
				?>
				<p class="text-center">Записей нет!</p>
				<?php
					endif;
				?>				
			</div>
		</div>
	</div>
	<?php if (!empty($pages)): ?>
	<div class="row">
		<nav class="mx-auto">
		  <ul class="pagination pagination-sm">
		  	<?php			
		  		foreach ($pages as $page_data) {
		  			if ($page == $page_data['page']) {
		  				echo "
						    <li class=\"page-item active\">
						      <span class=\"page-link\">$page_data[page]</span>
						    </li>
		  				";
		  			} else {
		  				echo "
						    <li class=\"page-item\">
						      <a class=\"page-link\" href=\"/?$page_data[url]\">$page_data[page]</a>
						    </li>
		  				";		  				
		  			}
		  		}			  	
		  	?>
		  </ul>
		</nav>		
	</div>
	<?php endif; ?>
</div>			
