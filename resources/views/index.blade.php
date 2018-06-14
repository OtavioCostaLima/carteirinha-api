<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
        <title>Sistema carteirinha</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
</script>
  </head>
  <body>

<div id="app">
<passport-passport-authorized-clients></passport-authorized-clients>
<passport-clients></passport-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>
</div>

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  </body>
</html>
