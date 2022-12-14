<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Comments;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::all();
        return response()->json($tweets);
    }

    public function show($id)
    {
        $tweet = Tweet::find($id);
        $coments = Comments::where('tweets_id', $id)->get();
        return response()->json([
            'tweet' => $tweet,
            'comments' => $coments
            ]);

    }

    public function create()
    {
        try {
            $rules = [
                'description' => 'required',
            ];
            $messages = [
                'description.required' => 'Tweet is required',
            ];
            $this->validate(request(), $rules, $messages);
            $tweet =Tweet::create([
                'user_id' => auth()->user()->id,
                'description' => request()->description,
            ]);
            return response()->json($tweet);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update($id){

        $tweet = Tweet::find($id);

        if($tweet->user_id != auth()->user()->id){
            return response()->json('You are not authorized to update this tweet');
        }
        
        try {
            $rules = [
                'description' => 'required',
            ];
            $messages = [
                'description.required' => 'Tweet is required',
            ];
            $this->validate(request(), $rules, $messages);
            $tweet = Tweet::find($id);
            $tweet->update(request()->all());
            return response()->json($tweet);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        
    }

    public function delete($id){
        $tweet = Tweet::find($id);

        if($tweet->user_id != auth()->user()->id){
            return response()->json('You are not authorized to update this tweet');
        }
        try {
            $tweet = Tweet::find($id);
            $tweet->delete();
            return response()->json($tweet);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
}
