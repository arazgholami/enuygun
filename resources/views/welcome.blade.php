<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enuygun</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/654d2374f1.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .content a{
            color: white;
            width: 200px;
        }
        .content a:hover{
            color: white;
        }

        .title {
            font-size: 44px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #result{
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Enuygun
        </div>
        <p>
            Currency with minimum amount: <br>

            @isset($record)
                <span id="result">{{ $record->currency->name }} {{ $record->amount }}</span><br>
                Last update: <span id="date">{{ $record->date }}</span>
            @else
                <span id="result">No record.</span><br><span id="date"></span>
            @endisset
        </p>
        <a id="refresh" class="btn btn-primary">Fetch & Refresh</a>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#refresh').on('click', function(e){
        e.preventDefault();

        $('#result').html('...');
        $('#refresh').html('<i class="fa fa-refresh"></i>');


        $.post( "/refresh", function(data) {
            $("#result").html(data.currency.name + ' ' + data.amount);
            $("#date").html(data.date);
        });

        $('#refresh').html('Fetch & Refresh');
    });

</script>

</body>
</html>
