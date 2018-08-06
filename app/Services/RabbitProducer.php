<?php

namespace App\Services;

use App\Models\Theme;

class RabbitProducer implements EmailProducer
{

    public function sendToQueue(string $email, Theme $theme)
    {
        // publish
    }
}