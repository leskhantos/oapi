<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>Document</title>
</head>
<body>
  <div id="spot-template">
    <spot-template
        :v1="{{$v1}}"
        :v2="{{$v2}}"
        :v3="{{$v3}}"
        :v4="{{$v4}}"
        :v5="{{$v5}}"
        :v6="{{$v6}}"
        :v7="{{$v7}}"
        :v8="{{$v8}}"
    />
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
