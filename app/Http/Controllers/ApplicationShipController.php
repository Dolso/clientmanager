<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Application;
use App\Rights;
use App\User;
use App\Mail\ApplicationShipped;
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
    public static function ship ($status, Application $application)
    {
        //если заявка только что созданная
        if ($status == 'create_application') {
            $managers = Rights::where('rights','manager')->get();
            $emails = array();
            foreach ($managers as $manager) {
                $manager_email = User::where('id', $manager->id_user)->value('email');
                array_push($emails, $manager_email);
            }
            foreach ($emails as $manager_email) {
                Mail::to($manager_email)->send(new ApplicationShipped($status, $application));
            }
        }
        
        //при закрытии заявки
        if ($status == 'close') {
            //есть ли менеджер, принявший завку
            if ($application->id_accepted != null) {
                $manager_email = User::where('id', $application->id_accepted)->value('email');               
                Mail::to($manager_email)->send(new ApplicationShipped($status, $application));
            }
        }  

        //если это коммент
        if ($status == 'response') {
            //определяем последнее сообщение
            $comment = $application->comments()->orderBy('created_at','DESC')->first();
            //если это не менеджер
            if (Rights::where('id_user', $comment->id_creator)->count() == 0) {
                //присылаем менеджеру, который принял заявку
                $status = 'comment_to_manager';
                $manager_email = User::where('id', $application->id_accepted)->value('email');               
                Mail::to($manager_email)->send(new ApplicationShipped($status, $application, $comment));
            }
            //если это менеджер, отправляем сообщение юзеру
            else {
                $status = 'comment_to_client';
                $client_email = User::where('id', $application->id_creator)->value('email');
                Mail::to($client_email)->send(new ApplicationShipped($status, $application, $comment));
            }
        }

            
    }
}
