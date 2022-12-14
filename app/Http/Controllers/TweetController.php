<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::all();
        return response()->json($tweets);
    }

    public function create()
    {
        try {
            $rules = [
                'user_id' => 'required',
                'tweet' => 'required',
            ];
            $messages = [
                'user_id.required' => 'User ID is required',
                'tweet.required' => 'Tweet is required',
            ];
            $this->validate(request(), $rules, $messages);
            $tweet =Tweet::create(request()->all());
            return response()->json($tweet);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update($id){
        try {
            $rules = [
                'user_id' => 'required',
                'tweet' => 'required',
            ];
            $messages = [
                'user_id.required' => 'User ID is required',
                'tweet.required' => 'Tweet is required',
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
        try {
            $tweet = Tweet::find($id);
            $tweet->delete();
            return response()->json($tweet);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
