<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rights;
use App\Http\Controllers\ApplicationShipController;
use Illuminate\Support\Facades\Gate;

class ApplicationCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function index(Application $application)
    {
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function create(Application $application)
    {
        if (Gate::allows('manager-show-application', $application) OR Gate::allows('client-show-application', $application)) {
            $comment = $application->comments()->make();
            return view('commentapplication.create', compact('application', 'comment'));
        }
        abort(403);       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Application $application)
    {
        if (Gate::allows('manager-show-application', $application) OR Gate::allows('client-show-application', $application) == false) {
            abort(403); 
        }
        $comment = $application->comments()->make();
 
        $comment->comment = $request->comment;
        $comment->id_creator = Auth::id();

        $comment->save();

        ApplicationShipController::ship('response', $application);
        
        if (Gate::allows('manager-show-application', $application)) {
            $application->answered = true;
            $application->save();
            return redirect()->route('manager.applications.show', $application);
        }

        if (Gate::allows('client-show-application', $application)) {
            $application->answered = false;
            $application->save();
            return redirect()->route('applications.show', $application);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @param  \App\ApplicationComment  $applicationComment
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application, ApplicationComment $applicationComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @param  \App\ApplicationComment  $applicationComment
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application, ApplicationComment $applicationComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @param  \App\ApplicationComment  $applicationComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application, ApplicationComment $applicationComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @param  \App\ApplicationComment  $applicationComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application, ApplicationComment $applicationComment)
    {
        //
    }
}
