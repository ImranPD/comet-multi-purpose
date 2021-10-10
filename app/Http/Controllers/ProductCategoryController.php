<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pcat=ProductCategory::latest()->get();
        $first_cat=ProductCategory::where('parent',null)->get();

        return view('admin.product.category.index',[

            'all_pcat'  => $pcat,
            'first_cat' => $first_cat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $unique_name=$this->imageLoad( $request,'image','media/product/category/');

            ProductCategory::create([

                'name'     => $request->name,
                'slug'     => $this->getSlug($request->name),
                'icon'     => $request->icon,
                'image'    => $unique_name,
                'parent'   => (!empty($request->parent_cat) ) ? $request->parent_cat : null
            ]);

            return redirect()->route('product-category.index');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function categoryProductDelete($id){

        $delete_cat=ProductCategory::find($id);

        $parent_id=$delete_cat->parent;
        $data_id=$delete_cat->id;

        $this->findChild($data_id, $parent_id);

        if(file_exists('media/product/category/'.$delete_cat->image)){

            unlink('media/product/category/'.$delete_cat->image);

        }

        $delete_cat->delete();
        return back();

    }

    public function findChild($id,$parent){

        $pChild=ProductCategory::where('parent',$id)->get();

        foreach($pChild as $child){

            $child->parent=$parent;

            $child->update();

        }
    }
}
