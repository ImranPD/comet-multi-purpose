<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()-> ajax()){

            return datatables()->of(Tag::latest()->get())->addColumn('action',function($data){

                $btn='<a class="btn btn-sm btn-primary" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                $btn.='<a class="btn btn-sm btn-danger ml-1" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';

                return  $btn;

            })->addColumn('stat',function($data){

                $sta='<div class="status-toggle">';
                $sta.='<input type="checkbox" '.($data->status==1 ? "checked=\'checked\'" : "").' tag_staus="'.$data->id.'"   id="tag_status_'.$data->id.'" class="check tag_status">';
                $sta.='<label for="tag_status_'.$data->id.'" class="checktoggle">checkbox</label>';
                $sta.='</div>';

                return $sta;

            })->rawColumns(['action','stat'])->make(true);

        }
        return view('admin.post.tag.index');
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

            'name' => 'required'
        ]);

        Tag::create([

            'name' => $request->name,
            'slug' =>$this->getSlug($request->name)
        ]);

        return redirect()->route('tag.index')->with('success','Tag added successfully');
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
        $tag_edit=Tag::find($id);

        return [

            'id'    => $tag_edit->id,
            'name'  => $tag_edit->name
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
        $tag_id=$request->tag_edit_id;

        $tag_update=Tag::find($tag_id);
        $tag_update->name=$request->name;
        $tag_update->slug=Str::slug($request->name);
        $tag_update->update();

        return redirect()->route('tag.index')->with('success','Tag updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag_del=Tag::find($id);
        $tag_del->delete();

        return redirect()->back()->with('success','Tag deleted successfull');
    }

    /**
     *  tag status inactive
     */

     public function statusUpdateInactive($id){

        $status_update=Tag::find($id);

        $status_update->status=false;
        $status_update->update();


     }

     public function statusUpdateActive($id){

        $status_update=Tag::find($id);

        $status_update->status=true;
        $status_update->update();


     }
}
