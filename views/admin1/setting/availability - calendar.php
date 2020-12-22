<!DOCTYPE html>
<html>


<body>



<div class="wrapper">
	<div class="container-fluid">
		
		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="btn-group pull-right m-t-20">
					<button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings </button>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- item-->
						<a href="javascript:void(0);" class="dropdown-item">Action</a>
						<!-- item-->
						<a href="javascript:void(0);" class="dropdown-item">Another action</a>
						<!-- item-->
						<a href="javascript:void(0);" class="dropdown-item">Something else</a>
						<!-- item-->
						<a href="javascript:void(0);" class="dropdown-item">Separated link</a>
					</div>
				</div>
				<h4 class="page-title">Calendar</h4>
			</div>
		</div>
		<!-- end page title end breadcrumb -->
		
		
		<div class="row">
			<div class="col-lg-12">
				
				<div class="row">
					
					<div class="col-lg-9">
						<div class="card-box">
							<div id="calendar"></div>
						</div>
					</div> <!-- end col -->
				</div>  <!-- end row -->
				
						<!-- BEGIN MODAL -->
				<div class="modal fade none-border" id="event-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title mt-0"><strong>Add New Event</strong></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
								<button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
							</div>
						</div>
					</div>
				</div>
				
						<!-- Modal Add Category -->
				<div class="modal fade none-border" id="add-category">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title mt-0"><strong>Add a category </strong></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<form role="form">
									<div class="row">
										<div class="col-md-6">
											<label class="control-label">Category Name</label>
											<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
										</div>
										<div class="col-md-6">
											<label class="control-label">Choose Category Color</label>
											<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
												<option value="success">Success</option>
												<option value="danger">Danger</option>
												<option value="info">Info</option>
												<option value="pink">Pink</option>
												<option value="primary">Primary</option>
												<option value="warning">Warning</option>
												<option value="inverse">Inverse</option>
											</select>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
							</div>
						</div>
					</div>
				</div>
						<!-- END MODAL -->
			</div>
			<!-- end col-12 -->
		</div> <!-- end row -->
	
	
	</div> <!-- end container -->
	
	
		   <!-- Right Sidebar -->
	<div class="side-bar right-bar">
		<a href="javascript:void(0);" class="right-bar-toggle">
			<i class="mdi mdi-close-circle-outline"></i>
		</a>
		<h4 class="">Notifications</h4>
		<div class="notification-list nicescroll">
			<ul class="list-group list-no-border user-list">
				<li class="list-group-item">
					<a href="#" class="user-list-item">
						<div class="avatar">
							<img src="assets/images/users/avatar-2.jpg" alt="">
						</div>
						<div class="user-desc">
							<span class="name">Michael Zenaty</span>
							<span class="desc">There are new settings available</span>
							<span class="time">2 hours ago</span>
						</div>
					</a>
				</li>
				<li class="list-group-item">
					<a href="#" class="user-list-item">
						<div class="icon bg-info">
							<i class="mdi mdi-account"></i>
						</div>
						<div class="user-desc">
							<span class="name">New Signup</span>
							<span class="desc">There are new settings available</span>
							<span class="time">5 hours ago</span>
						</div>
					</a>
				</li>
				<li class="list-group-item">
					<a href="#" class="user-list-item">
						<div class="icon bg-pink">
							<i class="mdi mdi-comment"></i>
						</div>
						<div class="user-desc">
							<span class="name">New Message received</span>
							<span class="desc">There are new settings available</span>
							<span class="time">1 day ago</span>
						</div>
					</a>
				</li>
				<li class="list-group-item active">
					<a href="#" class="user-list-item">
						<div class="avatar">
							<img src="assets/images/users/avatar-3.jpg" alt="">
						</div>
						<div class="user-desc">
							<span class="name">James Anderson</span>
							<span class="desc">There are new settings available</span>
							<span class="time">2 days ago</span>
						</div>
					</a>
				</li>
				<li class="list-group-item active">
					<a href="#" class="user-list-item">
						<div class="icon bg-warning">
							<i class="mdi mdi-settings"></i>
						</div>
						<div class="user-desc">
							<span class="name">Settings</span>
							<span class="desc">There are new settings available</span>
							<span class="time">1 day ago</span>
						</div>
					</a>
				</li>
			
			</ul>
		</div>
	</div>
		   <!-- /Right-bar -->

</div>






</body>

</html>
