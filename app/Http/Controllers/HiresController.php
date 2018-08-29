<?php

namespace App\Http\Controllers;

use App\Http\Requests\HireRequest;
use App\Vehicle;
use App\Hire;
use Session;

class HiresController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function edit(Hire $hire)
    {
        return view('admin.hire.edit', [
            'vehicle' => $hire->vehicle,
            'hire' => $hire
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HireRequest $request
     * @param  \App\Hire $hire
     * @return \Illuminate\Http\Response
     */
    public function update(HireRequest $request, Hire $hire)
    {
        $hire->update($request->all());

        Session::flash('status', [
            'hire' => 'Successfully updated active hire!'
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $hire->vehicle
        ]);
    }
}
