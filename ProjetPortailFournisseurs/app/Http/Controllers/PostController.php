<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
  
class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        $posts = Post::get();
     
        return view('AJAX.posts', compact('posts'));
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
           
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
      
        return response()->json(['success' => 'Post created successfully.']);
    }
}