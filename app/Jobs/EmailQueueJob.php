<?php

namespace App\Jobs;

use App\Exceptions\EmailSendingException;
use App\Services\EmailSender;

class EmailQueueJob
{
    /**
     * @var array
     */
    private $emails;
    /**
     * @var int
     */
    private $topic;

    public function __construct(array $emails, int $topic)
    {
        $this->emails = $emails;
        $this->topic = $topic;
    }

    public function handle(EmailSender $sender)
    {
        try {
            $sender->sendForTheTopic($this->emails, $this->topic);
        }
        catch (EmailSendingException $exception) {
            app('logger')->error($exception->getMessage()); // 'logger' is some logging service
        }
    }
}