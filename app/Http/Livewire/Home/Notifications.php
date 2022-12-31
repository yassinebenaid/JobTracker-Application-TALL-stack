<?php

namespace App\Http\Livewire\Home;


use App\Services\NotificationService;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public $unreadNotifications = false;

    public function mount()
    {
        $this->notifications = collect();
        $this->unreadNotifications = NotificationService::thereIsUnreadNotifications();
    }


    public function refresh()
    {
        $this->notifications = NotificationService::getNotifications();

        $this->unreadNotifications = false;

        $this->markNotificationsAsRead();
    }

    private function markNotificationsAsRead()
    {
        if (method_exists($this->notifications, "markAsRead") && !$this->unreadNotifications) {
            $this->notifications->markAsRead();
        }
    }
}
