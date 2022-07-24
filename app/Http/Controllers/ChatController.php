<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Chatting;
use Illuminate\Http\Request;
use LRedis;
use Modules\UserModule\Http\Requests\ChattingRequest;
use Modules\UserModule\Http\Requests\getChatRequest;
use Modules\UserModule\Http\Resources\ChattingResource;
use Modules\UserModule\Http\Resources\VechileResource;
use Modules\UserModule\Services\MessageService;

class ChatController extends Controller
{
    public $messgeService;
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function sendMessage(Request $request)
    {
        $redis = LRedis::connection();
        $data = ['message' => $request->get('message'), 'user' => 'asasas'];
        $redis->publish('message', json_encode($data));

        return response()->json(['status' => 'success','data'=>$data]);
    }
    // without redis manaully chat
    public  function  sendMessageOrdinally(ChattingRequest $request){
        $message = new ChattingResource($this->messageService->saveMessage($request->validated()));

        return response()->json([
            "message"=>"data created successfully",
            "status"=>"success",
            "data"=>$message
        ],200);
    }
    public function  addChat(){
        $chat = Chatting::create();
        return response()->json([
            "message"=>"data created successfully",
            "status"=>"success",
            "data"=>$chat
        ],200);
    }
    public  function  getconversation(getChatRequest  $request){

        $messages = ChattingResource::collection($this->messageService->getconversation($request->chat_id));

        return response()->json([
            "message"=>"data successfully",
            "status"=>"success",
            "data"=>$messages
        ],200);
    }
}
