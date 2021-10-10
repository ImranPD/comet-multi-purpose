@extends('admin.layouts.app')


@section('main-content')


<!-- Main Wrapper -->
        <div class="main-wrapper">



            @include('admin.layouts.header')

            @include('admin.layouts.menu')




			<!-- Page Wrapper -->
            <div class="page-wrapper">

                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome {{ Auth::user()->name }} </h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Brand</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->



                    <div class="row">
                        <div class="col-lg-12">
                            @include('validate')
                            <a class="btn btn-primary mb-2" data-toggle="modal" href="#add_brand_modal">Add New brand</a>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Brand</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="brand-table" class="table mb-0 text-center">
											<thead>
												<tr>
													<th>#</th>
													<th>Brand Name</th>
													<th>Brand slug</th>
													<th>Logo</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>





										</table>
									</div>
								</div>
							</div>
						</div>
                    </div>









				</div>
			</div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

        <!--Add brand Modal-->

            <div id="add_brand_modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h2>Add new category</h2>
                            <form id="add_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input name="name" class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="Name">Logo</label>
                                    <input name="logo" class="form-control-file" type="file">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary " type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <!--/Add brand Modal-->

        <!--Edit brand Modal-->

        <div id="edit_brand_modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h2>Update category</h2>
                        <form id="edit_forrm" form_no="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input name="name" class="form-control" type="text">
                                <input name="edit_id" class="form-control" type="hidden">
                            </div>
                            <div class="form-group">

                                <label  for="Name">Photo</label>
                                <img id="brand_photo" style="width: 120px;height:120px;display:block; margin-bottom:10px;" src="" alt="">
                                <input name="new_photo" class="form-control" type="file">
                                <input name="old_photo" class="form-control" type="hidden">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary " type="submit" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!--/Edit brand Modal-->


@endsection
