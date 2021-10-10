<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Brand;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        if(request()->ajax() ){

            return datatables()->of(Brand::latest()->get())->addColumn('action',function($data){

                $action ='<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                $action.='<a edit_id="'.$data['id'].'" class="btn btn-secondary btn-sm ml-1 edit_btn" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                $action.='<a del_id="'.$data['id'].'" class="btn btn-danger btn-sm ml-1 del_btn" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';

                return $action;

            })->addColumn('stat',function($data){

                $stat_check='<div class="status-toggle" style="display:flex;justify-content:center;">';
                $stat_check.='<input type="checkbox" status_id="'.$data->id.'"  '.($data->status ==1 ? "checked=\'checked\'" :"").'   id="brand_status_'.$data->id.'" class="check brand_status">';
                $stat_check.='<label for="brand_status_'.$data->id.'" class="checktoggle">checkbox</label>';
                $stat_check.='</div>';

                return $stat_check;


            })->rawColumns(['action','stat'])->make(true);

        }

        return view('admin.product.brand.index');
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
        $file_name='';

        if( $request->hasFile('logo') ){

            $file=$request->file('logo');

            $file_name=md5(time().rand()).'.'. $file->getClientOriginalExtension();

            $file->move(public_path('media/product/brand/'),$file_name);


        }
        Brand::create([

            'name'  => $request->name,
            'slug'  => $this->getSlug($request->name),
            'logo'  =>  $file_name,
        ]);

        return "Brand Add Successful";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {

        $unique_name=$request->old_photo;

        if( $request->hasFile('new_photo') ){

            $file = $request-> file('new_photo');

            $unique_name=md5(time().rand()).'.'.$file->getClientOriginalExtension();

            $file->move(public_path('media/product/brand/'),$unique_name);

            if(file_exists('media/product/brand/'.$request->old_photo)){

                unlink('media/product/brand/'.$request->old_photo);

            }else{
                $unique_name=$request->old_photo;
            }

        }

        $brand->name=$request->name;
        $brand->slug=$this->getSlug($request->name);
        $brand->logo= $unique_name;
        $brand->update();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }


    //brand status update

    public function brandStatusInactive($id){

        $statusUpdate=Brand::find($id);

            $statusUpdate->status=false;

            $statusUpdate->update();

    }

    public function brandStatusActive($id){

        $statusUpdate=Brand::find($id);

            $statusUpdate->status=true;

            $statusUpdate->update();

    }

    /**
     * brand delete
     */

     public function brandDelete($id)

     {

        try {

            $delete_brand=Brand::find($id);

            $logo=$delete_brand->logo;
            $delete_name=$delete_brand->name;

            $delete_brand->delete();

            if(file_exists('media/product/brand/' .$logo)){

                unlink('media/product/brand/' .$logo);

            }

            return "The brand ". $delete_name . " is delete successfully";

        } catch (Exception $err) {

            return " Failed to delete";

        }

     }

     /**
      * brand edit
      */

      public function brandEdit($id){

        $edit_id=Brand::find($id);

        return $edit_id;

      }
}
