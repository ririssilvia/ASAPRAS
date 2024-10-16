<?php

namespace App\Services;

use App\Models\Notif;
use Illuminate\Http\Request;

class NotifService
{
    public function all()
    {
        return Notif::all();
    }

    public function find($id)
    {
        return Notif::findOrFail($id);
    }

    public function create(Request $request)
    {
        $data = $request->only(['user_id', 'message', 'status']); // Assuming you are using Laravel's built-in validation and request sanitization
        $notif = Notif::create($data);

        return $notif;
    }

    public function update(Request $request, $id)
    {
        $notif = Notif::findOrFail($id);
        $data = $request->only(['user_id', 'message', 'status']);
        $notif->update($data);

        return $notif;
    }

    public function delete($id)
    {
        $notif = $this->find($id);
        $notif->delete();

        return $notif;
    }
}
