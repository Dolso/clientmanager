<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ApplicationShipped;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationShipController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public static function ship($status, Application $application)
    {
        //если заявка только что созданная
        if ($status == 'create_application') {
            $manager_ids = App\Rights::select('id_user')->where('rights','manager')->get();
            $emails = array();
            foreach ($manager_ids as $manager_id) {
                $manager = App\User::select('email')->where('id', $manager_id->id_user)->first();
                array_push($emails, $manager->id);
            }
            foreach ($emails as $recipient) {
                Mail::to($recipient)->send(new ApplicationShipped($application));
            }
        }

        //если это коммент
        if ($status == 'response') {
            //определяем последнее сообщение
            $comment = $application->comments()->orderBy('created_at','DESC')->first();
            //если это не менеджер
            if (Rights::where('id_user', $comment->id_creator)->count() == 0) {
                //присылаем всем менеджерам
                $manager = App\User::select('email')->where('id', $comment->id_creator)->first();               
                Mail::to($manager->email)->send(new ApplicationShipped($application, $comment));
            }
            //если это менеджер, отправляем сообщение юзеру
            else {
                $client = App\User::select('email')->where('id', $comment->id_creator)->first();
                Mail::to($client->email)->send(new ApplicationShipped($application, $comment));
            }
        }

        
        
    }
}
