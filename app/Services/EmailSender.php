<?php

namespace App\Services;

use App\Exceptions\EmailSendingException;
use App\Repository\ThemeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmailSender implements ShouldQueue
{
    /**
     * @var EmailProducer
     */
    private $emailProducer;

    /**
     * @var ThemeRepository
     */
    private $themeRepository;

    public function __construct(EmailProducer $emailProducer, ThemeRepository $themeRepository)
    {
        $this->emailProducer = $emailProducer;
        $this->themeRepository = $themeRepository;
    }

    public function sendForTheTopic(array $emails, int $topicId)
    {
        try {
            $topic = $this->themeRepository->findById($topicId);
        }
        catch (NotFoundHttpException $e) {
            throw new EmailSendingException('Topic not found', 400);
        }

        foreach($emails as $email) {
            // can be done also by dispatch() and implementing the event dispatcher
            $this->emailProducer->sendToQueue($email, $topic);
        }
    }
}
