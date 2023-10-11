<?php
namespace App\View\Composers;

use App\Models\Room;
use App\Notifications\CustomerBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationProvider
{

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $data = Auth::user()->notifications;
        $roomIds = $data->pluck('data')->map( fn ($item) => $item['room_id'])->unique()->toArray();
        $rooms = Room::whereIn('id', $roomIds)->get(['name', 'id']);
        $notifcations = Auth::user()->notifications->map (function ($item) use ($rooms) {
            if ($item->type === CustomerBooking::class) {
                $room = $rooms->where('id', $item->data['room_id'])->first();
                $item->content = $item->data['name'] . 'booking the room ' .$room->name;
            }
            return $item;
        });
        $view->with('notifications', $notifcations);
    }
}
