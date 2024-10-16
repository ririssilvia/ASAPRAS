<?php

namespace App\View\Components;

use App\Models\Notification;
use App\Models\UserNotification;
use App\Services\NotificationService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = auth()->user();
        $notifications = DB::table('notifications')
        ->join('user_notifications', 'user_notifications.id_notification', '=', 'notifications.id')
        ->select('notifications.*')
        ->where('user_notifications.id_user', $user->id)
        ->whereNull('user_notifications.read_at')
        ->get();

        return view('components.header', [
            'user' => $user,
            'notifications' => $notifications
        ]);
    }

    public function readAll()
    {
        UserNotification::where('id_user', auth()->user()->id)->whereNull('read_at')->update(['read_at' => now()]);
    }
}
