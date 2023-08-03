<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag as ResourcesTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index' , 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $limit = $request->input('limit') <= 50 ?$request->input('limit'):15;

        return ResourcesTag::collection(Tag::paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create' , Tag::class);
        return new ResourcesTag(Tag::create($request->all()));

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return new ResourcesTag($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $this->authorize('update', $tag );
        $tag->update($request->all());
        return new ResourcesTag($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
        $this->authorize('delete', $tag );

        $tag->delete();
        return 204;
    }
}
