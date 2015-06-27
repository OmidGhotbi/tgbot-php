<?php

namespace Pathetic\TgBot;

use GuzzleHttp\Client;
use Pathetic\TgBot\Exception as TgBotException;
use Pathetic\TgBot\Types\User;
use Pathetic\TgBot\Types\Message;

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
    
    public function __construct($token)
    {
        $this->token = $token;
        $this->httpClient = new Client();
    }
    
    /**
     * @var string $method
     * @var array  $parameters
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
        
        return $response;
    }
    
    /**
     * @var string $method
     * @var array  $parameters
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
     * @var integer  $chat_id                   Unique identifier for the message recipient — User or GroupChat id.
     * @var string   $text                      Text of the message to be sent.
     * @var boolean  $disable_web_page_preview  Disables link previews for links in this message.
     * @var integer|null  $reply_to_message_id  If the message is a reply, ID of the original message.
     * @var \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
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
     * @var integer $chat_id      Unique identifier for the message recipient — User or GroupChat id.
     * @var integer $from_chat_id Unique identifier for the chat where the original message was sent — User or GroupChat id.
     * @var integer $message_id   Unique message identifier.
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
     * @var integer      $chat_id  Unique identifier for the message recipient — User or GroupChat id.
     * @var string       $photo    Photo to send. You can either pass a file_id as String to resend a photo that is already on the Telegram servers, or upload a new photo using multipart/form-data.
     * @var string|null  $caption  Photo caption (may also be used when resending photos by file_id).
     * @var integer|null $reply_to_message_id If the message is a reply, ID of the original message.
     * @var \Pathetic\TgBot\Types\ReplyKeyboardMarkup|\Pathetic\TgBot\Types\ReplyKeyboardHide|\Pathetic\TgBot\Types\ForceReply|null $reply_markup Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide keyboard or to force a reply from the user.
     * 
     * @return \Pathetic\TgBot\Types\Message
     */
    public function sendPhoto($chat_id, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null)
    {
        return new Message($this->requestWithFile('sendPhoto', [
            ['name' => 'chat_id', 'contents' => $chat_id],
            ['name' => 'photo', 'contents' => $photo],
            ['name' => 'caption', 'contents' => $caption],
            ['name' => 'reply_to_message_id', 'contents' => $reply_to_message_id],
            ['name' => 'reply_markup', 'contents' => $reply_markup]
        ]));
    }
}
