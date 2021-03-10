<?php

namespace App\Services;

class SendEmail {

  protected $data;

  public function __construct(array $mailData) {
    $this->data = $mailData;
  }

  public function sendEmail() {
    if (env('APP_ENV') === 'local') {
      $mailData = $this->data;
      $send = \Mail::send($mailData['view'], $mailData['data'], function ($message) use ($mailData) {
        $message->from($mailData['from']['email'], $mailData['from']['name']);
        $message->to($mailData['to']['email'], $mailData['to']['name']);
        $message->subject($mailData['subject']);
      });
    }
    return true;
  }

}
