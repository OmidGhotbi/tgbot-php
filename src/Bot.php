<?php

namespace Pathetic\TgBot;

use Closure;
use ReflectionFunction;
use GuzzleHttp\Client;
use Pathetic\TgBot\EventSystem;
use Pathetic\TgBot\Exception as TgBotException;
use Pathetic\TgBot\Types\Message;
use Pathetic\TgBot\Types\Update;
use Pathetic\TgBot\Types\User;
use Pathetic\TgBot\Types\UserProfilePhotos;

class Bot
{
    const API_URL = 'https://api.telegram.org/';
    
    /**
     * @var string
     */
    protected $token;
    
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;
    
    /**
     * @var \Pathetic\TgBot\EventSystem
     */
    protected $events;
    
    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->httpClient = new Client();
        $this->events = new EventSystem();
    }
    
    /**
     * @param string $method
     * @param array  $parameters
     * 
     * @throws \Pathetic\TgBot\Exception
     */
    protected function request($method, array $parameters = [])
    {
        $response = (string) $this->httpClient->post(self::API_URL . 'bot' . $this->token . '/' . $method, [
            'exceptions' => false,
            'form_params' => $parameters,
        ])->getBody();
        
        $response = json_decode($response, true);
        
        if (!$response['ok']) {
            throw new TgBotException($response['description'], $response['error_code']);
        }
        
        return $response['result'];
    }
    
    /**
     * @param string $method
     * @param array  $parameters
     * 
     * @throws \Pathetic\TgBot\Exception
     */
    protected function requestWithFile($method, array $parameters = [])
    {
        $response = (string) $this->httpClient->post(self::API_URL . 'bot' . $this->token . '/' . $method, [
            'exceptions' => false,
            'multipart' => $parameters,
        ])->getBody();
        
        $response = json_decode($response, true);
        
        if (!$response['ok']) {
            throw new TgBotException($response['description'], $response['error_code']);
        }
        
        return $response['result'];
    }
    
    /**
     * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
     * 
     * @return \Pathetic\TgBot\Types\User
     */
    public function getMe()
    {
        return new User($this->request('getMe'));
    }
    
    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     * 
     * @param integer  $chat_id                   Unique identifier for the message recipient — User or GroupChat id.
     * @param string   $text                      Text of the message to be sent.
     * @param boolean  $disable_web_page_preview  Disables link previews for links in this message.
     * @param integer|null  $reply_to_message_id  If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     * 
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendMessage($chat_id, $text, $disable_web_page_preview = false, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->request('sendMessage', compact('chat_id', 'text', 'disable_web_page_preview', 'reply_to_message_id', 'reply_markup')));
    }
    
    /**
     * Use this method to forward messages of any kind. On success, the sent Message is returned.
     * 
     * @param integer $chat_id      Unique identifier for the message recipient — User or GroupChat id.
     * @param integer $from_chat_id Unique identifier for the chat where the original message was sent — User or GroupChat id.
     * @param integer $message_id   Unique message identifier.
     * 
     * @return \Pathetic\TgBot\Types\Message
     */
    public function forwardMessage($chat_id, $from_chat_id, $message_id)
    {
        return new Message($this->request('forwardMessage', compact('chat_id', 'from_chat_id', 'message_id')));
    }
    
    /**
     * Use this method to send photos. On success, the sent Message is returned.
     * 
     * @param integer      $chat_id  Unique identifier for the message recipient — User or GroupChat id.
     * @param string       $photo    Photo to send. You can either pass a file_id as String to resend a photo that is already on the Telegram servers, or upload a new photo using multipart/form-data.
     * @param string|null  $caption  Photo caption (may also be used when resending photos by file_id).
     * @param integer|null $reply_to_message_id If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     * 
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendPhoto($chat_id, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->requestWithFile('sendPhoto', [
            ['name' => 'chat_id', 'contents' => (string) $chat_id],
            ['name' => 'photo', 'contents' => $photo],
            ['name' => 'caption', 'contents' => $caption],
            ['name' => 'reply_to_message_id', 'contents' => (string) $reply_to_message_id],
            ['name' => 'reply_markup', 'contents' => $reply_markup]
        ]));
    }
    
    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Document). On success, the sent Message is returned.
     * 
     * @param integer      $chat_id               Unique identifier for the message recipient — User or GroupChat id.
     * @param string       $audio                 Audio file to send. You can either pass a file_id as String to resend an audio that is already on the Telegram servers, or upload a new audio file using multipart/form-data.
     * @param integer|null $reply_to_message_id   If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.

     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendAudio($chat_id, $audio, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->requestWithFile('sendAudio', [
            ['name' => 'chat_id', 'contents' => (string) $chat_id],
            ['name' => 'audio', 'contents' => $audio],
            ['name' => 'reply_to_message_id', 'contents' => (string) $reply_to_message_id],
            ['name' => 'reply_markup', 'contents' => $reply_markup]
        ]));
    }
    
    /**
     * Use this method to send general files. On success, the sent Message is returned.
     * 
     * @param integer      $chat_id               Unique identifier for the message recipient — User or GroupChat id.
     * @param string       $document              File to send. You can either pass a file_id as String to resend a file that is already on the Telegram servers, or upload a new file using multipart/form-data.
     * @param integer|null $reply_to_message_id   If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     * 
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendDocument($chat_id, $document, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->requestWithFile('sendDocument', [
            ['name' => 'chat_id', 'contents' => (string) $chat_id],
            ['name' => 'document', 'contents' => $document],
            ['name' => 'reply_to_message_id', 'contents' => (string) $reply_to_message_id],
            ['name' => 'reply_markup', 'contents' => $reply_markup]
        ]));
    }
    
    /**
     * Use this method to send .webp stickers. On success, the sent Message is returned.
     * 
     * @param integer      $chat_id               Unique identifier for the message recipient — User or GroupChat id.
     * @param string       $sticker               Sticker to send. You can either pass a file_id as String to resend a sticker that is already on the Telegram servers, or upload a new sticker using multipart/form-data.
     * @param integer|null $reply_to_message_id   If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     *
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendSticker($chat_id, $sticker, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->requestWithFile('sendAudio', [
            ['name' => 'chat_id', 'contents' => (string) $chat_id],
            ['name' => 'sticker', 'contents' => $sticker],
            ['name' => 'reply_to_message_id', 'contents' => (string) $reply_to_message_id],
            ['name' => 'reply_markup', 'contents' => $reply_markup]
        ]));
    }
    
    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned.
     * 
     * @param integer      $chat_id               Unique identifier for the message recipient — User or GroupChat id.
     * @param string       $video                 Video to send. You can either pass a file_id as String to resend a video that is already on the Telegram servers, or upload a new video file using multipart/form-data.
     * @param integer|null $reply_to_message_id   If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     *
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendVideo($chat_id, $video, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->requestWithFile('sendAudio', [
            ['name' => 'chat_id', 'contents' => (string) $chat_id],
            ['name' => 'video', 'contents' => $video],
            ['name' => 'reply_to_message_id', 'contents' => (string) $reply_to_message_id],
            ['name' => 'reply_markup', 'contents' => $reply_markup]
        ]));
    }
    
    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     * 
     * @param integer      $chat_id               Unique identifier for the message recipient — User or GroupChat id.
     * @param float        $latitude              Latitude of location.
     * @param float        $longitude             Longitude of location.
     * @param integer|null $reply_to_message_id   If the message is a reply, ID of the original message.
     * @param \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     *
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendLocation($chat_id, $latitude, $longitude, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->request('sendLocation', compact('chat_id', 'latitude', 'longitude', 'reply_to_message_id', 'reply_markup')));
    }
    
    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). 
     * 
     * @param integer $chat_id Unique identifier for the message recipient — User or GroupChat id.
     * @param string  $action  Type of action to broadcast. Choose one, depending on what the user is about to receive: typing for text messages, upload_photo for photos, record_video or upload_video for videos, record_audio or upload_audio for audio files, upload_document for general files, find_location for location data.
     * 
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendChatAction($chat_id, $action)
    {
        return new Message($this->request('sendChatAction', compact('chat_id', 'action')));
    }
    
    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     * 
     * @param integer      $user_id Unique identifier of the target user.
     * @param integer|null $offset  Sequential number of the first photo to be returned. By default, all photos are returned.
     * @param integer|null $limit   Limits the number of photos to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     * 
     * @return \Pathetic\TgBot\Types\UserProfilePhotos
     */
    public function getUserProfilePhotos($user_id, $offset = null, $limit = null)
    {
        return new UserProfilePhotos($this->request('getUserProfilePhotos', compact('user_id', 'offset', 'limit')));
    }
    
    /**
     * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
     * 
     * @param integer|null $offset  Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id.
     * @param integer|null $limit   Limits the number of updates to be retrieved. Values between 1—100 are accepted. Defaults to 100
     * @param integer|null $timeout Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling
     * 
     * @return array
     */
    public function getUpdates($offset = null, $limit = null, $timeout = null)
    {
        $arrayOfUnsortedUpdates = $this->request('getUpdates', compact('offset', 'limit', 'timeout'));
        
        $updates = [];
        
        foreach ($arrayOfUnsortedUpdates as $update) {
            $updates[] = new Update($update);
        }
        
        return $updates;
    }
    
    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update.
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     * 
     * @param string|null $url
     * 
     * @return boolean
     */
    public function setWebhook($url = null)
    {
        return $this->request('setWebhook', compact('url'));
    }
    
    /**
     * @param \Closure|null $check
     * @param \Closure      $event
     * 
     * @return \Pathetic\TgBot\Bot
     */
    public function on($check, Closure $event)
    {
        $this->events->add($check, $event);
        
        return $this;
    }
    
    /**
     * @param string    $name
     * @param \Closure  $action
     * 
     * @return \Pathetic\TgBot\Bot
     */
    public function command($name, Closure $action)
    {
        $check = function(Message $message) use ($name) {
            if (!isset($message->text)) {
                return false;
            }
            
            $regexp = '/^\/([^\s@]+)(@\S+)?\s?(.*)$/';
            
            preg_match($regexp, $message->text, $matches);
            
            return !empty($matches) && $matches[1] == $name;
        };
        
        $event = function(Message $message) use ($action) {
            $regexp = '/^\/([^\s@]+)(@\S+)?\s?(.*)$/';
            
            preg_match($regexp, $message->text, $matches);
            
            if (isset($matches[3]) && !empty($matches[3])) {
                $parameters = str_getcsv($matches[3], chr(32));
            } else {
                $parameters = [];
            }
            
            array_unshift($parameters, $message);
            
            $action = new ReflectionFunction($action);
            
            if (count($parameters) >= $action->getNumberOfRequiredParameters()) {
                $action->invokeArgs($parameters);
            }
            
            return false;
        };
        
        $this->events->add($check, $event);
        
        return $this;
    }
    
    /**
     * @param array $updates
     */
    public function handle(array $updates)
    {
        foreach ($updates as $update) {
            $this->events->handle($update->message);
        }
    }
    
    /**
     * @return array
     */
    public function createUpdateFromRequest()
    {
        if (!empty(file_get_contents('php://input'))) {
            return [new Update(json_decode(file_get_contents('php://input'), true))];
        } else {
            return [];
        }
    }
}
