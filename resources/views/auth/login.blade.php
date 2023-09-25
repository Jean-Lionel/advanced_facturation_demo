<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>USINE PROTHEM</title>
  <link rel="stylesheet" href="{{ asset('login_folder/style.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="bg"></div>

<form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="form-field">
    <input type="email" placeholder="Email / Username" name="email" value="{{ old('email') }}"  required/>
  </div>

  <div class="form-field">
    <input type="password" name="password" required placeholder="Password" required/>                         </div>

  <div class="form-field">
    <button class="btn" type="submit">Log in</button>
  </div>
</form>
<!-- partial -->

</body>
</html>
