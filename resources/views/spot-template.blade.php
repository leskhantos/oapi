<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ URL::asset('favicon-16x16.png') }}" type="image/png" sizes="16x16"/>
    <link rel="icon" href="{{ URL::asset('favicon-32x32.png') }}" type="image/png" sizes="32x32"/>
    <link rel="icon" href="{{ URL::asset('favicon-96x96.png') }}" type="image/png" sizes="96x96"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>HotSpot</title>
</head>
<body>
  <div id="spot-template">
    <spot-template
        :data="{{ json_encode($data) }}"
    />
  </div>
  <script src="{{ env('APP_URL') . '/js/app.js' }}"></script>
</body>
</html>
