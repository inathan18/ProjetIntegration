<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fournisseur;
use App\Http\Controllers\NotificationsController;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;
use App\Http\Requests\NotificationRequest;
use App\Notifications\AcceptationFournisseur;

class NotificationsController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        Notifications::route()->notify(new AcceptationFournisseur($request->email));
    }

    public function store(NotificationRequest $request){
        try{
            $template = new Notification($request->all());
            $template->save();
        }

        catch(\Throwable $e){
            Log::debug($e);
        }
        return redirect()->route('Admins.Courriel');
        
    }
}
