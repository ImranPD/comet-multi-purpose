<?php

namespace App\Http\Controllers;

use App\Models\Prodcttag;
use Illuminate\Http\Request;

class ProdcttagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Prodcttag::latest()->get();

        return view('admin.product.tag.index',[

            'all_data' => $data
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

        Prodcttag::create([

            'name'  => $request->name,
            'slug'  => $this->getSlug($request->name),
        ]);

        return back()->with('success','product tag added successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodcttag  $prodcttag
     * @return \Illuminate\Http\Response
     */
    public function show(Prodcttag $prodcttag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodcttag  $prodcttag
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodcttag $prodcttag)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodcttag  $prodcttag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodcttag  $prodcttag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data=Prodcttag::find($id);

        $delete_data->delete();

        return back()->with('success','tag deleted successful');
    }

    /**
     * product tag inactive
     */

     public function ptagInctive($id){

        $update_data=Prodcttag::find($id);

        if( $update_data->status==true){

            $update_data->status=false;

        }else{

            $update_data->status=true;

        }

        $update_data->update();

     }

      /**
     * product tag active
     */

    public function ptagActive($id){

        $update_data=Prodcttag::find($id);

        if( $update_data->status==false){

            $update_data->status=true;

        }else{

            $update_data->status=false;

        }

        $update_data->update();

     }

     /**
      * product tag edit
      */

      public function ptagEdit($id)

      {

        $edit_data=Prodcttag::find($id);

        return [

            'id'     =>$edit_data->id,
            'name'   =>$edit_data->name,
            'slug'   =>$edit_data->slug,
        ];

      }


      public function ptagupdate(Request $request,$id)
      {
        $update_data=Prodcttag::find( $id);

        $update_data->name=$request->name;
        $update_data->slug=$this->getSlug($request->name);
        $update_data->update();

        return back()->with('success','tag updated successful');
      }
}
