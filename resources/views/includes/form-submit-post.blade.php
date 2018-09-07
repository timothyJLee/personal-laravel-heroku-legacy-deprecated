


<h4>Create post</h4>
<form id="save_post" method="post" action="{{ route('store') }}">
  {{ csrf_field() }}
  <div>
    <p>Title</p>
    <input type="text" id="title" name="title" value="{{ old('title') }}">
  </div>
  
  <div>
    <p>Body</p>
    <textarea id="body" name="body">{{ old('body') }}</textarea>
  </div>
  
  <div>
    <input type="submit" value="Save">
  </div>
</form>
