<!-- display all the registered form entries in a table -->
<?php 
//get table data from database
require_once('classes/post.php');

$form_data = get_form_data();

// echo '<pre>';
// print_r($form_data);
// echo '</pre>';
?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form action="" method="post" name="edittable">
			<table class="table table-stripe table-hover" id="edittable">
				<thead>
					<tr>
						<!-- kicsiforeach -->
						<!-- removig underscore and space from the table th -->
						<?php foreach ($form_data[0] as $key => $value): ?>
							<th>
								<?php if ($key != 'id') echo ucfirst(str_replace('_', ' ', $key)); ?>
							</th>
						<?php endforeach ?>
						<th></th>
					</tr>
				</thead>

				<tbody class="">
					<!-- nagyforeach -->
					<?php foreach ($form_data as $rownumber => $rowdata): ?>
						<tr>
							<?php foreach ($rowdata as $key => $value): ?>
								<th><?php if ($key != 'id') echo $value; ?></th>
							<?php endforeach ?>

							<td>
								<a href="page.php?p=edit-table&rowid=<?php echo $rowdata['id']; ?>" data-id="<?php echo $rowdata['id']; ?>" class="btn btn-warning btn-edit btn-sm" id="edit-rowID"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								<a href="#" role="button" data-id="<?php echo $rowdata['id']; ?>" class="btn btn-danger btn-delete btn-sm"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<!-- /tbody -->
			</table>
			<!-- /table table-stripe table-hover -->
		</form>
		<!-- /form edittable -->
	</div>
	<!-- /col-md-8 -->
</div>
<!-- /div row -->

<div class="modal fade" id="delete-form-data-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Beware!</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this form data?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="delete-modal-cancel-button" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="delete-form-modal-delete-button">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>