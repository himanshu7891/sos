<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Team;
use App\Models\Member;
use DataTables;
use Admin;

class MemberController extends Controller
{
    
    public function index(Request $request) {

        $query = Member::query();
            $query->with('team','branch');
            $data = $query->get();
            // dd($data[0]->member_code);

        if($request->ajax()) {

            $query = Member::query();
            $query->with('team','branch');
            $data = $query->get();

            return Datatables::of($data)
                ->addColumn('member_code', function($data) {
                    return $data->member_code;
                })
                ->addColumn('team_code', function($data) {
                    return $data['team']->team_code;
                })
                ->addColumn('branch_code', function($data) {
                    return $data['branch']->branch_code;
                })
                ->addColumn('name', function($data) {
                    return Admin::memberFullName($data->id);
                })
                ->addColumn('email', function($data) {
                    return $data->email ?? '';
                })
                ->addColumn('mobile', function($data) {
                    return $data->mobile ?? '';
                })
                ->addColumn('created_at', function($data) {
                    return date("Y-m-d H:i:s", strtotime($data->created_at));
                })
                ->addColumn('action', function($data) {
                    $html = '';

                    // $html .= '<a href="'.route('team.edit', $data->id).'" class="btn btn-sm btn-primary">Edit</a>';
                    // $html .= "&nbsp;&nbsp;";
                    // $html .= '<a href="'.route('team.delete', $data->id).'" class="btn btn-sm btn-danger delete-confirm" role="button">Delete</a>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.v1.member.index');
    }

}
