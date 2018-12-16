<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">


        <title>Kanban</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
            <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>

        <div id="app">
            <div class="container">
                <kanban-board :deliverables-todo="{{$DeliverablesTodo}}" :deliverables-doing="{{$DeliverablesDoing}}" :deliverables-done="{{$DeliverablesDone}}"></kanban-board>


                {{-- <h3>Visibility Draggable</h3>
                <visibility-draggable :deliverables-visible="{{$deliverablesVisible}}" :deliverables-not-visible="{{$deliverablesNotVisible}}"></visibility-draggable>
                 --}}
            </div>
        </div>
        <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>
    </body>
</html>
