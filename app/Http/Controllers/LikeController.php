<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * LikeController constructor.
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }


    /**
     * @param Reply $reply
     */
    public function likeIt(Reply $reply)
    {
        $reply->like()->create([
            'user_id' => auth()->id()
        ]);
    }

    /**
     * @param Reply $reply
     * @throws \Exception
     */
    public function unLikeIt(Reply $reply)
    {
        $reply->like()->where('user_id', auth()->id())->first()->delete();
    }
}
