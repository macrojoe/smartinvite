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
            <h2 class="text-3xl font-bold text-center">¡Hola {{$guest->name}}!</h2>
            <p class="text-2xl text-center mt-2">Ha sido invitado a "{{$event->name}}" en la fecha {{$event->date}}</p>
            <p class="text-2xl text-center mt-2">¿Confirma su asistencia?</p>
            <form method="post" action="/i/{{$event->slug}}/{{$guest->slug}}/{{$code}}">
                @csrf
                <div class="mt-8 max-w-md mx-auto">
                    <div class="grid grid-cols-1 gap-6">
                    <div class="block">
                        <div class="mt-2 flex">
                            <div class="w-1/2">
                                <label class="inline-flex items-center">
                                <input {{$guest->guest_status_id == 1 ? 'checked' : ''}}  required name="guest[guest_status_id]" value="1" type="radio" class="rounded bg-gray-200 border-transparent focus:border-transparent focus:bg-gray-200 text-gray-700 focus:ring-1 focus:ring-offset-2 focus:ring-gray-500">
                                <span class="ml-2">Si, asistiré</span>
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label class="inline-flex items-center">
                                <input {{$guest->guest_status_id == 0 ? 'checked' : ''}} required name="guest[guest_status_id]" value="0" type="radio" class="rounded bg-gray-200 border-transparent focus:border-transparent focus:bg-gray-200 text-gray-700 focus:ring-1 focus:ring-offset-2 focus:ring-gray-500">
                                <span class="ml-2">No, no podré asistir</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <label class="block">
                        <span class="text-gray-700">Confirma tu correo electrónico</span>
                        <input required name="guest[email]" type="email" class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" placeholder="{{$guest->email}}" value="{{$guest->email}}">
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Confirma tu número teléfonico</span>
                        <input required name="guest[phone]" type="text" class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" placeholder="{{$guest->phone}}" value="{{$guest->phone}}">
                    </label>

                    <div class="assist">
                        <label class="block">
                            <span class="text-gray-700">Número de asistentes confirmados</span>
                            <select name="guest[confirmed_tickets]" class="block w-full mt-1 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                                @for($x = 0; $x < $guest->tickets; $x++ )
                                <option {{$guest->confirmed_tickets == $x + 1 ? 'selected' : ''}}>{{$x + 1}}</option>
                                @endfor
                            </select>
                        </label>
                        @for($x = 0; $x < $guest->tickets; $x++ )
                        <label class="block guestmenu" id='guestmenu-{{$x}}'>
                            <span class="text-gray-700">Elección de menú - Invitado #{{$x + 1}} </span>
                            <select required name="menu[{{$x}}]" class="block w-full mt-1 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                                @if(!isset($guest->menu[$x]))
                                <option disabled selected></option>
                                @endif
                                @foreach($event->menu as $menu)
                                    @if(isset($guest->menu[$x]))
                                        <option {{ $guest->menu[$x]->id == $menu->id ? 'selected' : ''}} value="{{$menu->id}}">{{$menu->name}}</option>
                                    @else
                                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                        @endfor
                    </div>
                    <!-- <label class="block">
                        <span class="text-gray-700">Full name</span>
                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" placeholder="">
                    </label> -->
                    <label class="block">
                        <span class="text-gray-700">Mensaje para los novios</span>
                        <textarea name="guest[message]" class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" rows="3">{{$guest->message}}</textarea>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Comentarios</span>
                        <textarea name="guest[comments]" class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" rows="3">{{$guest->comments}}</textarea>
                    </label>
                    <input type="submit" class="py-4 mt-1 font-bold block w-full rounded-md bg-blue-100 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0" value="Enviar">
                </div>
            </form>
        </div>
        <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
    </body>
</html>