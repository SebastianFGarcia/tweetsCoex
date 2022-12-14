<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comments::all();
        return response()->json($comments);
    }

    public function create()
    {
        try {
            $rules = [
                'user_id' => 'required',
                'tweets_id' => 'required',
                'description' => 'required',
            ];
            $messages = [
                'user_id.required' => 'User ID is required',
                'tweets_id.required' => 'Tweet ID is required',
                'description.required' => 'Comment is required',
            ];
            $this->validate(request(), $rules, $messages);
            $comment = Comments::create(request()->all());
            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update($id){
        try {
            $rules = [
                'user_id' => 'required',
                'tweets_id' => 'required',
                'description' => 'required',
            ];
            $messages = [
                'user_id.required' => 'User ID is required',
                'tweets_id.required' => 'Tweet ID is required',
                'description.required' => 'Comment is required',
            ];
            $this->validate(request(), $rules, $messages);
            $comment = Comments::find($id);
            $comment->update(request()->all());
            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete($id){
        try {
            $comment = Comments::find($id);
            $comment->delete();
            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
