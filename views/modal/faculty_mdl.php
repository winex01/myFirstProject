<div class="modal fade" id="facult-mdl">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<!-- form here -->
				<form class="form-horizontal" id="faculty-frm">
					<input type="hidden" name="fac-id" id="fac-id">
					<input type="hidden" name="user-id" id="user-id">
					<input type="hidden" name="dateToday">
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-4 control-label">Faculty ID#:</label>
						<div class="col-xs-8 col-sm-8 col-md-6">
							<input type="Number" name="factID" class="form-control" autofocus="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-4 control-label">Firstname:</label>
						<div class="col-xs-8 col-sm-8 col-md-6">
							<input type="text" name="fname" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-4 control-label">Middle Name:</label>
						<div class="col-xs-8 col-sm-8 col-md-6">
							<input type="text" name="mname" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-4 control-label">LastName:</label>
						<div class="col-xs-8 col-sm-8 col-md-6">
							<input type="text" name="lname" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-4 control-label">Sex:</label>
						<div class="col-xs-8 col-sm-8 col-md-6">
							<label class="radio-inline"><input type="radio" name="gender" value="0">Male</label>
							<label class="radio-inline"><input type="radio" name="gender" value="1">Female</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-4 control-label">Phone Number:</label>
						<div class="col-xs-8 col-sm-8 col-md-6">
							<!-- <input type="Number" name="phoneNo" class="form-control" placeholder="Phone Number"> -->
							<input type="tel" pattern="^\d{12}$" name="phoneNo" class="form-control" placeholder="format: 639123456789">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-2 control-label"></label>
						<div class="col-xs-8 col-sm-8 col-md-8">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>