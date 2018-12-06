<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForumNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $topic_id;
    protected $thread_id;

    /**
     * Create a new message instance.
     *
     * @param $topic_id
     * @param $thread_id
     */
    public function __construct($topic_id,$thread_id)
    {
        $this->topic_id = $topic_id;
        $this->thread_id = $thread_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('common_component.forum_mail_not')->with([
            'topic_id' => $this->topic_id,
            'thread_id' => $this->thread_id
        ])->subject('Forum Notification');
    }
}
