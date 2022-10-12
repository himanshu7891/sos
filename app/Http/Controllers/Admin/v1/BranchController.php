<?php

namespace App\Http\Controllers\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Http\Requests\Admin\v1\StoreBranchRequest;
use App\Http\Requests\Admin\v1\UpdateBranchRequest;
use DataTables;

class BranchController extends Controller
{
    
    public function index(Request $request) {

        if($request->ajax()) {
            $data = Branch::with('team')->get();

            return Datatables::of($data)
                ->addColumn('branch_code', function($data) {
                    return $data->branch_code;
                })
                ->addColumn('team_code', function($data) {
                    return $data['team']->team_code;
                })
                ->addColumn('branch_name', function($data) {
                    return $data->branch_name;
                })
                ->addColumn('created_at', function($data) {
                    return date("Y-m-d H:i:s", strtotime($data->created_at));
                })
                ->addColumn('action', function($data) {
                    $html = '';

                    // $html .= '<a href="'.route('branch.edit', $data->id).'" class="btn btn-sm btn-primary">Edit</a>';
                    // $html .= "&nbsp;&nbsp;";
                    // $html .= '<a href="'.route('branch.delete', $data->id).'" class="btn btn-sm btn-danger delete-confirm" role="button">Delete</a>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.v1.branch.index');
    }

    public function create() {
        return view('admin.v1.branch.create');
    }

    public function store(StoreBranchRequest $request) {
        $ins['branch_code'] = request('branch_code') ?? NULL;
        $ins['branch_name'] = request('branch_name') ?? NULL; 

        $response = Branch::insertGetId($ins);
        if($response) {
            return redirect()->route('branch.index')->with('alert-success','Branch craeted Successfully.');
        } else {
            return redirect()->route('branch.index')->with('alert-error','Something went wrong!');
        }
    }

    public function edit(Request $request, $id) {
        $data = Branch::find($id);
        return view('admin.v1.branch.edit', compact('data'));
    }

    public function update(UpdateBranchRequest $request, $id) {
        $update['branch_name'] = request('branch_name') ?? NULL; 

        $response = Branch::whereId($id)->update($update);
        if($response) {
            return redirect()->route('branch.index')->with('alert-success','Branch updated Successfully.');
        } else {
            return redirect()->route('branch.index')->with('alert-error','Something went wrong!');
        }
    }

    public function delete(Request $request, $id) {
        $data = Branch::find($id);
        if($data) {
            $response = Branch::whereId($id)->delete();
            if($response) {
                return redirect()->route('branch.index')->with('alert-success','Branch deleted Successfully.');
            } else {
                return redirect()->route('branch.index')->with('alert-error', "Something went wrong");
            }
        } else {
            abort(404);
        }
    }

}
