<?php

namespace App\Console\Commands;

use App\Models\Room;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ConvertProvinceAndDistrict extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-province-and-district';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $province = Http::get('https://provinces.open-api.vn/api/p/1')->object();

        Room::all()->each(function (Room $room) use ($province) {
            $districts = collect([
                1 => 'Ba Đình',
                3 => 'Tây Hồ ',
                5 => 'Cầu Giấy',
            ]);
            $district = $districts->search(function ($district) use ($room) {
                return $district === $room->district;
            });
            $room->province = $province->code;
            $room->district = $district;
            $room->save();
        });
    }
}
