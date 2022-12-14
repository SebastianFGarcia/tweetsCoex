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
                'tweets_id' => 'required',
                'description' => 'required',
            ];
            $messages = [
                'tweets_id.required' => 'Tweet ID is required',
                'description.required' => 'Comment is required',
            ];
            $this->validate(request(), $rules, $messages);
            $comment = Comments::create([
                'user_id' => auth()->user()->id,
                'tweets_id' => request()->tweets_id,
                'description' => request()->description,
            ]);
            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update($id){
        $comment = Comments::find($id);

        if($comment->user_id != auth()->user()->id){
            return response()->json('You are not authorized to update this comment');
        }

        try {
            $rules = [
                'tweets_id' => 'required',
                'description' => 'required',
            ];
            $messages = [
                'tweets_id.required' => 'Tweet ID is required',
                'description.required' => 'Comment is required',
            ];
            $this->validate(request(), $rules, $messages);
            $comment->update([
                'user_id' => auth()->user()->id,
                'tweets_id' => request()->tweets_id,
                'description' => request()->description,
            ]);
            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete($id){
        $comment = Comments::find($id);

        if($comment->user_id != auth()->user()->id){
            return response()->json('You are not authorized to delete this comment');
        }
        try {
            $comment->delete();
            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
