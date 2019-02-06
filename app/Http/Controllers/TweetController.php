<?php

namespace App\Http\Controllers;

use App\Interactions;
use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'text' => 'string|required|max:250',
        ]);

        $tweet = new Tweet([
            'user_id' => $request->user()->id,
            'text' => $request->text,
        ]);

        $tweet->save();

        return response()->json([
            'message' => 'Successfully created tweet',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($tweet = Tweet::find($id)) {
            $tweet->delete();

            return response()->json([
                'message' => 'Tweet deleted successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Tweet not found',
        ], 404);

    }

    public function like(Request $request, $id)
    {
        //check if tweet exists
        if (Tweet::find($id)) {

            //Check if this interaction has already done
            if ($this->checkInteraction($id, 1, $request->user()->id)) {

                return response()->json([
                    'message' => 'Tweet has already liked for this user',
                ], 403);

            } else {

                $interaction = new Interactions([
                    'user_id' => $request->user()->id,
                    'tweet_id' => $id,
                    'type' => 1, //Like
                ]);

                $interaction->save();
                return response()->json([
                    'message' => 'Tweet liked successfully',
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Tweet not found',
        ], 404);

    }

    /**
     * Check if this interaction has already done
     *
     * @param  int  $id tweet id
     * @param  int  $type type of interaction
     * @param  int  $user_id user id
     * @return \Illuminate\Http\Response
     */

    public function checkInteraction($id, $type, $user_id)
    {
        return Interactions::where([
            'tweet_id' => $id,
            'type' => $type,
            'user_id' => $user_id,
        ])->first();
    }
}
