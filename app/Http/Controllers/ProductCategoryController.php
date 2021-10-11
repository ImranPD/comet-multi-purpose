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

    public function categoryProductEdit($id){

        $pcat_edit=ProductCategory::find($id);
        $cat_select=ProductCategory::all();

        $cat_list='<option value="">-selected-</option>';





        foreach($cat_select as $cat){

            $selected='';

            if($cat->id==$pcat_edit->parent){

                $selected='selected="selected"';
            }

            $cat_list.="<option {$selected} value=\"{$cat->id}\">{$cat->name}</option>";

        }


        return [

            'id'         =>$pcat_edit->id,
            'name'       =>$pcat_edit->name,
            'icon'       =>$pcat_edit->icon,
            'image'      =>$pcat_edit->image,
            'parent'     =>$pcat_edit->parent,
            'cat_list'   => $cat_list

        ];

    }

    public function categoryProductUpdate(Request $request)
    {

        $unique_name=$request->old_photo;

        if( $request->hasFile('new_photo')){

            $unique_name=$this->imageLoad( $request,'new_photo','media/product/category/');

            if(file_exists('media/product/category/'.$request->old_photo)){

                unlink('media/product/category/'.$request->old_photo);

            }

        }else{

            $unique_name=$request->old_photo;
        }



        $update_data=ProductCategory::find($request->edit_id);

        $this->findChild($update_data->id,$update_data->parent);

        $update_data->name   =$request->name;
        $update_data->slug   =$this->getSlug($request->name);
        $update_data->icon   =$request->icon;
        $update_data->image  = $unique_name;
        $update_data->parent = $request->parent_cat;
        $update_data->update();

        return back();
    }
}
