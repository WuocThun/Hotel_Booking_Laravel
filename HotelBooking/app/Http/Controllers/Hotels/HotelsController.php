<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use App\Models\Apartment\Apartment;
use Illuminate\Http\Request;
use App\Models\Hotel\Hotel;
use App\Models\Booking\Booking;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;

class HotelsController extends Controller {
    public function rooms($id) {
        $getRooms = Apartment::query()->orderBy('id', 'desc')->take(6)->where('hotel_id', $id)->get();

        return view('hotels.rooms', compact('getRooms'));

    }

    public function roomsDetails($id) {
        $getRoom = Apartment::query()->find($id);

        return view('hotels.roomdetails', compact('getRoom'));

    }

    public function roomBooking(Request $request, $id) {
        $room  = Apartment::query()->find($id);
        $hotel = Hotel::query()->find($id);

//        if (strval(date("d/m/Y")) < strval($request->check_in ) and strval(date("d/m/Y"))  < strval($request->check_out))  {
            if (date("m/d/Y") < $request->check_in  and date("m/d/Y")  < $request->check_out) {
//            Logic
            if ( $request->check_in < $request->check_out) {
                $datetime1 = new DateTime($request->check_in);
                $datetime2 = new DateTime($request->check_out);
                $interval  = $datetime1->diff($datetime2);
                $days      = $interval->format('%a');
//                Logic
                $bookRooms = Booking::query()->create([
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'phone_number' => $request->phone_number,
                    'check_in'     => $request->check_in,
                    'check_out'    => $request->check_out,
                    'days'         => $days,
                    'price'        => $days * $room->price,
                    'user_id'      => Auth::user()->id,
                    'room_name'    => $room->name,
                    'hotel_name'   => $hotel->name,
                ]);
                echo "Your booked successfully";
                $totalPrice = $days * $room->price;
                $price = Session::put('price',$totalPrice);
                $getPrice = Session::get('$price');
                return Redirect::route('hotels.pay');
            } else {
                echo "Check out date should be greate than checkin date";
                echo strval($request->check_in).'---';

                echo $request->check_out;
            }
        } else {
            echo "Choose dates in the future, invalid check in or check out dates";
            echo strval($request->check_in).'---';

            echo $request->check_out;
        }

    }
    public function payWithPaypal() {

        return view('hotels.pay');

    }

}
