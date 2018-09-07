
@extends('layouts.app')

@section('content')

@if (Auth::check())
  @include('includes.errors')
  @include('includes.form-submit-post')
@endif

<h3>Posts</h3>
 
 @if (Auth::check() && Auth::user()->hasPermissionTo('post_create'))
   {{ Form::open(['route' => ['posts.index'], 'method' => 'GET']) }}
  <p>{{ Form::text('search', old('search'), array('placeholder'=>'Search')) }}</p>
  <p>{{ Form::submit('Search') }}</p>
{{ Form::close() }}
@endif

@forelse ($posts as $post)
  <p>{{ $post->title }}</p>
  <a href="{{URL::to('/')}}/post/{{ $post->id }}">Go</a>
<p>By {{ $post->user->name }} on {{ $post->created_at }}</p>
@if($post->comments && is_object($post->comments))
  <span>{{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }}</span>
  @endif

@if (Auth::check() && ($post->user_id == Auth::id() || Auth::user()->hasRole('administrator')))
  <a href="{{URL::to('/')}}/post/{{ $post->id }}/edit">Edit</a>
  <form action="{{URL::to('/')}}/post/{{ $post->id }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }} 
  <button type="submit">Delete</button>
</form>
@endif
@empty
  <p>No posts</p>
@endforelse

@if (count($posts))
  {{ $posts->links() }}
@endif

<h3>Active users</h3>
@forelse ($active_users as $user)
  <p>{{ $user->name }}</p>
@empty
  <p>No users</p>
@endforelse

{{ $user->last_login }}

@endsection


