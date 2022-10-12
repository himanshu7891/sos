<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\ApplicationStatus;
use Illuminate\Http\Request;
use DataTables;
use Admin;

class ApplicationsController extends Controller
{
    //

    public function index(Request $request) {

        if($request->ajax()) {
            $data = Applications::with('status')->get();

            return Datatables::of($data)
            ->addColumn('application_code', function($data) {
                return Admin::getApplicationCode($data->id);
            })
            ->addColumn('member_code', function($data) {
                return Admin::getMemberCode($data->member_id);
            })
            ->addColumn('source_type', function($data) {
                return $data->source_type;
            })
            ->addColumn('source_name', function($data) {
                return $data->source_name;
            })
            ->addColumn('source_email', function($data) {
                return $data->source_email;
            })
            ->addColumn('source_gst_no', function($data) {
                return $data->source_gst_no;
            })
            ->addColumn('source_contact', function($data) {
                return $data->source_contact;
            })
            ->addColumn('status', function($data) {
                if($data->status["status"] == "approved") {
                    return "Approved";
                } elseif($data->status["status"] == "rejected") {
                    return "Rejected";
                } elseif($data->status["status"] == "relogin") {
                    return "Relogin";
                } elseif($data->status["status"] == "vehicle_change") {
                    return "Vehicle Change";
                } elseif($data->status["status"] == "logout") {
                    return "Logout";
                } else {
                    return "Pending";
                }
            })
            ->addColumn('created_at', function($data) {
                return date("Y-m-d H:i:s", strtotime($data->created_at));
            })
            ->addColumn('action', function($data){
                // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                $status = $data->status["status"];
                
                $html = "";
                $html .= "<select name='application_status' id='application_status' data-applicationid=".$data->id.">";
                if($status == 'pending'){ 
                     $html .= "<option value='pending' selected >Pending</option>";
                }else{
                     $html .= "<option value='pending'>Pending</option>";
                }
                if($status == 'approved'){ 
                     $html .= "<option value='approved' selected >Approved</option>";
                }else{
                     $html .= "<option value='approved'>Approved</option>";
                }
                if($status == 'rejected'){ 
                     $html .= "<option value='rejected' selected >Rejected</option>";
                }else{
                     $html .= "<option value='rejected'>Rejected</option>";
                }
                if($status == 'relogin'){ 
                     $html .= "<option value='relogin' selected >Relogin</option>";
                }else{
                     $html .= "<option value='relogin'>Relogin</option>";
                }
                if($status == 'vehicle_change'){ 
                     $html .= "<option value='vehicle_change' selected >Vehicle Change</option>";
                }else{
                     $html .= "<option value='vehicle_change'>Vehicle Change</option>";
                }
                if($status == 'logout'){ 
                     $html .= "<option value='logout' selected >Logout</option>";
                }else{
                     $html .= "<option value='logout'>Logout</option>";
                }
                $html .= "</select>";

                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.v1.application.index');
    }

    public function changeApplicationStatus(Request $request) {
        $response = ApplicationStatus::where('application_id',$request['applicationId'])->update(['status'=>$request['status']]);
        if($response) {
            return response()->json(['success'=>'Status updated successfully.']);
        } else {
            return response()->json(['error'=> 'Something went wrong!']);
        }
    }

}
