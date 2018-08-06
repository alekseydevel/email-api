<?php

namespace App\Http\Controllers;

use App\Jobs\EmailQueueJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class EmailController extends BaseController
{
    public function send(Request $request): JsonResponse
    {
        $this->validate(
            $request,
            [
                'emails' => 'required|array', // also add email validation
                'theme' => 'required|integer'
            ]
        );

        $this->dispatch(new EmailQueueJob($request->get('emails'), $request->get('theme')));

        return new JsonResponse(['status' => 'success']);
    }
}
