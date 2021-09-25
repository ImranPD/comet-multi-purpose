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
									<li class="breadcrumb-item active">Tag</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->



                    <div class="row">
                        <div class="col-lg-12">
                            @include('validate')
                            <a class="btn btn-primary mb-2" data-toggle="modal" href="#add_tag_modal">Add New Tag</a>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Tags</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table mb-0 text-center">
											<thead>
												<tr>
													<th>#</th>
													<th>Tag Name</th>
													<th>Tag Slug</th>
													<th>Time</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>

                                                @foreach ($all_tag as $data )
                                                    
                                                
												<tr>
													<td>{{ $loop->index+1 }}</td>
													<td>{{ $data->name }}</td>
													<td>{{ $data->slug }}</td>
													<td>{{ $data->updated_at->diffForHumans() }}</td>
													<td>
                                                        <div class="status-toggle">
															<input type="checkbox" tag_staus="{{ $data->id }}" {{ ($data->status==true ? 'checked="checked"' : '') }}  id="tag_status_{{$loop->index+1}}" class="check tag_status">
															<label for="tag_status_{{$loop->index+1}}" class="checktoggle">checkbox</label>
														</div>
                                                    </td>
													<td>
                                                        {{--  <a class="btn btn-primary btn-sm" href="#">View</a>  --}}
                                                        <a id="edit_id" edit_tag="{{ $data->id }}" class="btn btn-secondary btn-sm" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <form class="d-inline" id="tag_delete" action="{{ route('tag.destroy',$data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="tag_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
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


        <!--Add Tag Modal-->

        <div id="add_tag_modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h2>Add new Tag</h2>
                        <form action="{{ route('tag.store') }}" method="POST">
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

    <!--/Add Tag Modal-->

    <!--Edit Tag Modal-->

    <div id="edit_tag_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2>Update Tag</h2>
                    <form action="{{ route('tag.update',$data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input name="name" class="form-control" type="text">
                            <input name="tag_edit_id" class="form-control" type="hidden">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary " type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--/Edit Tag Modal-->


@endsection
