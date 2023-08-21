<?php

namespace App\Http\Controllers;

use App\Events\PostAdded;
use App\Http\Requests\PostRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // validate request
        \request()->validate([
            'perPage' => 'integer|min:1|max:100',
            'page' => 'integer|min:1'
        ]);

        // results per page
        $perPage = htmlspecialchars(stripslashes(trim(request()->get('perPage')))) ?? 10;

        // get page
        $currentPage = htmlspecialchars(stripslashes(trim(request()->get('page')))) ?? 1;

        // list all posts
        $posts = Posts::with('subscriptionWebsite')
            ->paginate($perPage, ['*'], 'page', $currentPage);

        // return response
        return response()->json([
            "success" => true,
            "message" => "Posts retrieved successfully.",
            "data" => $posts
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // validate request
        $validated = $request->validated();

        $validated['created_by'] = auth()->user()->id;

        // create
        $post = Posts::create($validated);

        if ($post){
            // notify of post addition
            event(new PostAdded($post->id));

            $post->load('subscriptionWebsite');
            // return response
            return response()->json([
                "success" => true,
                "message" => "Posts created successfully.",
                "data" => $post
            ],201);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to create Posts.",
                "data" => []
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $posts)
    {
        // show post details
        $posts->load('subscriptionWebsite');
        return response()->json([
            "success" => true,
            "message" => "Posts retrieved successfully.",
            "data" => $posts
        ],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
        // check if it has any active susbcription
        if ($posts->subscriptionWebsite()->count() > 0){
            return response()->json([
                "success" => false,
                "message" => "Posts has active subscription cannot be deleted.",
                "data" => []
            ],500);
        }

        // delete post request
        if ($posts->delete()){
            return response()->json([
                "success" => true,
                "message" => "Posts deleted successfully.",
                "data" => []
            ],200);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Failed to delete Posts.",
                "data" => []
            ],500);
        }
    }
}
