@extends('layouts.master')

@section('content')



    <h1>@lang('form.equipos') de {{$nombre_responsable2}}<a href="{{ url('equipos/create') }}" class="btn btn-primary pull-right btn-sm">@lang('form.addnew') Equipo</a></h1>

    <fieldset>

        <div class="form-group" >

            <div class="input-group">

             <span class="input-group-btn">

                <a  id="sxxxdw3wsfg"  class="zxsdfgsd33" href="{{ url('custodio/{idzx3er}') }}">

                    <button class="zxsdfgsd33 btn btn-default" type="button">@lang('form.buscar')</button>

                </a>

              </span>

                {!! Form::open([

                            'method'=>'POST',

                            'url' => ['reasignarindexecho'],

                            'style' => 'display:inline'

                        ]) !!}

                {{Form::select('equipoidfull[]', array(), '',array('id' => 'equipoidfull','class' => 'doremfg67y id_serchf form-control','multiple'=>'multiple')) }}

                {{ Form::hidden('custodio_id', $custodio_id) }}

                {!! Form::submit('Asignar Equipos', ['class' => 'btn btn-danger btn-xs']) !!}

                {!! Form::close() !!}





            </div>

            <label for="equipoid">Equipo </label>





        </div>



    </fieldset>

    <div class="table">

        <table class="table table-bordered table-striped table-hover">

            <thead>

            <tr>

                <th>@lang('form.sno')</th><th>Sociedad</th><th>No. RPM (Cód.Barras)</th>

                <th>@lang('form.codint')</th>

                <th>Descripción (Marca - Modelo)</th><th>@lang('form.noser')</th><th>Estado<th>Actions</th>

            </tr>

            </thead>

            <tbody>

            <?php $x=0;?>

            @foreach($equipos as $item)

                <?php $x++;?>

                <tr>

                    <td>{{ $x }}</td>

                    <td>{{ $item->sociedad }}</td><td><a href="{{ url('equipos', $item->id) }}">{{ $item->codigo_barras }}</a></td>

                    <td>{{ $item->codigo_avianca }}</td>

                    <td>{{ $item->modelo_equipoxc->modelo }}-{{ $item->modelo_equipoxc->fabricante }} {{ $item->descripcion }}</td><td>{{ $item->no_serie }}</td><td>{{ $item->estado }}</td>

                    <td>

                        <a href="{{ url('equipos/' . $item->id . '/edit') }}">

                            <button type="submit" class="btn btn-primary btn-xs">@lang('form.update')</button>

                        </a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        <div class="pagination"> {!! $equipos->render() !!} </div>

    </div>



@endsection



@section('scripts')

    @include('layouts.partials.scripts')



    <script>

        function redirect (url) {

            var ua        = navigator.userAgent.toLowerCase(),

                isIE      = ua.indexOf('msie') !== -1,

                version   = parseInt(ua.substr(4, 2), 10);



            // Internet Explorer 8 and lower

            if (isIE && version < 9) {

                var link = document.createElement('a');

                link.href = url;

                document.body.appendChild(link);

                link.click();

            }



            // All other browsers can use the standard window.location.href (they don't lose HTTP_REFERER like IE8 & lower does)

            else {

                window.location.href = url;

            }

        }

        window.onload = function() {
            $(function () {

                $.fn.select2.defaults.set( "theme", "bootstrap" );

                //alert("hola");

                $('.zxsdfgsd33').click(function (e) {

                    e.preventDefault();

                    var a = $('#equipoidf').val();

                    var b = $('#sxxxdw3wsfg').attr('href');

                    var c = b.replace('{idzx3er}', a);

                    redirect(c);


                });

                ///////////////////////////////////////////////////////////////////////////////////


                $('.id_serchf').select2({

                    // Activamos la opcion "Tags" del plugin


                    language: "es",

                    placeholder: "Select Avianca Code",

                    tags: true,

                    tokenSeparators: [','],

                    templateResult: formatState,

                    ajax: {

                        dataType: 'json',

                        url: '{{ url("tags") }}',

                        delay: 250,

                        data: function (params) {

                            return {

                                term: params.term

                            }

                        },

                        processResults: function (data, page) {

                            return {

                                results: data

                            };

                        },

                    }

                });

                ///////////////////////////////////////////////////////////////////////////////////////////

                function formatState(state) {

                    if (!state.id) {
                        return state.text;
                    }

                    var $state = $(
                        '<span>' + state.id + ":" + state.text + '</span>'
                    );

                    return $state;

                };


                ///////////////////////////////////////////////////////////////////////////////////////


            });
        };




    </script>

@endsection

