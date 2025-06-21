<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MailServiceData;
use Carbon\Carbon;
use Auth;

class StatisticsController extends Controller{


    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * This function is used to show Statistics page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index(Request $request){
        $input = $request->all();
        return view('statistics-graphs', ['input' => $input]);
    }


    /**
     * This function is used to show statistics of sent emails
     * @param Request $request
     * @return string
     */
    function ajax_email_sent(Request $request){
        $input = $request->all();

        $obj = new MailServiceData();
        $labelsArray = $resultArray = [];

        //Get the number of days for which the data needs to be shown
        $days = $input['days'];

        //Fetch historical data from mailservicedata table for current user in order to show statistics in graphical form
        $data = $obj->selectRaw("COUNT(*) count, DATE_FORMAT(created_at, '%d-%m-%Y') date")
        ->where('created_at', '>=', Carbon::today()->subDays($days))
        ->where('user_id', Auth::id())
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get()->toArray();
        foreach ($data as $key => $row) {
            $labelsArray[$key+1] = $row['date'];
            $resultArray[$key+1] = $row['count'];
        }

        $labels = $result = [];
        for ($i = 1; $i <= $days; $i++) {
            $date = Carbon::today()->subDays($i-1)->format('d-m-Y');
            $key =  array_search($date, $labelsArray);
            $value = 0;
            if(in_array($date, $labelsArray)){
                $value = $resultArray[$key];
            }
            $labels[$i] = date('d M', strtotime($date));
            $result[$i] = $value;
        }
        $labels = array_reverse(array_values($labels));
        $result = array_reverse(array_values($result));
        return json_encode(['labels' => $labels, 'result' => $result]);
    }

    /**
     * This function is used to show revenue statistics
     * @param Request $request
     * @return string
     */
    function ajax_revenue_graphs(Request $request){
        $input = $request->all();

        $obj = new MailServiceData();
        $labelArray = $resultArray = [];

        //Get the number of days for which the data needs to be shown
        $days = $input['days'];
        //Fetch revenue data for current user (Note: Data is based only on final amount)
        $data = $obj->selectRaw("SUM(final_amount) count, DATE_FORMAT(convert_date, '%d-%m-%Y') date")
        ->where('convert_date', '>=', Carbon::today()->subDays($days))
        ->where('user_id', Auth::id())
        ->where('status', 2)
        ->whereNotNull('convert_date')
        ->groupBy('date')
        ->get()->toArray();
        foreach ($data as $key => $row) {
            $labelArray[$key+1] = $row['date'];
            $resultArray[$key+1] = $row['count'];
        }

        $labels = $result = [];
        for ($i = 1; $i <= $days; $i++) {
            $date = Carbon::today()->subDays($i-1)->format('d-m-Y');
            $key =  array_search($date, $labelArray);
            $value = 0;
            if(in_array($date, $labelArray)){
                $value = $resultArray[$key];
            }
            $labels[$i] = date('d M', strtotime($date));
            $result[$i] = $value;
        }
        $labels = array_reverse(array_values($labels));
        $result = array_reverse(array_values($result));
        return json_encode(['labels' => $labels, 'result' => $result]);
    }

    /**
     * This function is used to show line graph based on number of customer conversations
     * @param Request $request
     * @return string
     */
    function ajax_customer_conversation(Request $request){
        $input = $request->all();

        $obj = new MailServiceData();
        $labelsForApprovedQuotes = $resultForApprovedQuotes = [];
        $labelsForAllQuotes = $resultForAllQuotes = [];

        //Get the number of days for which the data needs to be shown
        $days = $input['days'];

        //Fetch the data for approved quotes i.e. with status = 2
        $data = $obj->selectRaw("COUNT(*) count, DATE_FORMAT(convert_date, '%d-%m-%Y') date")
        ->where('convert_date', '>=', Carbon::today()->subDays($days))
        ->where('user_id', Auth::id())
        ->where('status', 2)
        ->whereNotNull('convert_date')
        ->groupBy('date')
        ->get()->toArray();

        foreach ($data as $key => $row) {
            $labelsForApprovedQuotes[$key+1] = $row['date'];
            $resultForApprovedQuotes[$key+1] = $row['count'];
        }

        //Fetch the data for all quotes with any status
        $dataForAllQuotes = $obj->selectRaw("COUNT(*) count, DATE_FORMAT(created_at, '%d-%m-%Y') date")
        ->where('created_at', '>=', Carbon::today()->subDays($days))
        ->where('user_id', Auth::id())
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get()->toArray();


         foreach ($dataForAllQuotes as $key1 => $row) {
            $labelsForAllQuotes[$key1+1] = $row['date'];
            $resultForAllQuotes[$key1+1] = $row['count'];
        }

        $graphLabelsForApprovedQuotes = $graphResultForApprovedQuotes = [];
        for ($i = 1; $i <= $days; $i++) {
            $date = Carbon::today()->subDays($i-1)->format('d-m-Y');
            $key =  array_search($date, $labelsForApprovedQuotes);
            $value = 0;
            if(in_array($date, $labelsForApprovedQuotes)){
                $value = $resultForApprovedQuotes[$key];
            }
            $graphLabelsForApprovedQuotes[$i] = date('d M', strtotime($date));
            $graphResultForApprovedQuotes[$i] = $value;
        }


        $graphLabelsForAllQuotes = $graphResultForAllQuotes = [];
        for ($i = 1; $i <= $days; $i++) {
            $date = Carbon::today()->subDays($i-1)->format('d-m-Y');
            $key =  array_search($date, $labelsForAllQuotes);
            $value = 0;
            if(in_array($date, $labelsForAllQuotes)){
                $value = $resultForAllQuotes[$key];
            }
            $graphLabelsForAllQuotes[$i] = date('d M', strtotime($date));
            $graphResultForAllQuotes[$i] = $value;
        }
        $graphLabelsForApprovedQuotes = array_reverse(array_values($graphLabelsForApprovedQuotes));
        $graphResultForApprovedQuotes = array_reverse(array_values($graphResultForApprovedQuotes));
        $graphResultForAllQuotes = array_reverse(array_values($graphResultForAllQuotes));
        return json_encode(['labels' => $graphLabelsForApprovedQuotes, 'result' => $graphResultForApprovedQuotes, 'result1' => $graphResultForAllQuotes]);
    }


    /**
     * This function is used to show graphs for popular origins
     * @param Request $request
     * @return string
     *
     */
    function ajax_popular_origin(Request $request){
        $input = $request->all();

        //Get the number of days for which the data needs to be shown
        $days = $input['days'];
        $origin  = 'Origin';
        $data = MailServiceData::join('mailservice_extrafield', function($join) {
          $join->on('mailservicedata.id', '=', 'mailservice_extrafield.mailservice_id');
        })
        ->selectRaw("COUNT(mailservice_extrafield.id) as count, field1_value as date")
        ->where('mailservicedata.created_at', '>=', Carbon::today()->subDays($days))
        ->where('mailservicedata.user_id', Auth::id())
        ->where('mailservice_extrafield.field_name',  $origin)
        ->groupBy('mailservice_extrafield.field1_value')
        ->get()->toArray();
        $labels = $result = [];
        foreach ($data as $key => $row) {
            $labels[$key+1] = $row['date'];
            $result[$key+1] = $row['count'];
        }
        $labels = array_reverse(array_values($labels));
        $result = array_reverse(array_values($result));
        return json_encode(['labels' => $labels, 'result' => $result]);
    }


    /**
     * This function is used to show Popular Destination graph
     * @param Request $request
     * @return string
     */
    function ajax_popular_destination(Request $request){
        $input = $request->all();

        //Get the number of days for which the data needs to be shown
        $days = $input['days'];
        $destination = 'destination';
        $data = MailServiceData::join('mailservice_extrafield', function($join) {
          $join->on('mailservicedata.id', '=', 'mailservice_extrafield.mailservice_id');
        })
        ->selectRaw("COUNT(mailservice_extrafield.id) as count, field1_value as date")
        ->where('mailservicedata.created_at', '>=', Carbon::today()->subDays($days))
        ->where('mailservicedata.user_id', Auth::id())
        ->where('mailservice_extrafield.field_name',  $destination)
        ->groupBy('mailservice_extrafield.field1_value')
        ->get()->toArray();
        $labels = $result = [];
        foreach ($data as $key => $row) {
            $labels[$key+1] = $row['date'];
            $result[$key+1] = $row['count'];
        }
        $labels = array_reverse(array_values($labels));
        $result = array_reverse(array_values($result));
        return json_encode(['labels' => $labels, 'result' => $result]);
    }

    /**
     * This function is used to show Avg Cost/Pound graph
     * @param Request $request
     * @return string
     */
    function ajax_avg_cost_per_pound(Request $request){
        $input = $request->all();

        $obj = new MailServiceData();
        $labelsArray = $resultArray = [];
        $days = $input['days'];
        $data = $obj->selectRaw("AVG(costPerPound) count, DATE_FORMAT(created_at, '%d-%m-%Y') date")
        ->where('created_at', '>=', Carbon::today()->subDays($days))
        ->where('user_id', Auth::id())
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get()->toArray();
        foreach ($data as $key => $row) {
            $labelsArray[$key+1] = $row['date'];
            $resultArray[$key+1] = $row['count'];
        }

        $labels = $result = [];
        for ($i = 1; $i <= $days; $i++) {
            $date = Carbon::today()->subDays($i-1)->format('d-m-Y');
            $key =  array_search($date, $labelsArray);
            $value = 0;
            if(in_array($date, $labelsArray)){
                $value = $resultArray[$key];
            }
            $labels[$i] = date('d M', strtotime($date));
            $result[$i] = $value;
        }
        $labels = array_reverse(array_values($labels));
        $result = array_reverse(array_values($result));
        return json_encode(['labels' => $labels, 'result' => $result]);
    }
   
}
