<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeeklyRateRequest;
use App\WeeklyRate;
use Session;

class WeeklyRatesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weeklyRates = WeeklyRate::all();

        return view('admin.admin-weekly-rates', [
            'weeklyRates' => $weeklyRates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weekly-rate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WeeklyRateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WeeklyRateRequest $request)
    {
        $weeklyRate = WeeklyRate::create(array(
            'name' => $request->name,
            'weekly_rate_min' => $request->weekly_rate_min,
            'weekly_rate_max' => $request->weekly_rate_max
        ));

        Session::flash('status', [
            'weekly_rate_add' => 'Successfully created weekly rate!',
            'Name = '.$weeklyRate->getFullName()
        ]);

        return redirect()->route('admin.weekly-rates.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WeeklyRate  $weeklyRate
     * @return \Illuminate\Http\Response
     */
    public function edit(WeeklyRate $weeklyRate)
    {
        return view('admin.weekly-rate.edit', [
            'rate' => $weeklyRate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WeeklyRateRequest $request
     * @param  \App\WeeklyRate $weeklyRate
     * @return \Illuminate\Http\Response
     */
    public function update(WeeklyRateRequest $request, WeeklyRate $weeklyRate)
    {
        $weeklyRate->update($request->all());

        Session::flash('status', [
            'weekly_rate' => 'Successfully updated weekly rate!',
            'Name = '.$weeklyRate->getFullName()
        ]);

        return redirect()->route('admin.weekly-rates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeeklyRate  $weeklyRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeeklyRate $weeklyRate)
    {
        try {
            $weeklyRate->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'weekly_rate' => 'Successfully deleted weekly rate!',
            'Name = '.$weeklyRate->getFullName()
        ]);

        return redirect()->route('admin.weekly-rates.index');
    }
}
