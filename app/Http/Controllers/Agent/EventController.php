<?php

namespace App\Http\Controllers\Agent;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller{
	public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request){
        try {
        	if($request->ajax()){
	    		if($request->type == 'add'){
	    			$event = Event::create([
	    				'user_id' => $this->user->id,
	    				'end'		=>	$request->end,
	    				'start'		=>	$request->start,
	    				'title'		=>	$request->title,
	    				'category_type' =>	$request->category_type,
	    			]);
	    			return response()->json($event);
	    		}
	    		if($request->type == 'update'){
	    			$event = Event::find($request->event_id)->update([
	    				'user_id' => $this->user->id,
	    				'title'		=>	$request->title,
	    				'category_type'		=>	$request->category_type,
	    			]);
	    			return response()->json($event);
	    		}
	    		if($request->type == 'delete'){
	    			$event = Event::find($request->event_id)->delete();
	    			return response()->json($event);
    			}
    		}
        } catch (Exception $e) {
        	
        }
    }
}
