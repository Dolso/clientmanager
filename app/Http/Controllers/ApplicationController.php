<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApplicationShipController;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applications = Application::where('id_creator', Auth::id())->get();
        
        return view('application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Order::class);        

        $application = new Application();
        return view('application.create', compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Application $application)
    {
        //$this->authorize('create', Order::class);
        $data = $this->validate($request, [
            'topic' => 'required|min:4',
            'message' => 'required|min:10',
        ]);
        $application->file_name = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('files');
        $application->file_path = $path;

        $application->topic = $request->topic;
        $application->message = $request->message;
        $application->id_creator = Auth::id();

        $application->save();
        
        //ship::('create_application', $application);

        return redirect()->route('applications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {

        return view('application.show', compact('application'));      
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
        if ($request->closed == 'закрыть') {
            $application->closed = true;
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
