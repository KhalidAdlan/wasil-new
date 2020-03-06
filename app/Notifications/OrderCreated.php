<?php

namespace App\Notifications;

use NotificationChannels\Facebook\FacebookChannel;
use NotificationChannels\Facebook\FacebookMessage;
use NotificationChannels\Facebook\Components\Button;
use NotificationChannels\Facebook\Enums\NotificationType;

use Illuminate\Notifications\Notification;

class OrderCreated extends Notification
{
    public function via($notifiable)
    {
        return [FacebookChannel::class];
    }

    protected $user;
public function __construct($user) {
 $this->user = $user;
}

    public function toFacebook($notifiable)
    {
        $url = url('/admin/orders/new');

       // $text = "لديك طلب جديد بواسطة "+\App\Salesman::find($order->salesmen_id)->name;
        print_r($this->user->facebook_id);
        return FacebookMessage::create()
            ->to(['id', '1537962652']) // Optional
            ->text('test')
            ->isUpdate() // Optional
            ->isTypeRegular() // Optional
            // Alternate method to provide the notification type.
            // ->notificationType(NotificationType::REGULAR) // Optional
            ->buttons([
                Button::create('View Invoice', $url)->isTypeWebUrl(),
            ]); // Buttons are optional as well.
    }
}
