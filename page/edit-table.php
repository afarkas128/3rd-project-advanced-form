<!-- editing the table -->
<?php
//get table data from database
require_once('classes/post.php');


$form_data = get_form_data($_GET['rowid'])[0];

// echo '<pre>';
// print_r($form_data);
// echo '</pre>';

?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="alert" id="edit-form-submission-notification" role="alert"></div>
		<form action="classes/post.php" method="post" class="form" name="tableupdate" id="my-edit-form" role="form">

			<div class="well well-sm row" id="form-input-list">
				<div class="col-md-12 first-name form-group">
					<label for="">First Name</label>
					<input class="form-control" type="text" name="first_name" value="<?php echo $form_data['first_name'] ;?>" maxlength="50" placeholder="First Name" required />
				</div>

				<div class="col-md-12 last-name form-group">
					<label for="">Last Name</label>
					<input type="text" class="form-control"  name="last_name" value="<?php echo $form_data['last_name'] ;?>" maxlength="50" placeholder="Last Name" required />
				</div>

				<div class="col-md-12 form-group">
					<label for="birthday-picker">Birthdate</label>
					<input type="date" format="yyyy-mm-dd" class="form-control" name="birthdate" value="<?php echo $form_data['birthday'] ;?>" id="birthday-picker" placeholder="Select your birthday">
				</div>

				<div class="col-md-12 form-group">
					<label for="age" class="age-selector">Your Age</label>
					<input type="text" class="form-control" id="age" name="age" value="<?php echo $form_data['age'] ;?>" placeholder="Your age will appear here." required />
				</div>

				<div class="col-md-12 form-group">
					<label for="country-selector">Country</label>
					<select class="form-control" type="selectable" name="country" value="<?php echo $form_data['country'] ;?>" id="country-selector" placeholder="Country">
						<option value="" data-option-selected="<?php echo $form_data['country'] ;?>">Select Your Country</option>

					</select>
				</div>
				
			    <div class="col-md-12 form-group">
			    	<label>Friend(s)</label>
			    	<div class="row">
						<div class="col-md-10">
							<div class="control-group">
						    	<input type="text" class="form-control" id="friends" maxlength="50" name="friends[]" value="<?php echo $form_data['number_of_friends'] ;?>" placeholder="Enter your friend's name...">
					    	</div>
						</div>
						<!-- /friends label -->

			    		<div class="col-md-2">
			    			<button class="btn btn-xs btn-success add-friend">
			    				<span class="glyphicon glyphicon-plus"></span>
			    			</button>
			    		</div>
			    		<!-- /add friend -->
			    	</div>
					<!-- /.row -->
			  	</div>
			  	<!-- /div col-md-12 form-group -->
			</div>
			<!-- /well well-sm row form-input-list -->

			<div class="but-submit">
				<button type="submit" role="button" class="btn btn-success btn-update" id="button-update" data-form-id="<?php echo $form_data['id'];?>" name="update">Update</button>
			</div>
			<!-- /submit button -->
		</form>
		<!-- /form -->
	</div>
	<!-- /col-md-8 col-md-offset-2 -->
</div>
<!-- /row -->