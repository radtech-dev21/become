<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses =  Status::orderBy('id','DESC')->get();
        return view('admin.status.index',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->name = strtolower($request->name);
        $this->validate($request, [
            'name' => 'required|unique:statuses,name',
            'color_code' => 'required',
        ]);
        $input = $request->all();
        $input['color_code'] = str_replace('#', '', $input['color_code']);
        Status::create($input);
        return redirect('admin/status')->with('success', 'Status added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('admin.status.edit',compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $request->name = strtolower($request->name);
        $this->validate($request, [
            'name' => 'required|unique:statuses,name,'.$status->id,
            'color_code' => 'required',
        ]);
        $input = $request->all();
        $status->name = $input['name'];
        $status->color_code = str_replace('#', '', $input['color_code']);
        $status->save();
        return redirect('admin/status')->with('success', 'Status updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();
    }
}
