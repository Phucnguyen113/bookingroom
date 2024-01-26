<?php
namespace App\View\Composers;

use App\Models\Room;
use App\Notifications\CustomerBooking;
use App\Notifications\CustomerFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationProvider
{

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $data = Auth::user()->notifications ?? collect();
        $roomIds = $data->pluck('data')->map( fn ($item) => $item['room_id'])->unique()->toArray();
        $rooms = Room::whereIn('id', $roomIds)->get(['name', 'id']);
        $notifcations = $data->map (function ($item) use ($rooms) {
            $room = $rooms->where('id', $item->data['room_id'])->first();
            if ($item->type === CustomerBooking::class) {
                $item->content = '<strong>' . $item->data['name'] . '</strong> just made the reservation.';
            } elseif ($item->type === CustomerFeedback::class) {
                $item->content = '<strong>' . $item->data['name'] . '</strong> send feedback for ' .$room->name;
            }
            return $item;
        });

        $view->with('notifications', $notifcations);
    }
}
