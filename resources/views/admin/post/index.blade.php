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
									<li class="breadcrumb-item active">Post</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->



                    <div class="row">
                        <div class="col-lg-12">
                            @include('validate')
                            <a class="btn btn-primary mb-2" href="{{ route('post.create') }}">Add new post</a>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Posts(published)</h4>
									<a class="badge badge-primary" href="{{route('post.index')}}">published {{($published==0 ? '' : $published)}}</a>
									<a class="badge badge-danger" href="{{route('post.trash')}}">Trash {{ $trash==0 ? '' : $trash}}</a>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="dataTabs" class="table mb-0 text-center">
											<thead>


												<tr>
													<th>#</th>
													<th>Post title</th>
													<th>Author</th>
													<th>Post type</th>
													<th>Post Category</th>
													<th>Post Tag</th>
													<th>Date</th>
													<th>status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>

											@foreach($all_data as $data)

											   @php
											   $featured=json_decode($data->featured);
											   @endphp
												<tr>
													<td>{{$loop-> index+1}}</td>
													<td>{{$data->title}}</td>
                                                    <td>{{$data->user->name}}</td>
													<td>{{$featured->post_type}}</td>
													<td>
                                                        <ol>
                                                        @foreach ($data->categories as $cat )

                                                        <li>{{ $cat->name }}</li>

                                                        @endforeach
                                                        </ol>
                                                    </td>
													<td>

                                                        <Ol>
                                                            @foreach ($data->tags as $tag)
                                                                <li>{{ $tag->name }}</li>
                                                            @endforeach
                                                        </Ol>


                                                    </td>
													<td>{{$data->updated_at->diffForHumans()}}</td>
													<td>

													    <div class="status-toggle">
															<input type="checkbox" status_id="{{$data->id}}"  {{($data->status==true ? 'checked ="checked"' : '')}}  id="post_status_{{$loop->index+1}}" class="check post_status">
															<label for="post_status_{{$loop->index+1}}" class="checktoggle">checkbox</label>
														</div>

													</td>
													<td>
                                                        {{--  <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>  --}}
                                                        <a edit="{{ $data->id }}" class="btn btn-secondary btn-sm" href="{{ route('post.edit',$data->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <a class="btn btn-danger btn-sm" href="{{route('post.trash.update',$data->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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




@endsection
