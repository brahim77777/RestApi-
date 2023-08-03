<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lesson as ResourcesLesson;
use App\Models\Lesson;
use Illuminate\Http\Request;
use ResourceBundle;

class LessonController extends Controller
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

        return ResourcesLesson::collection(Lesson::paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create' , Lesson::class);
        return new ResourcesLesson(Lesson::create($request->all()));

    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
        return new ResourcesLesson($lesson);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
        $this->authorize('update',$lesson);
        $lesson->update($request->all());
        return new ResourcesLesson($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $this->authorize('delete', $lesson);
        $lesson->delete();
        return 204;
    }
}
