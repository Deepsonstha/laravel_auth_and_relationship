<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->save();
        return responseSuccessMsg("Successfully Created", 200);
    }

    public function getCustomerModile($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return responseError("Customer not found", 404);
        } else {

            $mobile = $customer->mobile;
            if (!$mobile) {
                return responseError("Mobile not found", 404);
            } else {

                return responseSuccess($mobile, "Successfully get", 200);
            }
        }

    }
}
