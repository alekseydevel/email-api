<?php

namespace Tests\Service;

use App\Exceptions\EmailSendingException;
use App\Models\Theme;
use App\Repository\ThemeRepository;
use App\Services\EmailProducer;
use App\Services\EmailSender;
use PHPUnit\Framework\TestCase;

class EmailSenderTest extends TestCase
{
    public function shouldSendTopicToProducers()
    {
        $emails = [
            'email1',
            'email2'
        ];

        $topicId = 1;

        $repoMock = $this->createMock(ThemeRepository::class);
        $repoMock->expects($this->once())->method('findById')->willReturn(new Theme(['id', 'body']));

        $queueProducerMock = $this->createMock(EmailProducer::class);
        $queueProducerMock->expects($this->at(2))->method('sendToQueue');

        $this->assertNotDispatched(EmailSendingException::class);

        $service = new EmailSender($queueProducerMock, $repoMock);
        $service->sendForTheTopic($emails, $topicId);
    }

    /*
     *
     * other tests (should throw Exception, should not find the topic, should fail producing, etc)
     */
}
