<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApplicationShipController;
use Illuminate\Support\Facades\Gate;
use App\Filters\ApplicationFilters;

class ManagerApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApplicationFilters $filters)
    {   
        if (Auth::check()) {
            if (Gate::denies('manager-index-application')) {
                return view('gate.right');
            }
        }
        else {
            return view('gate.login');
        }

        $applications = Application::filter($filters)->get();
               
        return view('mnapplication.index', compact('applications', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        if (Auth::check()) {
            if (Gate::denies('manager-show-application', $application)) {
                return view('gate.right');
            }
        }
        else {
            return view('gate.login');
        }
        
        if ($application->viewed == false) {
            $application->viewed = true;
            $application->save();
        }
        return view('mnapplication.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        Gate::authorize('manager-update-application', $application);

        if ($request->accept == 'принять') {
            $application->id_accepted = Auth::id();
            $application->save();
            return redirect()->route('manager.applications.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
