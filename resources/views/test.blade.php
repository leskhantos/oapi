<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="app">
        @if(isset($v1))
            {{ $v1}}
        @endif
        <br />
        @if(isset($v2))
            {{ $v2  }}
        @endif
        <br />@if(isset($v3))
            {{ $v3  }}
        @endif
        <br />
        @if(isset($v4))
            {{ $v4  }}
        @endif
        <br />
        @if(isset($v5))
            {{ $v5  }}
        @endif
        <br />
        @if(isset($v6))
            {{ $v6  }}
        @endif
        <br />
        @if(isset($v7))
            {{ $v7  }}
        @endif
        <br />
        @if(isset($v8))
        {{ $v8  }}
        @endif
        <br />

        <test></test>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>