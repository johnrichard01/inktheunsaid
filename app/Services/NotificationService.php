<?php

// app/Services/NotificationService.php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function createNotification($user, $notifiable, $type, $message)
    {
        Notification::create([
            'user_id' => $user->id,
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable),
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function markAsRead($notification)
    {
        $notification->update(['read' => true]);
    }
}
