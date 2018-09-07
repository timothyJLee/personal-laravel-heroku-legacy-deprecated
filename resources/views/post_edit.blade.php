@extends('layouts.app')
 
@section('content')
  
  @include('includes.errors')
 
  {{ Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PATCH']) }}
    <p>{{ Form::text('title', old('title')) }}</p>
    <p>{{ Form::textarea('body', old('body')) }}</p>
    <p>{{ Form::submit('Save', ['name' => 'submit']) }}</p>
  {{ Form::close() }}
 
@endsection