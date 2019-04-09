<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    public function index()
    {
        //
    }

    public function due(Request $request)
    {
        // Get all due or past due tasks and order by their due date asc

        //return auth()->user();

        $items =  Task::where('account_id',auth()->user()->account_id)
                    ->where('status','<', 1)
                    ->whereDate('due','<=', Carbon::now())
                    ->with(['card' => function($query) {
                        return $query->select('id','name');
                    }])
                    ->get();

        return ['items' => $items];
    }
                    


                    
}
