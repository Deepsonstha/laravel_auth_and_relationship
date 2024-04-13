<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mobile;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function storeMobile(Request $request)
    {
        $mobile = new Mobile();

        $mobile->mobile_name = $request->mobile_name;
        $customerID = $request->customer_id;
        $customer = Customer::find($customerID);
        if (!$customer) {
            return responseError("Customer not found", 404);
        }

        $customer->mobile()->save($mobile);
        return responseSuccessMsg("Successfully Created Mobile", 200);
    }

    public function getMoileCustomer($id)
    {
        $mobile = Mobile::find($id);
        if (!$mobile) {
            return responseError("Mobile not found", 404);
        } else {
            $customer = $mobile->customer;
            if (!$customer) {
                return responseError("Customer not found", 404);
            } else {
                return responseSuccess($customer, "Successfully get", 200);
            }
        }

    }
}
