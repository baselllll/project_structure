<?php


namespace Modules\UserModule\Services;

use App\Models\Chatting;
use Exception;
use Illuminate\Support\Arr;
use Modules\UserModule\Repositories\MessageRepository;
use Modules\UserModule\Repositories\VechileRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Spatie\Permission\Models\Role;

class MessageService extends BaseService
{
    protected $messagerepository;
    public function __construct(MessageRepository $messagerepository)

    {
        $this->messagerepository = $messagerepository;
    }

    /**
     * @inheritDoc
     */
    function getRepository(): BaseRepository
    {
        return $this->messagerepository;
    }

    public function saveMessage(array $data)
    {

        Arr::only($data,['sender_id','chat_id','receiver_id','message']);
        return $this->messagerepository->create($data);
    }

    public function getconversation($chat_id)
    {
        return $this->messagerepository->with(['user_sender','user_receiver'])->where('chat_id',$chat_id)->get();
    }
}
