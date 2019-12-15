<?php

namespace App\Http\Controllers;

use App\Http\Requests\HireUpdateRequest;
use App\Hire;
use Session;
use URL;

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
        if(!$hire->is_active) {
            abort(404);
        }
        else {
            if(!Session::has('url') || empty(Session::get('url'))) {
                Session::put('url', URL::previous());
            }
            return view('admin.hire.edit', [
                'vehicle' => $hire->vehicle,
                'hire' => $hire
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HireUpdateRequest $request
     * @param  \App\Hire $hire
     * @return \Illuminate\Http\Response
     */
    public function update(HireUpdateRequest $request, Hire $hire)
    {
        // If hire failed to updated (conflicts with another reservation/hire), 
        // redirect back to user and flash error messages
        if (!$hire->update($request->all()) && $hire->conflicts) {
            return back()->withInput()->withErrors($hire->conflict_data, 'hires');
        }
        
        Session::flash('status', [
            'hire' => 'Successfully updated hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$hire->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);

        $url = Session::pull('url');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hire $hire)
    {
        $hire->delete();

        Session::flash('status', [
            'hire' => 'Successfully deleted hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$hire->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);

        return back();
    }
}
