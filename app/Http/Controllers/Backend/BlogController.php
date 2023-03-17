<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{


    ///////////////////////////////////////////////////////
    //
    // CRUD POST
    //
    ///////////////////////////////////////////////////////

    /**
     * all post
     */
    public function allBlogPost()
    {
        $blog_posts = BlogPost::latest()->get();

        return view('backend.blog.blog_post_all', compact('blog_posts'));
    }




    /**
     * Add post
     */
    public function addBlogPost()
    {
        return view('backend.blog.blog_post_add');
    }




    /**
     * Store post
     */
    public function storeBlogPost(Request $request)
    {
        $request->validate([
            'post_title' => ['required', 'string', 'max:170'],
            'post_long_description' => ['required', 'string', 'min:170'],
            'post_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);

        # get the image from form, rename it and and resize it
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1103, 906)->save('upload/blog/' . $name_gen);

        $save_url = 'upload/blog/' . $name_gen;

        BlogPost::insert([
            'post_title' => $request->post_title,
            'post_long_description' => $request->post_long_description,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Publication ajoutée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.post')->with($notification);
    }

    /**
     * Edit post category
     */
    public function editBlogPost($id)
    {

        $blog_post = BlogPost::findOrFail($id);

        return view('backend.blog.blog_post_edit', compact('blog_post'));
    }


    /**
     * Update post
     */
    public function updateBlogPost(Request $request)
    {
        $request->validate([
            'post_title' => ['required', 'string', 'max:170'],
            'post_long_description' => ['required', 'string', 'min:170'],
            'post_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);

        $post_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('post_image')) {

            # get the image from form, rename it and and resize it
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1103, 906)->save('upload/blog/' . $name_gen);
            $save_url = 'upload/blog/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            BlogPost::findOrFail($post_id)->update([
                'post_title' => $request->post_title,
                'post_long_description' => $request->post_long_description,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Publication mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('blog.post')->with($notification);
        } else {

            BlogPost::findOrFail($post_id)->update([
                'post_title' => $request->post_title,
                'post_long_description' => $request->post_long_description,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Publication mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('blog.post')->with($notification);
        }
    }


    /**
     * Delete post
     */
    public function deleteBlogPost($id)
    {
        $blog_post = BlogPost::findOrFail($id);
        $img = $blog_post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Publication supprimée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }














    ///////////////////////////////////////////////////////
    //
    // FRONTED BLOG ALL METHOD
    //
    ///////////////////////////////////////////////////////

    public function allBlog()
    {
        $blog_post = BlogPost::latest()->paginate(20);

        return view('fronted.blog.home_blog', compact('blog_post'));
    }

    public function blogDetails($id, $slug)
    {
        $blog_details = BlogPost::findOrFail($id);

        return view('fronted.blog.blog_details', compact('blog_details'));
    }
}
