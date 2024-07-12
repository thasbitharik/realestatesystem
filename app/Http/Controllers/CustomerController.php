<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\PropertyBooking;
use App\Models\Reviews;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerRegister(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|min:10|:customers,customer_tp',
            'email' => 'required|email|regex:/(.*)\./i|unique:customers,customer_email',
            'password' => 'required',
            'confirmpassword' => 'required_with:password|same:password',
            'address' => 'required|max:255',
        ]);
        $data = new Customer();
        $data->customer_fname = $request->firstname;
        $data->customer_sname = $request->lastname;
        $data->customer_tp = $request->mobile;
        $data->customer_email = $request->email;
        $data->password = Hash::make($request->password);
        $data->address = $request->address;
        $data->save();

        return redirect()->route('home')->with('success','Registerd Successfully');
    }

    public function sellerRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|min:10|:customers,customer_tp',
            'email' => 'required|email|regex:/(.*)\./i|unique:users,email',
            'password' => 'required',
            'confirmpassword' => 'required_with:password|same:password',
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->tp = $request->mobile;
        $data->password = Hash::make($request->password);
        $data->roles = 2;
        $data->save();
        // dd($data);

        return redirect()->route('login')->with('success','Registered Successfully');
    }

    public function bookYourProperty(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $data = new PropertyBooking();
        $data->property_id = $request->property_id;
        $data->customer_id = $request->customer_id;
        $data->user_id = $request->user_id;
        $data->booking_date = $request->booking_date;
        $data->contract_plan = $request->contract_plan;
        $data->save();
        return redirect()->route('home')->with('success','Booked Successfully');

    }

    public function CustomerReview(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $data = new Reviews();
        $data->customer_id = $request->customer_id;
        $data->rating = $request->rating;
        $data->comment = $request->comment;
        $data->save();
        return redirect()->route('home')->with('success','Review Saved Successfully');

    }

    public function ContactUs(Request $request)
    {
        $data = new ContactUs();
        $data->customer_id = $request->customer_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->message = $request->message;
        $data->save();
        return redirect()->route('home')->with('success, Saved Succesfully');
    }
}
