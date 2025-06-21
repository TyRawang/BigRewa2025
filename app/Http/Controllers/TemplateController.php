<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;

use App\Models\EmailTemplate;
use App\Models\ExtraField;
use Auth;

class TemplateController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */

    public function index()
    {
        $customObj = new EmailTemplate();
        //fetch templates from emailtemplate table and pass it to view
        $data = EmailTemplate::where('user_id', \Auth::id())
            ->orderBy('created_at', 'DESC')->paginate(10);
        $count_data = $customObj->where('user_id', Auth::id())->count();
        return view('emailtemplate', ['data' => $data, 'count_data' => $count_data]);
    }

    /**
     * This function will be called to show page to add a new template
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function template_add($id = null)
    {
        $customObj = new EmailTemplate();
        $data = $customObj->where('id', $id)->first();
        return view('template_form', ['data' => $data]);
    }

    /**
     * This function will be used to save a new template
     * @param Request $request
     * @return $this
     */
    function save_template(Request $request)
    {
        $input = $request->all();
        //validation rules array
        $rules = array(
            'title' => 'required',
            'email_template_token' => 'required',
        );

        $customObj = new EmailTemplate();
        $data = $obj = $customObj->where('id', $input['template_id'])->first();
        $validator = \Validator::make($input, $rules, array());
        if ($validator->passes()) {

            if (empty($data)) {
                $obj = new EmailTemplate();
                $obj->user_id = Auth::id();
            }
            $obj->title = $input['title'];
            $obj->email_template_token = trim($input['email_template_token']);
            $count_data = $customObj->where('user_id', Auth::id())->count();

            //check if user is already having two templates, in such case do not allow to add third template
            if ($count_data < 2) {
                $obj->save();
            } else {
                return redirect('template')->with('error_message', 'Sorry, you can not insert more than 2 templates.');
            }
            if (empty($data)) {
                return redirect('template')->with('success_message', 'Saved successfully');
            } else {
                return redirect('template')->with('success_message', 'Updated successfully');
            }

        }

        //If any of the validation fails, show the same page with validation error messages
        return Redirect::back()->withErrors($validator)->withInput();

    }

    /**
     * This function is used to delete a template based on id
     * @param $id
     * @return $this
     */
    function template_delete($id)
    {
        $customObj = new EmailTemplate();
        $data = $obj = $customObj->where('id', $id)->first();
        if ($data) {
            $data->delete();
            return redirect('template')->with('success_message', 'Deleted successfully');
        }
        return redirect('template')->with('error_message', 'Sorry!!, something went wrong');
    }

    /**
     * This function is used to make template with passed id as default template
     * @param $id
     * @return $this
     */
    function set_default($id)
    {
        $customObj = new EmailTemplate();
        $data = $obj = $customObj->where('id', $id)->first();
        if ($data) {
            $userTemplate = EmailTemplate::where('user_id', Auth::id())->get();
            foreach ($userTemplate as $key => $value) {
                $value->status = 'Inactive';
                $value->update();
            }
            $data->status = "Active";
            $data->update();
            return redirect('template')->with('success_message', 'Updated successfully');
        }
        return redirect('template')->with('error_message', 'Sorry!!, something went wrong');
    }

    /**
     * This function is used to set default template for admin
     * @param $id
     * @return $this
     */
    function set_admin_default($id)
    {
        $customObj = new EmailTemplate();
        $data = $obj = $customObj->where('id', $id)->first();
        if ($data) {
            $emailTemplate = EmailTemplate::where('user_id', Auth::id())->get();
            foreach ($emailTemplate as $key => $value) {
                $value->status = 'Inactive';
                $value->update();
            }
            return redirect('template')->with('success_message', 'Updated successfully');
        }
        return redirect('template')->with('error_message', 'Sorry!!, something went wrong');
    }

    /**
     * This method is used to show Extra Field Configuration page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function extra_mail_field(Request $request)
    {
        $input = $request->all();
        $data = ExtraField::where('user_id', Auth::id())->orderBy('sorted', 'ASC')->get();
        return view('extra_mail_field', ['input' => $input, 'data' => $data]);
    }

    /**
     * This function is used to save/update an extra field via Extra Field Configuration page
     * @param Request $request
     * @return string
     */
    function save_extra_mail_field(Request $request)
    {
        $input = $request->all();
        //validation rules array
        $rules = array(
            'field_name' => 'required',
            'field_type' => 'required',
        );
        $customObj = new ExtraField();
        $data = $obj = $customObj->where('id', $input['id'])->first();
        $validator = \Validator::make($input, $rules, array());
        if ($validator->passes()) {
            if (empty($data)) {
                $obj = new ExtraField();
                $obj->user_id = Auth::id();
            }
            $obj->field_name = $input['field_name'];
            $obj->field_type = $input['field_type'];
            $obj->field1_type = $input['field1_type'];
            $obj->save();
            if (empty($data)) {
                $json['status'] = 1;
                $json['message'] = ' <div class="alert alert-success">Saved successfully</div>';
            } else {
                $json['status'] = 2;
                $json['message'] = ' <div class="alert alert-success">Updated successfully</div>';
            }
        } else {
            $json['status'] = 0;
            $json['message'] = ' <div class="alert alert-danger">Please fill correct value</div>';
        }
        return json_encode($json);
    }

    /**
     * This function is used to delete any extra field
     * @param Request $request
     * @return string
     */
    function delete_extra_mail_field(Request $request)
    {
        $input = $request->all();
        $data = $obj = ExtraField::where('id', $input['id'])->first();
        if (!empty($data)) {
            $data->delete();
            $json['status'] = 1;
            $json['message'] = ' <div class="alert alert-success">Deleted successfully</div>';
        } else {
            $json['status'] = 0;
            $json['message'] = ' <div class="alert alert-danger">Something went wrong, Please try again</div>';
        }
        return json_encode($json);
    }

    /**
     * @param Request $request
     */
    function sorted_extra_field_frm(Request $request)
    {
        $input = $request->all();
        $sorted = 1;
        foreach ($input['arr'] as $id) {
            $data = ExtraField::where('id', $id)->first();
            $data->sorted = $sorted;
            $data->update();
            $sorted++;
        }

        echo "successfully";
    }
}
