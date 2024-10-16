<?php

namespace App\Services;

use App\Mail\NotificationEmail;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function create($data)
    {
        $data = collect($data)->only([
            'title',
            'description',
            'id_logdataesp'
        ])->toArray();
        
        $notif = Notification::create($data);

        // notify to user
        $users = User::all();
        $now = now();
        $arrayUserNotif = [];

        foreach ($users as $user) {
            array_push($arrayUserNotif, [
                'id_user' => $user->id,
                'id_notification' => $notif->id,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        UserNotification::insert($arrayUserNotif);
        
        // Email notif
        Mail::to($users)->send(new NotificationEmail($notif));

        return $notif;
    }

    public function paginateFailure($perPage = 10, $code_trafo)
    {
        return Notification::select('notifications.*', 'logdataesp.*')
        ->join('logdataesp', 'logdataesp.id_logdataesp', '=', 'notifications.id_logdataesp')
        ->join('user_notifications', 'user_notifications.id_notification', '=', 'notifications.id')
        ->where([
            ['logdataesp.code_trafo', '=', $code_trafo],
            ['user_notifications.id_user', '=', auth()->user()->id]
        ])
        ->latest('notifications.created_at')
        ->paginate($perPage);
    }
}
