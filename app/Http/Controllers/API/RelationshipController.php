<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Lesson;
use App\Models\LessonTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    //
    protected $model = LessonTag::class;
    public function userLessons($id){
        $lessons = User::find($id)->lessons;
        $fields = [];
        $filtered = [];
        foreach($lessons as $lesson){
            $fields['Title'] = $lesson->title;
            $fields['Content']  = $lesson->body;
            $filtered[] = $fields;
        }
        return Response::json([ 'data' => $filtered] , 200);

    }
    public function lessonTags($id){
        $tags = Lesson::findOrFail($id)->tags;
        $fields = [];
        $filtered = [];
        foreach($tags as $tag){
            $fields['Title'] = $tag->title;
            $fields['Content']  = $tag->body;
            $filtered[] = $fields;
        }
        return Response::json([ 'data' => $filtered] , 200);
    }
    public function tagLessons($id){
        $lessons =  Tag::findOrFail($id)->lessons;
        $fields = [];
        $filtered = [];
        foreach($lessons as $lesson){
            $fields['Title'] = $lesson->title;
            $fields['Content']  = $lesson->body;
            $filtered[] = $fields;
        }
        return Response::json([ 'data' => $filtered] , 200);
    }
}
