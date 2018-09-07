

<html>
<head>
  <title>Timothy Lee's website</title>
</head>
<body>
  <header>
    <div class="links">
           <a href="{{ url('about') }}">About</a>
		   <a href="{{ url('news') }}">News</a>
		   <a href="{{ url('projects') }}">Projects</a>
		   <a href="{{ url('contact') }}">Contact </a>
           <a href="https://www.linkedin.com/in/timothy-lee-233769b9/"> Linkedin</a>
           <a href="https://github.com/timothyJLee">Github</a>
           <a href="https://twitter.com/timothyJLeeCS">Twitter</a>
		   <a href="https:/timsshowcase.wordpress.com">Wordpress</a>		    
    </div>
  </header>
  <div id="container">
    @yield('content')
  </div>
  <footer>
    <br><br>this is a footer
  </footer>
</body>
</html>

