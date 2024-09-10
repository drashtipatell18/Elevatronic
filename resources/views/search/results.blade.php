    @extends('layouts.main')
    @section('content')
        <style>
            .setimage {
                object-fit: cover;
            }
        </style>
        <h1>Resultados de la búsqueda</h1>

        @if (
            $assignSpares->isEmpty() &&
                $clientes->isEmpty() &&
                $contracts->isEmpty() &&
                $customerTypes->isEmpty() &&
                $maininReview->isEmpty() &&
                $positions->isEmpty() &&
                $province->isEmpty() &&
                $staff->isEmpty() &&
                $users->isEmpty() &&
                $reviewType->isEmpty() &&
                $elevators->isEmpty() &&
                $elevatorsType->isEmpty() &&
                $marcas->isEmpty() &&
                $spareParts->isEmpty())
            <p>No se encontraron resultados para su consulta.</p>
        @else
            @if (!$assignSpares->isEmpty())
                <h2>Asignar repuestos</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Nombre del Tipo de Ascensor</th>
                            <th>Reemplazo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignSpares as $item)
                            <tr>
                                {{-- <td>{{ $item->nombre_del_tipo_de_ascensor }}</td> --}}
                                <td>
                                    <a href="{{ route('details.elevatortypes', $item->id) }}" class="text-blue">
                                        {{ $item->nombre_del_tipo_de_ascensor }}
                                    </a>
                                </td>
                                <td>{{ $item->sparePart ? $item->sparePart->nombre : 'N/A' }}</td> {{-- Check if sparePart is not null --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (!$clientes->isEmpty())
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
                        @foreach ($clientes as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('customer', $item->id) }}" class="text-blue">
                                        {{ $item->nombre }}
                                    </a>
                                </td>
                                <td>{{ $item->customertype->tipo_de_client }}</td>
                                <td>{{ $item->ruc }}</td>
                                <td>{{ $item->país }}</td>
                                <td>{{ $item->province->provincia }}</td>
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

            @if (!$contracts->isEmpty())
                <h2>Contratos</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>FECHA PROPUESTA</th>
                            <th>MONTO PROPUESTO</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FINAL</th>
                            <th>MONTO CONTRATO</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contracts as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->fecha_de_propuesta }}</td>
                                <td>{{ $item->monto_de_propuesta }}</td>
                                <td>{{ $item->fecha_de_inicio }}</td>
                                <td>{{ $item->fecha_de_fin }}</td>
                                <td>{{ $item->monto_de_contrato }}
                                <td>
                                    @if ($item->estado == 'activo')
                                        <div class="alerta boton-activo">
                                            <i class="fas fa-circle"></i> activo
                                        </div>
                                    @elseif ($item->estado == 'inactivo')
                                        <div class="alerta boton-inactivo">
                                            <i class="fas fa-circle"></i> inactivo
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


            @if (!$customerTypes->isEmpty())
                <h2>Tipos de clientes</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>tipo_de_client</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customerTypes as $item)
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

            @if (!$maininReview->isEmpty())
                <h2>Revisión de mantenimiento</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TIPO DE REVISIÓN</th>
                            <th>ASCENSOR</th>
                            <th>FECHA</th>
                            <th>HOR. INI</th>
                            <th>HOR. FIN</th>
                            <th>TÉCNICO</th>
                            <th>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maininReview as $item)
                            <tr>
                                <td>{{$item->id }}</td>
                                <td>
                                    <a href="{{ route('maint_in_review', $item->id) }}" class="text-blue">
                                        {{ $item->nombre_del_tipo_de_ascensor ?? '' }} {{-- Check if nombre_del_tipo_de_ascensor is not null --}}
                                    </a>
                                </td>
                                <td>{{ $item->elevator ? $item->elevator->nombre : '-' }}</td> 
                                <td>{{ $item->dirección }}</td>
                                <td>{{ $item->fecha_de_mantenimiento }}</td>
                                <td>{{ $item->hora_inicio }}</td>
                                <td>{{ $item->hora_fin }}</td>
                                <td>{{ $item->observaciónes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (!$positions->isEmpty())
                <h2>Posiciones</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>position</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $item)
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


            @if (!$province->isEmpty())
                <h2>Provincias</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Province</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($province as $item)
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

            @if (!$reviewType->isEmpty())
                <h2>Tipo de revisión</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviewType as $item)
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

            @if (!$staff->isEmpty())
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
                        @foreach ($staff as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('staff', $item->id) }}" class="text-blue">
                                        {{ $item->nombre }}
                                    </a>
                                </td>
                                <td>{{ $item->position->position }}</td>
                                <td>{{ $item->correo }}</td>
                                <td>{{ $item->teléfono }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (!$users->isEmpty())
                <h2>Usuarios</h2>
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
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->username }}</td>
                                <td>
                                    <a href="{{ route('user', $item->id) }}" class="text-blue">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->employee ? $item->employee->empleado : '' }}</td> {{-- Check if employee is not null --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


            @if (!$elevators->isEmpty())
                <h2>Ascensores</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>FECHA ENTREGA</th>
                            <th>TIPO DE ASCENSOR</th>
                            <th>NOMBRE</th>
                            <th>CLIENTE</th>
                            <th>PROVINCIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elevators as $item)
                            <tr class="td-head-center">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->fecha }}</td>
                                <td>{{ $item->tipo_de_ascensor }}</td>
                                <td>
                                    <a href="{{ route('view.elevator', $item->id) }}" class="text-blue">
                                        {{ $item->nombre }}
                                    </a>
                                </td>
                                <td>
                                    @if ($item->client)
                                        <a href="{{ route('view.customer', $item->client_id) }}" class="text-blue">
                                            {{ $item->client->nombre ?? '-' }}
                                        </a>
                                    @else
                                        {{ '-' }}
                                    @endif
                                </td>


                                <td>{{ $item->provincia }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


            @if (!$elevatorsType->isEmpty())
                <h2>Tipos de ascensor</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>nombre_de_tipo_de_ascensor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elevatorsType as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('elevatortypes', $item->id) }}" class="text-blue">
                                        {{ $item->nombre_de_tipo_de_ascensor }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (!$marcas->isEmpty())
                <h2>Marcas</h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Marca Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marcas as $item)
                            <tr>
                                <td>{{ $item->marca_nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if (!$spareParts->isEmpty())
                <h2>Piezas de repuesto</h2>
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
                        @foreach ($spareParts as $item)
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
