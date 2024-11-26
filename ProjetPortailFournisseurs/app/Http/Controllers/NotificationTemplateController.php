<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationTemplate;

class NotificationTemplateController extends Controller
{
    public function index(){

        $templates = NotificationTemplate::all();
        return view('templates.index', compact('templates'));
    }

    public function edit($id){
        $template = NotificationTemplate::findOrFail($id);
        return view ('templates.edit', compact('template'));
    }

    public function update(Request $request, $id){
        $template = NotificationTemplate::findOrFail($id);
        $template->update($request->only('subject', 'greeting', 'line1', 'line2'));

        return redirect()->route('templates.index')->with('success', 'Modèle mis à jour avec succès.' );
    }
}
