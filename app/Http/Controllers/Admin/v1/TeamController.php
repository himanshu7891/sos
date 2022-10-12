<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Team;
use App\Http\Requests\Admin\v1\StoreTeamRequest;
use App\Http\Requests\Admin\v1\UpdateTeamRequest;
use DataTables;

class TeamController extends Controller
{
    
    public function index(Request $request) {

        if($request->ajax()) {

            $data = Team::get();

            return Datatables::of($data)
                ->addColumn('team_code', function($data) {
                    return $data->team_code;
                })
                ->addColumn('team_name', function($data) {
                    return $data->team_name;
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

        return view('admin.v1.team.index');
    }

    public function create() {
        $branches = Branch::get();
        return view('admin.v1.team.create', compact('branches'));
    }

    public function store(StoreTeamRequest $request) {
    
        $ins['branch_id'] = request('branch_id') ?? NULL;
        $ins['team_code'] = request('team_code') ?? NULL;
        $ins['team_name'] = request('team_name') ?? NULL; 

        $response = Team::insertGetId($ins);
        if($response) {
            return redirect()->route('team.index')->with('alert-success','Team craeted Successfully.');
        } else {
            return redirect()->route('team.index')->with('alert-error','Something went wrong!');
        }
    }

    public function edit(Request $request, $id) {
        $branches = Branch::get();
        $data = Team::find($id);
        return view('admin.v1.team.edit', compact('data','branches'));
    }

    public function update(UpdateTeamRequest $request, $id) {
        $update['branch_id'] = request('branch_id') ?? NULL; 
        $update['team_name'] = request('team_name') ?? NULL; 

        $response = Team::whereId($id)->update($update);
        if($response) {
            return redirect()->route('team.index')->with('alert-success','Team updated Successfully.');
        } else {
            return redirect()->route('team.index')->with('alert-error','Something went wrong!');
        }
    }

    public function delete(Request $request, $id) {
        $data = Team::find($id);
        if($data) {
            $response = Team::whereId($id)->delete();
            if($response) {
                return redirect()->route('team.index')->with('alert-success','Team deleted Successfully.');
            } else {
                return redirect()->route('team.index')->with('alert-error', "Something went wrong");
            }
        } else {
            abort(404);
        }
    }

}
