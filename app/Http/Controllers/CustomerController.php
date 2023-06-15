<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CustomerController extends Controller
{
    // Insert New Customer
    public function insertCustomer($user_id, $username, $gender, $dob) {
        $customer = new Customer();
        $customer->id = Uuid::uuid4();
        $customer->user_id = $user_id;
        $customer->username = $username;
        $customer->gender = $gender;
        $customer->dob = $dob;
        $customer->save();
    }

    // Update Customer
    public function updateCustomer($user_id, $username, $gender, $dob) {
        $customer = Customer::where('user_id', $user_id)->first();
        $customer->username = $username;
        $customer->gender = $gender;
        $customer->dob = $dob;
        $customer->save();
    }
}
