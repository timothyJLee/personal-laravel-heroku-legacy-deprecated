<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;

use App\Post;
use App\User;
use Auth;

class PostsController extends Controller
{
    //

  public function __construct() {
    $this->middleware('auth')->only('store');
  }

  public function show($id) {
  	$post = Post::findOrFail($id);
   	return view('post', ['post' => $post]);
  }


	public function index() {
      $active_users = User::active()->get();
    	$posts = Post::search(Input::get('search'))->orderBy('created_at', 'desc')->paginate(6);
    	return view('posts', ['posts' => $posts, 'active_users' => $active_users]);
  	}

  public function store(PostRequest $request) {
  	Post::create([
  		'title' => $request->title,
  		'body' => $request->body,
      'user_id' => Auth::id()
  		]);
  	return redirect('posts');
	}

  public function edit(Request $request) {
    $post = Post::findOrFail($request->id);
    $this->authorize('update', $post);
    return view('post_edit', ['post' => $post]);
  }
 
  public function update(PostRequest $request) {
    $post = Post::findOrFail($request->id);
    $this->authorize('update', $post);
    $post->update([
      'title' => $request->title,
      'body' => $request->body
      ]); 
    return redirect('posts');
  }

  public function destroy(Request $request) {
    $post = Post::findOrFail($request->id);
    $this->authorize('delete', $post);
    $post->delete();
    return redirect('posts');
  }
}
