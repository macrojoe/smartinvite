<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invitado</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet"> <!--Añadimos el css generado con webpack-->
    </head>
    <body>
        <div id="appback" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
            <example-component></example-component><!--Añadimos nuestro componente vuejs-->
        </div>
        <div class="py-12">
            <h2 class="text-3xl font-bold text-center">¡Gracias {{$guest->name}}!</h2>
            <h3 class="text-2xl font-bold text-center">Nos vemos en {{$event->name}} el dia {{$event->date}}</h3>
            
        </div>
        <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
    </body>
</html>