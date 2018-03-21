			<div class="row">
				<div class="slideshow-container">
					<div class="slider-images" id="images_holder">
						<img src="assets/img/download-1-2000x400.jpg" alt="">
						<img src="assets/img/download.jpg">
						<img src="assets/img/download-2-2000x400.jpg" alt="">
						<img src="assets/img/Bigstock-29515858-Earth-sunrise-2000x400.jpg">
						<img src="assets/img/custom_105816404-2000x400.jpg">
					</div>
					<!-- /slider images -->

					<div class="nav-buttons">
						<a class="left farki-slider-control on-hover" id="nav-arrow-left" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right farki-slider-control on-hover" id="nav-arrow-right" role="button" data-slide="next">
					        <span class="glyphicon glyphicon-chevron-right"></span>
	      				</a>				
					</div>
					<!-- /nav button hand div -->
				</div>
				<!-- /slideshow-container -->
			</div>
			<!-- /div row -->
		</div>
		<!-- /fluid container div -->
				
		<div class="container form-container">

			<div class="row">

				<div class="col-md-6 col-md-offset-3 selectable-options text_color" id="flip">Slider options</div>
				<!-- col-md-6 col-md-offset-3 selectable-options text_color -->

				<div class="" id="panel">
					<div class="checkbox-type text_color" id="">
						<input type="checkbox" class="show-type" name="checkbox"	/>Show slide changing buttons
					</div>
					<!-- /checkbox-type text_color -->

					<select class="select-option text_color" id="animation-types-selector">
						<p>Animation type</p>
						<option value="">Fade</option>
						<option value="Slide">Slide</option>
					</select>
					<!-- /animation type selector -->
					
					<select class="select-option text_color" id="slide-change-button-type-selector">
						<option value="chevron" selected>Chevron</option>
						<option value="arrow">Arrow</option>
						<option value="triangle">Triangle</option>
					</select>
					<!-- /select-option text_color slide-change-button-type-selector -->

					<div class="select-option slide-duration text_color">
						<p class="slide-duration-p">Image slide duration</p>
						<input type="radio" name="slide_duration" value="1">1 sec
						<input type="radio" name="slide_duration" value="2">2 sec
						<input type="radio" name="slide_duration" value="3" checked>3 sec
						<input type="radio" name="slide_duration" value="4">4 sec
						<input type="radio" name="slide_duration" value="5">5 sec
					</div>
					<!-- /slide duration div -->
				</div>
				<!-- /panel -->

				<div class="col-md-6 col-md-offset-3">

					<form action="post.php" method="post" class="form" id="my-submission-form" role="form">

						<div class="well well-sm row" id="form-input-list">
							<div class="col-md-12 first-name form-group">
								<label for="">First Name</label>
								<input class="form-control" type="text" name="first_name" maxlength="50" placeholder="First Name" required />
							</div>

							<div class="col-md-12 last-name form-group">
								<label for="">Last Name</label>
								<input type="text" class="form-control"  name="last_name" maxlength="50" placeholder="Last Name" required />
							</div>

							<div class="col-md-12 form-group">
								<label for="birthday-picker">Select Your Birthdate</label>
								<input type="date" format="yyyy-mm-dd" class="form-control" id="birthday-picker" name="birthdate" placeholder="Select your birthday">
							</div>

							<div class="col-md-12 form-group">
								<label for="age" class="age-selector">Your Age</label>
								<input type="text" class="form-control" id="age" name="age" placeholder="Your age will appear here." required />
							</div>

							<div class="col-md-12 form-group">
								<label for="country-selector">Country</label>
								<select class="form-control" type="selectable" name="country" id="country-selector" placeholder="Country">
									<option value="">Select Your Country</option>

								</select>
							</div>
							
						    <div class="col-md-12 form-group">
						    	<label>Friend(s)</label>
						    	<div class="row">
									<div class="col-md-10">
										<div class="control-group">
									    	<input type="text" class="form-control" id="friends" maxlength="50" name="friends[]" placeholder="Enter your friend's name...">
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
							<button type="submit" role="button" class="btn btn-success" id="button-submit" name="submit">Submit</button>
						</div>
						<!-- /submit button -->
					</form>
					<!-- /form -->
				</div>
				<!-- /col-md-6 col-md-offset-3 div -->
			</div>
			<!-- /div row -->
		</div>
		<!-- /container form-container -->
		
		<!-- Modal -->
		<div class="modal fade" id="submit-response-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
		      </div>
		      <div class="modal-body" id="submit-reponse-modal-content">
		        ...
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- /Modal div -->