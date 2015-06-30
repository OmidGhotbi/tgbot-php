<?php

namespace Pathetic\TgBot\Types;

class ForceReply
{
    use \Pathetic\TgBot\PropertiesEasyAccess;
    
    /**
     * Shows reply interface to the user, as if they manually selected the bot‘s message and tapped ’Reply'.
     * 
     * @var boolean
     */
    protected $force_reply = true;
    
    /**
     * Optional. Use this parameter if you want to force reply from specific users only. Targets:
     *  1) users that are @mentioned in the text of the Message object;
     *  2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * 
     * @var boolean
     */
    protected $selective;
    
    /**
     * @param boolean $selective
     */
    public function __construct($selective = false)
    {
        $this->selective = (boolean) $selective;
    }
    
    public function __toString()
    {
        return json_encode([
            'force_reply' => $this->force_reply,
            'selective' => $this->selective
        ]);
    }
}
