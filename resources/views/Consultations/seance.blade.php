@extends('layouts.app')

@section('content')
<div class="p-4">
    @include('flash::message')
</div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('crud.suiver') @lang('models/seance.plural')</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header col-md-12">
                            <div class=" p-0">
                                <div class="input-group input-group-sm float-sm-right col-md-3 p-0">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Recherche" id="table_search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">

                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 15%" class="text-center"> @lang('crud.numero')
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                            @lang('crud.nom')
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                            @lang('crud.prenom')
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                             @lang('crud.Date')
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                            @lang('crud.etat')
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                            @lang('crud.action')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($seance) > 0)
                                        @foreach ($seance as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->numero_dossier }}</td>
                                            <td class="text-center">{{ $item->nom }}</td>
                                            <td class="text-center">{{ $item->prenom }}</td>
                                            <td class="text-center">{{ date('Y-m-d', strtotime($item->date_rendez_vous)) }}</td>
                                            <td class="text-center">{{ $item->etat }}</td>
                                            <td class="project-actions text-right d-flex text-center">
                                                <form action="{{ route(\App\Models\Consultation\Consultation::OrientationType() . '.seancePresent', $item->id) }}" method="post">                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm presence-btn">
                                                        <i class="fas fa-check"></i>
                                                        @lang('crud.presence')
                                                    </button>
                                                </form>
                                                <form action="{{ route(\App\Models\Consultation\Consultation::OrientationType().'.seanceAbsent', $item->id) }}" method="post" class="ml-2">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm absence-btn">
                                                        <i class="fas fa-times"></i>
                                                        @lang('crud.absence')
                                                    </button>
                                                </form>
                                                
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">@lang('messages.not_found')</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                @include('adminlte-templates::common.paginate', ['records' => $seance])
                            </div>
                             
                        </div>

                       

                       
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection