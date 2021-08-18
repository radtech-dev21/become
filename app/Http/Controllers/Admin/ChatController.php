<?php

namespace App\Http\Controllers\Admin;
use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Models\ChatConversation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ChatController extends Controller{

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
    public function admin(Request $request){
        $role = 'super_admin';
        return view('admin.chat', compact('role'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agent(Request $request){
        $role = 'agents';
        return view('admin.chat', compact('role'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function members(Request $request){
        $role = 'leads';
        return view('admin.chat', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postChatUserList(Request $request){
        try {
           $role = $request->role;
           if($role == 'admin'){
                $role = 'super_admin';
           }else if ($role == 'members') {
                $role = 'leads';
           }
           $search_by_name = $request->search_by_name;
           $users = User::role($role)->where('name','LIKE','%'.$search_by_name.'%')->whereNotIn('id', [$this->user->id])->orderBy('id','DESC')->get();
           foreach ($users as $user) {
                $last_chat_conversation = ChatMessage::where('receiver_id', $user->id)->first();
                if($last_chat_conversation){
                    $user->last_message = $last_chat_conversation->message;
                    $user->created_date = $user->created_at->format('H:i');
                }
           }
           return Response::json(['status' => 'success', 'users' => $users, 'role' => $role]) ;
        } catch (Exception $e) {
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postChatMessageList(Request $request){
        try {
            $messages = [];
            $user_id = $request->user_id;
            $selected_user = User::where('id', $user_id)->first();
            $chat_conversation = ChatConversation::where(function($query) use($user_id) {
                return $query->where(function($query) use($user_id) {
                    $query->where('user_1', $this->user->id)->where('user_2', $user_id);
                })->orWhere(function($query) use($user_id) {
                    $query->where('user_1', $user_id)->where('user_2', $this->user->id);
                });
            })->first();
            if($chat_conversation){
                $messages = ChatMessage::with('sender')->where('chat_conversation_id', $chat_conversation->id)->get();
                foreach ($messages as $message) {
                    $message->is_sender_admin = $this->user->id == $message->receiver_id ? true : false;
                }
            }
            foreach ($messages as $key => $message) {
                $message->created_date = $message->created_at->format('H:i');
            }
            return Response::json(['status' => 'success', 'messages' => $messages, 'selected_user' => $selected_user]) ;
        } catch (Exception $e) {
            
        }
    }
}
