<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
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

        broadcast(new LikeEvent($reply->id, 1))->toOthers();
    }

    /**
     * @param Reply $reply
     * @throws \Exception
     */
    public function unLikeIt(Reply $reply)
    {
        $reply->like()->where('user_id', auth()->id())->first()->delete();
        broadcast(new LikeEvent($reply->id, 0))->toOthers();

    }
}
