<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rights;
use App\Http\Controllers\ApplicationShipController;

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
        $comment = $application->comments()->make();
        return view('commentapplication.create', compact('application', 'comment'));
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
        //$data = $this->validate($request, [
        //    'topic' => 'required|min:4',
        //    'message' => 'required|min:10',
        //]);
        $comment = $application->comments()->make();
 
        $comment->comment = $request->comment;
        $comment->id_creator = Auth::id();

        $comment->save();

        //ship::('response', $application);

        return redirect()->route('applications.show', $application);
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
