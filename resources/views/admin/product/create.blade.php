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
									<li class="breadcrumb-item active">Product</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Information</h4>
                                    </div>
                                    <div class="card-body">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input name="name" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input name="price" type="number" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input name="quantity" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Sale price</label>
                                                <input name="sale_price" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="desc" id="" ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea class="form-control" name="short_desc" id="" ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <input type="checkbox" value="trend" id="trend"><label for="trend"> Make it trend </label>
                                            </div>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Images</h4>
                                    </div>


                                    <div class="card-body">

                                    <label for="">Featured Images</label>
                                        <input name="image" class="form-control-file" type="file" multiple>

                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Save</button>

                            </div>





                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product category</h4>
                                    </div>



                                    <div class="card-body class-list">

                                        <ul>
                                            @foreach ($all_cat as $cat1)

                                            <li>
                                                <input type="checkbox" name="pcat[]" value="{{ $cat1->id }}" id="{{ $cat1->id }}"><label for="{{ $cat1->id }}">{{ $cat1->name }}</label>

                                                <ul>
                                                    @foreach ( $cat1 -> getChild as $cat2)

                                                    <li>
                                                        <input type="checkbox" value="{{ $cat2->id }}" id="{{ $cat2->id }}"><label for="{{ $cat2->id }}">{{ $cat2->name }}</label>

                                                        <ul>
                                                            @foreach ( $cat2 -> getChild as $cat3)

                                                            <li>
                                                                <input type="checkbox" value="{{ $cat3->id }}" id="{{ $cat3->id }}"><label for="{{ $cat3->id }}">{{ $cat3->name }}</label>

                                                                <ul>
                                                                    @foreach ( $cat3 -> getChild as $cat4)

                                                                    <li>
                                                                        <input type="checkbox" value="{{ $cat4->id }}" id="{{ $cat4->id }}"><label for="{{ $cat4->id }}">{{ $cat4->name }}</label>

                                                                        <ul>
                                                                            @foreach ( $cat4 -> getChild as $cat5)

                                                                            <li>
                                                                                <input type="checkbox" value="{{ $cat5->id }}" id="{{ $cat5->id }}"><label for="{{ $cat5->id }}">{{ $cat5->name }}</label>
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

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Tags</h4>
                                    </div>


                                    <div class="card-body">

                                        <label for="">Select tags</label>

                                        <select style="width: 100%" name="ptag[]" class="post_select" multiple="multiple">
                                            @foreach ($all_tag as $tag)


                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>

                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Brand</h4>
                                    </div>


                                    <div class="card-body">

                                        <label for="">Select Brand</label>

                                        <select  name="brand" class="form-control">
                                            <option value="">-select-</option>
                                            @foreach ($all_brand as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>

                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                    <input id="pvarBox" value="variable" type="checkbox"><label for="pvarBox">Variable Options</label>
                                    <div class="var-box">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Product Size</h4>
                                            </div>


                                            <div class="card-body">

                                            <a id="psize_btn" class="btn btn-primary" href="">Add Size</a>

                                            <div id="sizeBox" class="size-box">

                                            </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Product color</h4>
                                            </div>


                                            <div class="card-body">

                                            <a id="pcolor_btn" class="btn btn-primary" href="">Add color</a>

                                            <div id="colorBox" class="size-box">

                                            </div>

                                            </div>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </form>







                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

				</div>
			</div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

<br>
<br>
<br>
<br>
<br>
<br>



@endsection
