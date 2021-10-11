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
									<li class="breadcrumb-item active">Product Tag</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->



                    <div class="row">
                        <div class="col-lg-12">
                            @include('validate')
                            <a class="btn btn-primary mb-2" data-toggle="modal" href="#add_ptag_modal">Add New Tag</a>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Tag</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table mb-0 text-center">
											<thead>
												<tr>
													<th>#</th>
													<th>Tag Name</th>
													<th>Tag slug</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>

                                            <tbody>
                                                @foreach ($all_data as $data)
                                                <tr>




                                                        <td>{{ $loop-> index+1 }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->slug }}</td>
                                                        <td>
                                                            <div class="status-toggle " style="display: flex;justify-content:center;">
                                                                <input type="checkbox" status_id="{{ $data->id }}"  {{ ($data->status==true) ? 'checked="checked"': '' }} id="ptag_status_{{ $data->id }}" class="check ptag_status">
                                                                <label for="ptag_status_{{ $data->id }}" class="checktoggle">checkbox</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a id="edit" class="btn btn-secondary btn-sm" edit_id="{{ $data->id }}" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                            <form class="d-inline" action="{{ route('product-tag.destroy',$data->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </form>
                                                        </td>


                                                </tr>

                                                @endforeach
                                            </tbody>



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

            <div id="add_ptag_modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h2>Add new Tag</h2>
                            <form  action="{{ route('product-tag.store') }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input name="name" class="form-control" type="text">
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

        <div id="edit_ptag_modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h2>Update Tag</h2>
                        <form id="edit_ptag_form" action="{{ route('product.tag.edit',$data->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input name="name" class="form-control" type="text">
                                <input name="edit_id" class="form-control" type="hidden">
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
