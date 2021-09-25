<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function ShowBlogPage()

    {
        $all_posts=Post::where('status',true)->where('trash',false)->latest()->paginate(2);
        return view('comet.blog',[

            'all_posts' => $all_posts
        ]);
    }

    //blog search

    public function ShowBlogSearch(Request $request){

        $search=$request->search;

        $posts=Post::where('title','LIKE','%'.$search.'%')->orWhere('content','LIKE','%'.$search.'%')->latest()->paginate();
        return view('comet.blog-search',[

            'all_posts' => $posts

        ]);
    }


    //category blog post search
    public function ShowCatBlogSearch($slug){

        $cat=Category::where('slug',$slug)->latest()->first();

        return view('comet.category-blog',[

            'all_posts' => $cat->posts
        ]);

    }


    //Tag blog post search

     public function ShowTagBlogSearch($slug){

        $tag=Tag::where('slug',$slug)->first();

        return view('comet.tag-blog',[

            'all_posts' => $tag->posts
        ]);

    }

    //blog single

    public function BlogSingle($slug){

    $all_posts=Post::where('slug',$slug)->first();

    $this->viewount( $all_posts->id);

        return view('comet.blog-single',compact('all_posts'));

    }

    //post view count
    private function viewount($post_id){

        $post_view_count=Post::find($post_id);

        $old_view=$post_view_count->views;
        $post_view_count->views= $old_view+1;
        $post_view_count->update();
    }


}
