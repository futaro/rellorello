<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <application></application>
</div>
<script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]) . PHP_EOL; ?>
</script>
<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
