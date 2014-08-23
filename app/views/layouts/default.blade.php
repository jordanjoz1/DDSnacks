<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div data-role="page">

  @include('includes.header')
  
    <div data-role="main" class="ui-content">
			@yield('content')
    </div>
    
    @include('includes.footer')
</div>
</body>
</html>
