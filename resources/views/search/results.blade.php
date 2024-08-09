@extends('layouts.main')
@section('content')
<h1>Search Results</h1>

    @if($assignSpares->isEmpty() && $clientes->isEmpty() && $contracts->isEmpty() && $elevators->isEmpty() && $marcas->isEmpty() && $spareParts->isEmpty())
        <p>No results found for your query.</p>
    @else
        @if(!$assignSpares->isEmpty())
            <h2>Assign Spares</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Nombre del Tipo de Ascensor</th>
                        <th>Reemplazo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignSpares as $item)
                        <tr>
                            {{-- <td>{{ $item->nombre_del_tipo_de_ascensor }}</td> --}}
                            <td>
                                <a href="{{ route('details.elevatortypes', $item->id) }}" class="text-blue">
                                    {{ $item->nombre_del_tipo_de_ascensor }}
                                </a>
                            </td>
                            <td>{{ $item->sparePart->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$clientes->isEmpty())
            <h2>Clientes</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo de Cliente</th>
                        <th>RUC</th>
                        <th>País</th>
                        <th>Provincia</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Teléfono Móvil</th>
                        <th>Correo Electrónico</th>
                        <th>Nombre del Contacto</th>
                        <th>Posición</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $item)
                        <tr>
                            <td>
                                <a href="{{ route('customer', $item->id) }}" class="text-blue">
                                    {{ $item->nombre }}
                                </a>
                            </td>
                            <td>{{ $item->tipo_de_cliente }}</td>
                            <td>{{ $item->ruc }}</td>
                            <td>{{ $item->país }}</td>
                            <td>{{ $item->provincia }}</td>
                            <td>{{ $item->dirección }}</td>
                            <td>{{ $item->teléfono }}</td>
                            <td>{{ $item->teléfono_móvil }}</td>
                            <td>{{ $item->correo_electrónico }}</td>
                            <td>{{ $item->nombre_del_contacto }}</td>
                            <td>{{ $item->posición }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$contracts->isEmpty())
            <h2>Contracts</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Ascensor</th>
                        <th>Fecha de Propuesta</th>
                        <th>Monto de Propuesta</th>
                        <th>Monto de Contrato</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Renovación</th>
                        <th>Cada Cuantos Meses</th>
                        <th>Observación</th>
                        <th>Estado Cuenta del Contrato</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $item)
                        <tr>
                            <td>
                                <a href="{{ route('ascensore', $item->id) }}" class="text-blue">
                                    {{ $item->ascensor }}
                                </a>
                            </td>
                            <td>{{ $item->fecha_de_propuesta }}</td>
                            <td>{{ $item->monto_de_propuesta }}</td>
                            <td>{{ $item->monto_de_contrato }}</td>
                            <td>{{ $item->fecha_de_inicio }}</td>
                            <td>{{ $item->fecha_de_fin }}</td>
                            <td>{{ $item->renovación }}</td>
                            <td>{{ $item->cada_cuantos_meses }}</td>
                            <td>{{ $item->observación }}</td>
                            <td>{{ $item->estado_cuenta_del_contrato }}</td>
                            <td>{{ $item->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


        @if(!$customerTypes->isEmpty())
            <h2>CustomerTypes</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>tipo_de_client</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerTypes as $item)
                        <tr>
                            <td>
                                <a href="{{ route('customer', $item->id) }}" class="text-blue">
                                    {{ $item->tipo_de_client }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$maininReview->isEmpty())
            <h2>MaintinRevieew</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>tipo_de_revisión</th>
                        <th>ascensor</th>
                        <th>dirección</th>
                        <th>provincia</th>
                        <th>supervisor</th>
                        <th>técnico</th>
                        <th>mes_programado</th>
                        <th>fecha_de_mantenimiento</th>
                        <th>hora_inicio</th>
                        <th>hora_fin</th>
                        <th>observaciónes</th>
                        <th>observaciónes_internas</th>
                        <th>solución</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maininReview as $item)
                        <tr>
                            <td>
                                <a href="{{ route('maint_in_review', $item->id) }}" class="text-blue">
                                    {{ $item->tipo_de_revisión }}
                                </a>
                            </td>
                            <td>{{ $item->ascensor }}</td>
                            <td>{{ $item->dirección }}</td>
                            <td>{{ $item->provincia }}</td>
                            <td>{{ $item->supervisor }}</td>
                            <td>{{ $item->técnico }}</td>
                            <td>{{ $item->mes_programado }}</td>
                            <td>{{ $item->fecha_de_mantenimiento }}</td>
                            <td>{{ $item->hora_inicio }}</td>
                            <td>{{ $item->hora_fin }}</td>
                            <td>{{ $item->observaciónes }}</td>
                            <td>{{ $item->observaciónes_internas }}</td>
                            <td>{{ $item->solución }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$positions->isEmpty())
            <h2>Positions</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>position</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($positions as $item)
                        <tr>
                            <td>
                                <a href="{{ route('staff', $item->id) }}" class="text-blue">
                                    {{ $item->position }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


        @if(!$province->isEmpty())
            <h2>Provincias</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Province</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($province as $item)
                        <tr>
                            <td>
                                <a href="{{ route('province', $item->id) }}" class="text-blue">
                                    {{ $item->provincia }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$reviewType->isEmpty())
            <h2>Review Type</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviewType as $item)
                        <tr>
                            <td>
                                <a href="{{ route('reviewtype', $item->id) }}" class="text-blue">
                                    {{ $item->nombre }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$staff->isEmpty())
            <h2>Personal</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>posición</th>
                        <th>correo</th>
                        <th>teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff as $item)
                        <tr>
                            <td>
                                <a href="{{ route('staff', $item->id) }}" class="text-blue">
                                    {{ $item->nombre }}
                                </a>
                            </td>
                            <td>{{ $item->posición }}</td>
                            <td>{{ $item->correo }}</td>
                            <td>{{ $item->teléfono }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$users->isEmpty())
            <h2>Users</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>username</th>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>employee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                        <tr>
                            <td>{{ $item->username }}</td>
                            <td>
                                <a href="{{ route('user', $item->id) }}" class="text-blue">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td>{{ $item->email  }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->employee }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


        @if(!$elevators->isEmpty())
            <h2>Elevators</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Contrato</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Marca</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Garantizar</th>
                        <th>Dirección</th>
                        <th>Ubigeo</th>
                        <th>Provincia</th>
                        <th>Técnico Instalador</th>
                        <th>Técnico Ajustador</th>
                        <th>Tipo de Ascensor</th>
                        <th>Cantidad</th>
                        <th>Quarters</th>
                        <th>NPisos</th>
                        <th>NContacto</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Descripción1</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elevators as $item)
                        <tr>
                            <td>{{ $item->imagen }}</td>
                            <td>{{ $item->contrato }}</td>
                            <td>
                                <a href="{{ route('elevator', $item->id) }}" class="text-blue">
                                    {{ $item->nombre }}
                                </a>
                            </td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->código }}</td>
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->cliente }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->garantizar }}</td>
                            <td>{{ $item->dirección }}</td>
                            <td>{{ $item->ubigeo }}</td>
                            <td>{{ $item->provincia }}</td>
                            <td>{{ $item->técnico_instalador }}</td>
                            <td>{{ $item->técnico_ajustador }}</td>
                            <td>{{ $item->tipo_de_ascensor }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>{{ $item->quarters }}</td>
                            <td>{{ $item->npisos }}</td>
                            <td>{{ $item->ncontacto }}</td>
                            <td>{{ $item->teléfono }}</td>
                            <td>{{ $item->correo }}</td>
                            <td>{{ $item->descripcion1 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$marcas->isEmpty())
            <h2>Marcas</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Marca Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marcas as $item)
                        <tr>
                            <td>{{ $item->marca_nombre }}</td>




                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if(!$spareParts->isEmpty())
            <h2>Spare Parts</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Foto de Repuesto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Frecuencia de Limpieza</th>
                        <th>Frecuencia de Lubricación</th>
                        <th>Frecuencia de Ajuste</th>
                        <th>Frecuencia de Revisión</th>
                        <th>Frecuencia de Cambio</th>
                        <th>Frecuencia de Solicitud</th>
                    </tr>
                </thead>
                <tbody>
                    view.sparepart
                    @foreach($spareParts as $item)
                        <tr>
                            <td>{{ $item->foto_de_repuesto }}</td>
                            {{-- <td>{{ $item->nombre }}</td> --}}
                            <td>
                                <a href="{{ route('sparepart', $item->id) }}" class="text-blue">
                                    {{ $item->nombre }}
                                </a>
                            </td>
                            <td>{{ $item->precio }}</td>
                            <td>{{ $item->descripción }}</td>
                            <td>{{ $item->frecuencia_de_limpieza }}</td>
                            <td>{{ $item->frecuencia_de_lubricación }}</td>
                            <td>{{ $item->frecuencia_de_ajuste }}</td>
                            <td>{{ $item->frecuencia_de_revisión }}</td>
                            <td>{{ $item->frecuencia_de_cambio }}</td>
                            <td>{{ $item->frecuencia_de_solicitud }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
@endsection
@push('scripts')
<script>
    $('.datatable').DataTable({
        responsive: true
    })
</script>
@endpush





