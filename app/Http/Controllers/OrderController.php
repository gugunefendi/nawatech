<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $orders = json_decode(Storage::get(env('ORDER')), true);
            $workshops = json_decode(Storage::get(env('WORKSHOP')), true);

            $result = $this->processOrders($orders, $workshops);
            
            return response()->json(['status' => 1, 'message' => 'Data Successfully Retrieved.', 'data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => 'Error processing data, because: ' . $e->getMessage()]);
        }
    }

    private function processOrders($orders, $workshops) {

        $result = [];
        foreach ($orders["data"] as $order) {
            $name = $order["name"];
            $email = $order["email"];
            $bookingNumber = $order["booking"]["booking_number"];
            $bookingDate = $order["booking"]["book_date"];
            $ahassCode = "";
            $workshopName = "";
            $workshopAdress = "";
            $workshopContact = "";
            $workshopDistance = 0;

            foreach ($workshops["data"] as $workshop) {
                if (isset($order["booking"]["workshop"]["code"]) && $order["booking"]["workshop"]["code"] === $workshop["code"]) {
                    $ahassCode = $workshop["code"];
                    $workshopName = $workshop["name"];
                    $workshopAdress = $workshop["address"];
                    $workshopContact = $workshop["phone_number"];
                    $workshopDistance = $workshop["distance"];
                    break;
                } elseif (isset($order["booking"]["workshop"]["code"]) && $order["booking"]["workshop"]["code"] !== $workshop["code"]) {
                    $ahassCode = $order["booking"]["workshop"]["code"];
                    $workshopName = $order["booking"]["workshop"]["name"];
                }
            }

            $motorcycleName = $order["booking"]["motorcycle"]["name"];
            $motorcycleUtCode = $order["booking"]["motorcycle"]["ut_code"];

            $result[] = [
                "name" => $name,
                "email" => $email,
                "booking_number" => $bookingNumber,
                "booking_date" => $bookingDate,
                "ahass_code" => $ahassCode,
                "ahass_name" => $workshopName,
                "ahass_address" => $workshopAdress,
                "ahass_contact" => $workshopContact,
                "ahass_distance" => $workshopDistance,
                "motorcycle_ut_code" => $motorcycleUtCode,
                "motorcycle" => $motorcycleName
            ];
        }

        $collection = collect($result);
        $sortedResult = $collection->sortBy('ahass_distance')->values()->all();

        return response()->json($sortedResult);
    }
}
