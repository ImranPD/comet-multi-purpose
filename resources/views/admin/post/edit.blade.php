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
									<li class="breadcrumb-item active">Post Edit</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->


                    <div class="row">
						<div class="col-lg-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h4 class="card-title">Edit Post</h4>
								</div>

								<div class="card-body">

                                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
										<div class="form-group row">
											<label  class="col-lg-3 col-form-label">Post Format</label>
											<div class="col-lg-9">
												<select class="form-control" name="post_type" id="post_format">
                                                    <option value="">--select--</option>
                                                    <option value="Image">Image</option>
                                                    <option value="Gallery">Gallery</option>
                                                    <option value="Audio">Audio</option>
                                                    <option value="Video">Video</option>
                                                </select>
											</div>
										</div>

									<form action="#">
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Post Title</label>
											<div class="col-lg-9">
												<input name="title" value="{{ $edit_post->title }}" type="text" class="form-control">
											</div>
										</div>


                                        <div class="form-group row">
											<label class="col-form-label col-md-3">Category</label>
											<div class="col-md-9">
                                                @php
                                                    $edit_cat_show=[];

                                                    foreach ($edit_post->categories as $edit_cat){

                                                    array_push($edit_cat_show,$edit_cat->slug);

                                                    }

                                                @endphp
                                                @foreach( $all_cat as $cat)
												<div class="checkbox">
													<label>
														<input type="checkbox"  @if(in_array( $cat->slug,$edit_cat_show)) checked  @endif value="{{ $cat->id}}" name="post_cat[]"> {{ $cat->name }}
													</label>
												</div>
                                                @endforeach


											</div>
										</div>






										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Tags</label>
											<div class="col-lg-9">
												<select style="width: 100%" name="post_tag[]" class="post_select" multiple="multiple">

                                                    @php
                                                        $all_tag_array=[];

                                                        foreach($edit_post->tags as $tag_slug){

                                                            array_push($all_tag_array,$tag_slug->slug);

                                                        }
                                                    @endphp

                                                    @foreach ($all_tag as $tag)

                                                    <option   value="{{ $tag->id }}" @if(in_array($tag->slug,$all_tag_array)) selected @endif> {{ $tag->name }} </option>

                                                    @endforeach
                                                </select>
											</div>
										</div>

                                        <div class="post_image">

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Post Image</label>
                                                <div class="col-lg-9">
                                                    <img style="width:200px" class="post_image_load d-block mb-2" src="" alt="">
                                                    <label for="post_image_select"><img style="width:80px;cursor: pointer;" src="{{ URL::to('admin/assets/img/image.png') }}" alt=""></label>
                                                    <input name="image" id="post_image_select" type="file" style="display: none">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="gall_image">

                                            <div class="form-group row ">
                                                <label class="col-lg-3 col-form-label">Gallery Image</label>
                                                <div class="col-lg-9">
                                                    <div class="post_img_gall">

                                                    </div>
                                                    <label for="post_image_select_g"><img style="width:80px;cursor: pointer;" src="{{ URL::to('admin/assets/img/image.png') }}" alt=""></label>
                                                    <input name="image_gall[]" id="post_image_select_g" type="file" style="display: none" multiple>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="post_audio">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Post Audio Link</label>
                                                    <div class="col-lg-9">
                                                        <input name="audio" type="text" class="form-control">
                                                    </div>
                                                </div>

                                        </div>

                                            <div class="post_video">

                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Post Video Link</label>
                                                    <div class="col-lg-9">
                                                        <input name="video" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>



                                        <div class="form-group row">
											<label class="col-lg-3 col-form-label">Content</label>
											<div class="col-lg-9">
												<textarea name="content" id="post_text" >{{ $edit_post->content }}</textarea>
											</div>
										</div>



										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
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
