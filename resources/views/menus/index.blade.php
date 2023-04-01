@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <h2 class="page-title">
                {{ __('Menus') }}
            </h2>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">

            <div class="alert alert-info">
                <div class="alert-title">Sample table page</div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('Menu') }}</th>
                                <th>{{ __('Controlador') }}</th>
                                <th>{{ __('Acción') }}</th>
                                <th>{{ __('Orden') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->menu }}</td>
                                <td>{{ $menu->controller }}</td>
                                <td>{{ $menu->action }}</td>
                                <td>{{ $menu->order }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if( $menus->hasPages() )
                <div class="card-footer pb-0">
                    {{ $menus->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
