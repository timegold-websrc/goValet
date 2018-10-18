<?php

namespace App\Http\Controllers;

use App\Parking;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParkingController extends Controller
{
    use HelperController;

    public function register(Request $request){
        
        $user_id = $this->getAuthUserId($request);
        
        if ($user_id == 0) 
            return response()->json(['status' => 'error', 'message' => "User is not Authed"]);

        if (Parking::where('user_id', $user_id)->count() >= 6) 
            return response()->json(['status' => 'error', 'message' => "Vehicle is overflow"]);

        $data = $request->all();
        $data['image'] = $this->saveImage("parking/{$user_id}", $request, 'image');
        $data['user_id'] = $user_id;
        $data['capacity'] = $request->parking_spots;

        Parking::create($data);

        return response()->json(['status' => true, 'data' => $data]);
    }

    public function get(Request $request) {
        $user_id = $this->getAuthUserId($request);
        
        if ($user_id == 0) {
            return response()->json(['status' => false, 'message' => "User is not Authed"]);
        }
        $v_item = Parking::where('id', $request->id)->first();

        return response()->json(['status' => true, 'data' => $v_item]);
    }

    public function delete($id, Request $request) {

        // $item = Vehicle::where('id', $id)->first();
        // $this->deleteFile($item->photo);
        // Vehicle::where('id', $id)->delete();
        // return $this->get($request);
    }

    public function searchParking(Request $request) {
        $user_id = $this->getAuthUserId($request);
        
        if ($user_id == 0) {
            return response()->json(['status' => 'error', 'message' => "User is not Authed"]);
        }

        $_items = Parking::whereIn('availability', $request->type)->get();
        return response()->json(['status' => true, 'data' => $_items]);
    }

}
