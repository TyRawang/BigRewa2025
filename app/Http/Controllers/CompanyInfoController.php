<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\CompanyInfoData;
use Auth;

class CompanyInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }


    /**
     * This function is used to save/update the company information via Company Information page
     * @param Request $request
     * @return $this
     */
    function save_company_info(Request $request)
    {
        $input = $request->all();
        $companyObj = new CompanyInfoData();
        $userId = Auth::user()->id;
        $data = $obj = $companyObj->where('user_id', $userId)->first();
        $rules = array(
            //'logo' => 'required',
            'name' => 'required',
            'email' => 'required|email|min:8|max:255',
            'mobile' => 'required|min:9',
            'address' => 'required',
            'toll_free_no' => 'required|min:9',
            'website' => 'required|url',
            'company_info' => 'required',
        );

        if ($data) {
            if ($request->hasFile('logo')) {
                $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048';
            }
        } else {
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048';
        }

        $validator = \Validator::make($input, $rules, array());
        //Check if all the inputs pass the necessary validation
        if ($validator->passes()) {
            if (empty($data)) {
                $obj = new CompanyInfoData();
                $obj->user_id = Auth::id();
            }

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath, $name);
                $obj->logo = $name;
            }

            $obj->name = $input['name'];
            $obj->email = $input['email'];
            $obj->mobile = $input['mobile'];
            $obj->address = $input['address'];
            $obj->toll_free_no = $input['toll_free_no'];
            $obj->website = $input['website'];
            $obj->company_info = $input['company_info'];

            $obj->save();

            if (empty($data)) {
                return redirect('/company-info')->with('success_message', 'Saved successfully');
            }

            return redirect('/company-info')->with('success_message', 'Updated successfully');
        }
        //If any of the validation fails, show the same page with errors
        return Redirect::back()->withErrors($validator)->withInput();
    }

    /**
     * This function is used to show Company Information page
     * @return $this
     */
    public function index()
    {
        $companyData = CompanyInfoData::where('user_id', \Auth::id())->first();
        return view('company-info')->with(['companyData' => $companyData]);
    }

}

