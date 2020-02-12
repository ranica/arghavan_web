@extends('layouts.app')

@section('content')

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">

                        <div class="page-categories">
                            <h3 class="title text-center">اطلاعات پایه خودرو</h3>
                            <br />
                            <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center"
                                role="tablist">

                                @can('car_site')
                                    <li class="nav-item tabStyle active">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carSite"
                                            role="tablist">
                                            <i class="fas fa-parking"></i> پارکینگ
                                        </a>
                                    </li>
                                @endcan

                                @can('car_color')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carColor"
                                            role="tablist">
                                            <i class="fas fa-palette"></i>رنگ خودرو
                                        </a>
                                    </li>
                                @endcan

                                @can('car_fuel')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carFuel"
                                            role="tablist">
                                            <i class="fas fa-gas-pump"></i> سوخت خودرو
                                        </a>
                                    </li>
                                @endcan

                                @can('car_level')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carLevel"
                                            role="tablist">
                                            <i class="fas fa-car fa-2x"></i> تیپ خودرو
                                        </a>
                                    </li>
                                @endcan

                                @can('car_model')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carModel"
                                            role="tablist">
                                            <i class="fas fa-car-side"></i> مدل خودرو
                                        </a>
                                    </li>
                                @endcan

                                @can('car_system')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carSystem"
                                            role="tablist">
                                            <i class="fas fa-cog"></i> سیستم خودرو
                                        </a>
                                    </li>
                                @endcan

                                @can('car_type')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carType"
                                            role="tablist">
                                            <i class="fas fa-dice-d6"></i> نوع خودرو
                                        </a>
                                    </li>
                                @endcan

                                @can('car_plate_type')
                                    <li class="nav-item tabStyle">
                                        <a class="nav-link"
                                            data-toggle="tab"
                                            href="#carPlateType"
                                            role="tablist">
                                            <i class="fas fa-tags"></i>نوع پلاک خودرو
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                            <div class="tab-content tab-space tab-subcategories">
                                @can('car_site')
                                    <div class="tab-pane active" id="carSite">
                                        @include('base-parking.site.index')
                                    </div>
                                @endcan

                                @can('car_color')
                                    <div class="tab-pane" id="carColor">
                                        @include('base-parking.color.index')
                                    </div>
                                @endcan

                                @can('car_fuel')
                                    <div class="tab-pane" id="carFuel">
                                        @include('base-parking.fuel.index')
                                    </div>
                                @endcan

                                @can('car_level')
                                    <div class="tab-pane" id="carLevel">
                                        @include('base-parking.level.index')
                                    </div>
                                @endcan

                                @can('car_model')
                                    <div class="tab-pane" id="carModel">
                                        @include('base-parking.model.index')
                                    </div>
                                @endcan

                                @can('car_system')
                                    <div class="tab-pane" id="carSystem">
                                        @include('base-parking.system.index')
                                    </div>
                                @endcan

                                @can('car_type')
                                    <div class="tab-pane" id="carType">
                                        @include('base-parking.type.index')
                                    </div>
                                @endcan

                                @can('car_plate_type')
                                    <div class="tab-pane" id="carPlateType">
                                        @include('base-parking.plate_type.index')
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    document.pageData.carBase = {
        pageUrls: {
            carColors_index: '{{ route('carColors.index', '') }}',
            carColors_store: '{{ route('carColors.store') }}',
            carColors_update: '{{ route('carColors.update', '') }}',
            carColors_delete: '{{ route('carColors.destroy', '') }}',

            carFuels_index: '{{ route('carFuels.index', '') }}',
            carFuels_store: '{{ route('carFuels.store') }}',
            carFuels_update: '{{ route('carFuels.update', '') }}',
            carFuels_delete: '{{ route('carFuels.destroy', '') }}',

            carLevels_index: '{{ route('carLevels.index', '') }}',
            carLevels_store: '{{ route('carLevels.store') }}',
            carLevels_update: '{{ route('carLevels.update', '') }}',
            carLevels_delete: '{{ route('carLevels.destroy', '') }}',

            carModels_index: '{{ route('carModels.index', '') }}',
            carModels_store: '{{ route('carModels.store') }}',
            carModels_update: '{{ route('carModels.update', '') }}',
            carModels_delete: '{{ route('carModels.destroy', '') }}',

            carSystems_index: '{{ route('carSystems.index', '') }}',
            carSystems_store: '{{ route('carSystems.store') }}',
            carSystems_update: '{{ route('carSystems.update', '') }}',
            carSystems_delete: '{{ route('carSystems.destroy', '') }}',

            carTypes_index: '{{ route('carTypes.index', '') }}',
            carTypes_store: '{{ route('carTypes.store') }}',
            carTypes_update: '{{ route('carTypes.update', '') }}',
            carTypes_delete: '{{ route('carTypes.destroy', '') }}',

            carPlateTypes_index: '{{ route('carPlateTypes.index', '') }}',
            carPlateTypes_store: '{{ route('carPlateTypes.store') }}',
            carPlateTypes_update: '{{ route('carPlateTypes.update', '') }}',
            carPlateTypes_delete: '{{ route('carPlateTypes.destroy', '') }}',

            carSites_index: '{{ route('carSites.index', '') }}',
            carSites_store: '{{ route('carSites.store') }}',
            carSites_update: '{{ route('carSites.update', '') }}',
            carSites_delete: '{{ route('carSites.destroy', '') }}',
        }
    };
</script>

<script src="{{ mix('js/pages/cars/index.js') }}" type="text/javascript" charset="utf-8" defer></script>

@endsection
