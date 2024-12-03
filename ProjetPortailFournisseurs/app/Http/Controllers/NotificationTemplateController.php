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

    public function fetchTemplate(Request $request){
        $templateId = $request->input('template_id');
        $template = NotificationTemplate::find($templateId);

        if($template){
            return response()->json([
                'success' => true,
                'data' => [
                    'subject' => $template->subject,
                    'line1' => $template->line1,
                    'line2' => $template->line2,
                    'line3' => $template->line3,
                ],
                ]);
        }
        return response()->json(['success' => false, 'message' => 'Template not found']);
    }

    public function showForm()
    {
        $templates = NotificationTemplate::all();

        return view('admins.courriel', compact('templates'));
    }
}
