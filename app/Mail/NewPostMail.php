<?php
//
//namespace App\Mail;
//
//use App\Models\Post;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Mail\Mailable;
//use Illuminate\Notification\Messages\MailMessage;
//use Illuminate\Notification\Notification;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Support\Facades\Lang;
//
//class NewPostMail extends Notification
//{
//    /**
//     * Create a new message instance.
//     *
//     * @return void
//     */
//    public function __construct(  $post )
//    {
//        $this->post = $post ;
//    }
//
//    /**
//     * Build the message.
//     *
//     * @return $this
//     */
//    public function toMail($notifiable)
//    {
////        //TODO set from address from .env using env("MAIL_FROM_ADDRESS")
////        return $this->from("nhosna@gmail.com")
////            ->subject('New Post Notification')
////            ->view('mail.new-post')
////            ->with([
////                'post' => $this->post ,
////            ]);
//        $url = url(route('post.show', [
//            'post' => $this->post], false));
//
//
//
//
//        return (new MailMessage)
//            ->subject('New Post Notification')
//            ->line ( "Hello, there's a new post from group ".$this->group->name.".")
//            ->action('Show Post', $url) ;
//
//
//    }
//
//
//}
