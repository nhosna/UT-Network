<?php

namespace App\Jobs;

use App\Models\Post;
use App\Notifications\NewPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

//use App\User;
//use App\Jobs\Job;
//use Illuminate\Contracts\Mail\Mailer;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewPostEmail   implements   ShouldQueue
{


    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {

        $this->post=$post;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->post->group->users, new NewPost($this->post));

    }
}
