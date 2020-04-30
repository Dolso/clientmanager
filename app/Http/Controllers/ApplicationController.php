<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApplicationShipController;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Gate::denies('client-index-application')) {
                return view('gate.right');
            }
        }
        else {
            return view('gate.login');
        }

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
        if (Auth::check()) {
            if (Gate::denies('client-create-application')) {
                return view('gate.right');
            }
        }
        else {
            return view('gate.login');
        }
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
        Gate::authorize('client-store-application', $application);
        //проверка времени
        $last_application = Application::where('id_creator', Auth::id())->orderBy('created_at','DESC')->first();
        if ($last_application != null) {
            if ((strtotime('now') - strtotime($last_application->created_at))/3600 < 24) {
                \Session::flash('flash_message', 'Еще не прошло 24 часа');
                return redirect()->route('applications.index');
            }
        }

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
        
        ApplicationShipController::ship('create_application', $application);

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
        if (Auth::check()) {
            if (Gate::denies('client-show-application', $application)) {
                return view('gate.right');
            }
        }
        else {
            return view('gate.login');
        }

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
        Gate::authorize('client-update-application', $application);

        if ($request->closed == 'закрыть') {
            $application->closed = true;
            $application->save();
            ApplicationShipController::ship('close', $application);
            return redirect()->route('applications.index');
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
