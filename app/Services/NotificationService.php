<?php

namespace App\Services;

class NotificationService
{
    public static function thereIsUnreadNotifications(): bool
    {
        return (bool) auth()->user()->unreadNotifications()->count("id");
    }

    public static function getNotifications()
    {
        return auth()->user()->notifications;
    }

    public static function markNotificationsAsRead($notifications)
    {
        $notifications->markAsRead();
    }
}
