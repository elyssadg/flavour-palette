<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class SellerController extends Controller
{
    // Insert New Seller
    public function insertSeller($user_id, $catering_name, $description, $halal_certification, $business_permit, $address, $opening_hour, $closing_hour) {
        $seller = new Seller();
        $seller->id = Uuid::uuid4();
        $seller->user_id = $user_id;
        $seller->name = $catering_name;
        $seller->description = $description;
        $seller->halal_certification = $halal_certification;
        $seller->business_permit = $business_permit;
        $seller->address = $address;
        $seller->opening_hour = $opening_hour;
        $seller->closing_hour = $closing_hour;
        $seller->save();
    }

    // Update Seller
    public function editCatering(Request $request) {
        $validation = [
            'catering_name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
            'halal_certification' => 'mimetypes:application/pdf,image/jpeg,image/jpg,image/png',
            'business_permit' => 'mimetypes:application/pdf,image/jpeg,image/jpg,image/png'
        ];

        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            $error_message = $validator->errors()->first();
            return response()->json([
                'error' => true,
                'error_message' => $error_message
            ]);
        }

        $seller = Seller::where('user_id', Auth::user()->id)->first();
        $seller->name = $request->catering_name;
        $seller->description = $request->description;
        if($request->halal_certification != null){
            $file = $request->file('halal_certification');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/halal_certification/', $file, $imageName);
            $seller->halal_certification = $imageName;
        }
        if($request->business_permit != null){
            $file = $request->file('business_permit');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/business_permit/', $file, $imageName);
            $seller->business_permit = $imageName;
        }
        $seller->address = $request->address;
        $seller->opening_hour = $request->opening_hour;
        $seller->closing_hour = $request->closing_hour;
        $seller->save();

        return response()->json([
            'error' => false,
            'redirect' => '/profile/edit'
        ]);
    }
}
