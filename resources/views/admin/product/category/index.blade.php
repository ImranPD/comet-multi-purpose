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
									<li class="breadcrumb-item active">Product Category</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->




                    <div class="row">
						<div class="col-md-5">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add new Category</h4>
								</div>
								<div class="card-body">
									<form action="{{ route('product-category.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
										<div class="row">

											<div class="col-md-12">

												<div class="form-group">
													<label>Name</label>
													<input name="name" type="text" class="form-control">
												</div>

												<div class="form-group">
													<label>Icon</label>
													<input name="icon" type="text" class="form-control">
												</div>

                                                <div class="form-group">
													<label>Image</label>
													<input name="image" type="file" class="form-control-file">
												</div>

												<div class="form-group">
													<label>Parent Category</label>
													<select name="parent_cat" class="form-control">
														<option value="">Select</option>
                                                        @foreach ($all_pcat as $pcat)

                                                        <option value="{{ $pcat->id }}">{{ $pcat->name }}</option>

                                                        @endforeach

												</div>

                                                <div class="form-group">
													<input value="Add" class="btn btn-primary btn-sm float-right mt-3" type="submit" class="form-control">
												</div>

											</div>

										</div>

									</form>
								</div>
							</div>
						</div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Category Structure</h4>
                                </div>
                                <div class="card-body">

                                    <ul class="parenMain">

                                        @foreach ( $first_cat as $cat1)

                                            <li>{{ $cat1->name }} <div class="editDel">
                                                                    <a id="pcat_edit" edit_id="{{ $cat1->id }}" href="">Edit</a>
                                                                    <a href="{{ route('Pcat.delete',$cat1->id) }}">delete</a>
                                                                 </div>

                                               <ul>
                                                @foreach ($cat1->getChild as $cat2)

                                                    <li>{{ $cat2->name }}<div class="editDel">
                                                                            <a id="pcat_edit" edit_id="{{ $cat2->id }} href="">Edit</a>
                                                                            <a href="{{ route('Pcat.delete',$cat2->id) }}">delete</a>
                                                                        </div>

                                                        <ul>
                                                            @foreach ($cat2->getChild as $cat3)

                                                                <li>{{ $cat3->name }}<div class="editDel">
                                                                                        <a id="pcat_edit" edit_id="{{ $cat3->id }} href="">Edit</a>
                                                                                        <a href="{{ route('Pcat.delete',$cat3->id) }}">delete</a>
                                                                                    </div>

                                                                    <ul>
                                                                        @foreach ($cat3->getChild as $cat4)

                                                                            <li>{{ $cat4->name }}<div class="editDel">
                                                                                                    <a id="pcat_edit" edit_id="{{ $cat4->id }} href="">Edit</a>
                                                                                                    <a href="{{ route('Pcat.delete',$cat4->id) }}">delete</a>
                                                                                                </div>

                                                                                <ul>
                                                                                    @foreach ($cat4->getChild as $cat5)

                                                                                        <li>{{ $cat5->name }}
                                                                                            <div class="editDel">
                                                                                                <a id="pcat_edit" edit_id="{{ $cat5->id }} href="">Edit</a>
                                                                                                <a href="{{ route('Pcat.delete',$cat5->id) }}">delete</a>
                                                                                             </div>
                                                                                        </li>

                                                                                     @endforeach
                                                                                </ul>

                                                                            </li>

                                                                         @endforeach
                                                                    </ul>

                                                                </li>

                                                             @endforeach
                                                        </ul>



                                                    </li>

                                                 @endforeach
                                               </ul>
                                            </li>

                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
					</div>






















				</div>
			</div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->


        <!--Edit product category Modal-->

        <div id="edit_pcat_modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h2>Update category</h2>
                        <form id="pcat_edit_form" action="{{ route('Pcat.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input name="name" class="form-control" type="text">
                                <input name="edit_id" class="form-control" type="hidden">
                            </div>

                            <div class="form-group">
                                <label for="Name">Icon</label>
                                <input name="icon" class="form-control" type="text">
                            </div>
                            <div class="form-group">

                                <label  for="Name">Photo</label>
                                <img id="pcat_photo" style="width: 120px;height:120px;display:block; margin-bottom:10px;" src="" alt="">
                                <input name="new_photo" class="form-control" type="file">
                                <input name="old_photo" class="form-control" type="hidden">
                            </div>

                            <div class="form-group">

                                <label>Parent Category</label>

                                <select name="parent_cat" class="form-control">


                            </div>
                            <div class="form-group ">
                                <input class="btn btn-primary mt-3" type="submit" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!--/Edit product category Modal-->



@endsection
