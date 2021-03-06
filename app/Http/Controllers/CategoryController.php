<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()


    {
        // $data=Category::all();

        // return view('admin.post.category.index',[

        //     'all_data' =>  $data
        // ]);

            if(request()->ajax()){

                return datatables()->of(Category::latest()->get())->addColumn('action',function($data){

                    $btn='<a class="btn btn-sm btn-secondary" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                    $btn .='<a class="btn btn-sm btn-danger ml-1" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';

                    return  $btn;

                })->addColumn('stat',function($data){

                    $stat_check='<div class="status-toggle">';
                    $stat_check.='<input type="checkbox" status_id="'.$data->id.'"  '.($data->status==1 ? "checked=\'checked\'" :"").'   id="cat_status_'.$data->id.'" class="check cat_status">';
                    $stat_check.='<label for="cat_status_'.$data->id.'" class="checktoggle">checkbox</label>';
                    $stat_check.='</div>';

                    return $stat_check;

                })->rawColumns(['action','stat'])->make(true);
            }
                return view('admin.post.category.index');
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
        $this->validate($request,[

            'name'   => 'required'
        ]);

        Category::create([

            'name' => $request->name,
            'slug' => $this->getSlug($request->name),
        ]);

        return redirect()->route('category.index')->with('success','category added successful');
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
        $show_category=Category::find($id);

        return [

            'id'   =>  $show_category->id,
            'name' =>  $show_category->name
        ];
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
        $editId = $request ->cat_edit_id;

        $update_cat=Category::find($editId);

        $update_cat-> name = $request->name;
        $update_cat-> slug = Str::slug($request->name);
        $update_cat-> update();
        return redirect()->route('category.index')->with('success','category added successful');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_cat=Category::find($id);

        $delete_cat->delete();

        return redirect()->back()->with('success','category deleted successfully');
    }



    /**
     *  status inactive
     */

     public function statusUpdateInactive($id){

        $status_update=Category::find($id);

        $status_update->status=false;
        $status_update->update();

     }

      /**
     *  status active
     */

    public function statusUpdateActive($id){


        $status_update=Category::find($id);

        $status_update-> status=true;

        $status_update-> update();

     }
}
