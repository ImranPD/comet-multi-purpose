<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data=Post::where('trash',false)->get();
        $published=Post::where('trash',false)->get()->count();
        $trash=Post::where('trash',true)->get()->count();

        return view('admin.post.index',[

            'all_data'   => $all_data,
            'published'  => $published,
            'trash'      =>  $trash
        ]);
    }

    /**
     * post trash
     *
     */


    public function postTrash()
    {
        $all_data=Post::where('trash',true)->get();
        $published=Post::where('trash',false)->get()->count();
        $trash=Post::where('trash',true)->get()->count();
        return view('admin.post.trash',[

            'all_data'   => $all_data,
            'published'  => $published,
            'trash'      =>  $trash
        ]);
    }


    /**
     * post trash update
     *
     */

    public function postTrashUpdate($id)
    {
        $trash_update=Post::find($id);

        if($trash_update->trash==false){

            $trash_update->trash=true;

        }else{

            $trash_update->trash=false;


        }

        $trash_update->update();

        return redirect()->back();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()


    {
        $all_tag=Tag::all();
        $all_cat=Category::all();
        return view('admin.post.create',[
            'all_tag' => $all_tag,
            'all_cat' => $all_cat
        ]);
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

            'title'    => 'required',
            'content'  => 'required',
        ]);


        $unique_image_name='';

        if($request->hasFile('image')){

            $image_file=$request->file('image');

            $unique_image_name=md5(time().rand()).'.'.$image_file->getClientOriginalExtension();

            $image_file->move(public_path('media/post/'),$unique_image_name);




        }

        $gall_name=[];

        if($request->hasFile('image_gall') ){

            foreach($request->file('image_gall') as $ima_gall){

                $unique_gall_name=md5(time().rand()).'.'.$ima_gall->getClientOriginalExtension();

                $ima_gall->move(public_path('media/post/'),$unique_gall_name);

                array_push($gall_name, $unique_gall_name);

            }

        }




        $post_featured=[

            'post_type'     => $request->post_type,
            'post_image'    => $unique_image_name,
            'post_gallery'  => $gall_name,
            'post_video'    => $this->getEmbed($request->video),
            'post_audio'    => $request->audio
        ];

        $post_data=Post::create([

            'title'          => $request->title,
            'user_id'        => Auth::user()->id,
            'slug'           => $this->getSlug($request->title),
            'featured'       =>json_encode($post_featured),
            'content'        => $request->content,
        ]);

        $post_data->categories()->attach($request->post_cat);
        $post_data->tags()->attach($request->post_tag);

        return redirect()->route('post.index')->with('success','Post added successful');
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
        $cat=Category::all();
        $tag=Tag::all();
        $edit_post=Post::find($id);

        return view('admin.post.edit',[

            'all_cat'  =>  $cat,
            'all_tag'  =>  $tag,
            'edit_post'  =>   $edit_post
        ]);
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
        $delete_post=Post::find($id);

        $delete_post->delete();

        return redirect()->back()->with('success','post deleted successful');
    }

    /**
     *  post status inactive
     */


    public function statusInactive($id){

        $update_status=Post::find($id);

        $update_status->status=false;
        $update_status->update();

    }
    /**
     *
     * post status active
     *
     */

    public function stausActive($id){

        $staus_update=Post::find($id);

        $staus_update->status=true;
        $staus_update->update();
    }
}
