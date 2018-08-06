<?php
namespace App\Services;

use App\Models\Theme;

interface EmailProducer
{
    public function sendToQueue(string $email, Theme $theme);
}
