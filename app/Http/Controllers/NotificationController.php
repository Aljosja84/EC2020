<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $appends = ['created_date'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # returns 10 notifications of the logged in user together with the
        # time it was created, in a human readable way
        return auth()->user()->notifications->map(function($n) {
            $n->sent_date = $n->created_at->diffForHumans();
            $n->unread_count = $n->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count();

            return ($n);
        })->take(10);
    }
}
