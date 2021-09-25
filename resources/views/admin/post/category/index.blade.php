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
									<li class="breadcrumb-item active">Category</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->



                    <div class="row">
                        <div class="col-lg-12">
                            @include('validate')
                            <a class="btn btn-primary mb-2" data-toggle="modal" href="#add_category_modal">Add New category</a>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Category</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table mb-0 text-center">
											<thead>
												<tr>
													<th>#</th>
													<th>Category Name</th>
													<th>Category slug</th>
													<th>time</th>
													<th>published on</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                              @foreach ($all_data as $data)


												<tr>
													<td>{{ $loop->index+1 }}</td>
													<td>{{ $data->name }}</td>
													<td>{{ $data->slug }}</td>
													<td>{{ $data->updated_at->diffForHumans() }}</td>
													<td>
                                                        <div class="status-toggle">
															<input type="checkbox" status_id="{{ $data->id }}" {{ ($data->status==true ? 'checked="checked"': '') }} id="cat_status_{{$loop->index+1}}" class="check cat_status">
															<label for="cat_status_{{$loop->index+1}}" class="checktoggle">checkbox</label>
														</div>
                                                    </td>
													<td>
                                                        {{--  <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>  --}}
                                                        <a id="edit_id" class="btn btn-secondary btn-sm" edit_id="{{ $data->id }}" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                        <form class="d-inline" action="{{ route('category.destroy',$data->id )}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button id="delete_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

        <!--Add category Modal-->

            <div id="add_category_modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h2>Add new category</h2>
                            <form action="{{ route('category.store') }}" method="POST">
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

        <!--/Add category Modal-->

        <!--Edit category Modal-->

        <div id="edit_category_modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h2>Update category</h2>
                        <form action="{{ route('category.update',$data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input name="name" class="form-control" type="text">
                                <input name="cat_edit_id" class="form-control" type="hidden">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary " type="submit" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!--/Edit category Modal-->


@endsection
