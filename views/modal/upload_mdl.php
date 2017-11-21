<div class="modal fade" id="upload-mdl">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Documents</h4>
			</div>
			<div class="modal-body">
				<!-- form here -->
				<form class="form-horizontal" id="upload-frm" action="" enctype="multipart/form-data">
					<input type="hidden" name="dateToday">
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-2"></label>
						<div class="col-xs-6 col-sm-6 col-md-6" id="category">
							<!-- category -->
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-2"></label>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<input type="text" name="title" class="form-control" placeholder="Enter Title">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-2"></label>
						<div class="col-xs-6 col-sm-6 col-md-2">
							<button type="button" id="scanBtn" class="btn btn-success"><i class="fa fa-print"></i> Scan</button>
						</div>
						<label class="col-xs-2 col-sm-2 col-md-1"></label>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<input type="file" name="file[]" multiple="" id="file" class="form-control" placeholder="Document Title">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-2 control-label"></label>
						<div class="col-xs-3 col-sm-3 col-md-8">
							<span style="color: #ED1C16; font-size: 18px;">Please checked all or select faculty to allowed to view this file(s)</span>
						</div>
					</div>
					<div class="form-group" id="option-hide">
						<label class="col-xs-2 col-sm-2 col-md-2 control-label"></label>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="table-responsive" style="border:1px solid black;width:auto;max-height:250px;overflow:scroll;">
								<table class="table table-hover table-bordered table-striped" style="font-size: 12px;">
									<thead>
										<tr>
											<th><input type="checkbox" name="check-all" id="check-all" ><br /><span style="font-size: 10px;">(All)</span></th>
											<th>Name</th>
										</tr>
									</thead>
									<tbody id="check-faculty">

									</tbody>
								</table>
							</div>
						</div>
					</div>	
					<div class="form-group">
						<label class="col-xs-2 col-sm-2 col-md-2"></label>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Ok</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>