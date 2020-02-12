@extends('layouts.app')

@section('content')
  {{-- <link rel="stylesheet" type="text/css" href="{{ mix('css/pages/base.css') }}"> --}}
  <div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12 col-sm-12">

          <div class="row">
            <div class="col-md-12 ml-auto mr-auto">

              <div class="page-categories">
                <h3 class="title text-center">اطلاعات پایه ساختار سازمانی </h3>
                <br/>
                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center"
                    role="tablist">
                  @isRoot
                    <!-- @can('base_group') -->
                      <li class="nav-item tabStyle active">
                        <a class="nav-link" data-toggle="tab" href="#group" role="tablist">
                          <i class="material-icons">group</i> تعریف گروه بندی
                        </a>
                      </li>
                    <!-- @endcan -->

                    @can('base_cardtype')
                      <li class="nav-item tabStyle">
                        <a class="nav-link" data-toggle="tab" href="#cardtype" role="tablist">
                          <i class="material-icons">card_membership</i> تعریف انواع کارت
                        </a>
                      </li>
                    @endcan
                  @endisRoot
                  @can('base_contractor')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#contractor" role="tablist">
                        <i class="fas fa-user-tie"></i>تعریف پیمانکار
                      </a>
                    </li>
                  @endcan

                  @can('base_contract')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#contract" role="tablist">
                        <i class="fa fa-handshake fa-2x"></i>تعریف انواع قرارداد
                      </a>
                    </li>
                  @endcan

                  @can('base_block')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#block" role="tablist">
                        <i class="fas fa-home fa-2x"></i>  تعریف بلوک
                      </a>
                    </li>
                  @endcan

                  @can('base_building_type')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#building_type" role="tablist">
                        <i class="fas fa-warehouse fa-2x"></i>تعریف انواع ساختمان
                      </a>
                    </li>
                  @endcan

                  @can('base_building')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#building" role="tablist">
                        <i class="fas fa-building fa-2x"></i>تعریف ساختمان
                      </a>
                    </li>
                  @endcan

                   {{--  <li class="nav-item tabStyle">
                        <a class="nav-link" data-toggle="tab" href="#department" role="tablist">
                            <i class="fas fa-building fa-2x"></i>تعریف ساختمان
                        </a>
                    </li> --}}
                  @can('base_kintype')
                    <li class="nav-item tabStyle">
                        <a class="nav-link" data-toggle="tab" href="#kin_type" role="tablist">
                            <i class="material-icons">people_outline</i> تعریف نسبت افراد
                        </a>
                    </li>
                  @endcan

                  @can('base_melliat')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#melliat" role="tablist">
                        <i class="fas fa-globe-asia"></i> تعریف ملیت
                      </a>
                    </li>
                  @endcan

                  @can('base_province')
                    <li class="nav-item tabStyle ">
                      <a class="nav-link" data-toggle="tab" href="#province" role="tablist">
                        <i class="material-icons">location_city</i>تعریف استان
                      </a>
                    </li>
                  @endcan

                  @can('base_city')
                    <li class="nav-item tabStyle">
                      <a class="nav-link" data-toggle="tab" href="#city" role="tablist">
                        <i class="material-icons">my_location</i> تعریف شهرستان
                      </a>
                    </li>
                  @endcan
                </ul>

                <div class="tab-content tab-space tab-subcategories">
                  @isRoot
                    @can('base_group')
                      <div class="tab-pane active" id="group">
                        @include('base-structure.groups.index')
                      </div>
                    @endcan

                    @can('base_cardtype')
                      <div class="tab-pane" id="cardtype">
                        @include('base-structure.card_types.index')
                      </div>
                    @endcan
                  @endisRoot

                  @can('base_contractor')
                    <div class='tab-pane'  id="contractor">
                      @include('base-structure.contractors.index')
                    </div>
                  @endcan

                  @can('base_contract')
                    <div class="tab-pane" id="contract">
                      @include('base-structure.contracts.index')
                    </div>
                  @endcan

                  @can('base_block')
                    <div class="tab-pane" id="block">
                      @include('base-structure.blocks.index')
                    </div>
                  @endcan

                  @can('base_building_type')
                    <div class="tab-pane" id="building_type">
                      @include('base-structure.building_types.index')
                    </div>
                  @endcan

                  @can('base_building')
                    <div class="tab-pane" id="building">
                      @include('base-structure.buildings.index')
                    </div>
                  @endcan

                  @can('base_kintype')
                    <div class="tab-pane" id="kin_type">
                      @include('base-structure.kin_types.index')
                    </div>
                  @endcan

                  @can('base_melliat')
                    <div class="tab-pane" id="melliat">
                      @include('base-structure.melliats.index')
                    </div>
                  @endcan

                  @can('base_province')
                    <div class="tab-pane" id="province">
                      @include('base-structure.provinces.index')
                    </div>
                  @endcan

                  @can('base_city')
                    <div class="tab-pane" id="city">
                        @include('base-structure.cities.index')
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
    document.pageData.base_structure = {
        pageUrls: {
            melliats_index: '{{ route('melliats.index', '') }}',
            melliats_store: '{{ route('melliats.store') }}',
            melliats_update: '{{ route('melliats.update', '') }}',
            melliats_delete: '{{ route('melliats.destroy', '') }}',

            groups_index: '{{ route('groups.index', '') }}',
            groups_store: '{{ route('groups.store') }}',
            groups_update: '{{ route('groups.update', '') }}',
            groups_delete: '{{ route('groups.destroy', '') }}',

            card_types_index: '{{ route('cardtypes.index', '') }}',
            card_types_store: '{{ route('cardtypes.store') }}',
            card_types_update: '{{ route('cardtypes.update', '') }}',
            card_types_delete: '{{ route('cardtypes.destroy', '') }}',

           contractors_index: '{{ route('contractors.index', '') }}',
           contractors_store: '{{ route('contractors.store') }}',
           contractors_update: '{{ route('contractors.update', '') }}',
           contractors_delete: '{{ route('contractors.destroy', '') }}',

           contracts_index: '{{ route('contracts.index', '') }}',
           contracts_store: '{{ route('contracts.store') }}',
           contracts_update: '{{ route('contracts.update', '') }}',
           contracts_delete: '{{ route('contracts.destroy', '') }}',

           blocks_index: '{{ route('blocks.index', '') }}',
           blocks_store: '{{ route('blocks.store') }}',
           blocks_update: '{{ route('blocks.update', '') }}',
           blocks_delete: '{{ route('blocks.destroy', '') }}',

           building_types_index: '{{ route('buildingTypes.index', '') }}',
           building_types_store: '{{ route('buildingTypes.store') }}',
           building_types_update: '{{ route('buildingTypes.update', '') }}',
           building_types_delete: '{{ route('buildingTypes.destroy', '') }}',

           buildings_index: '{{ route('buildings.index', '') }}',
           buildings_store: '{{ route('buildings.store') }}',
           buildings_update: '{{ route('buildings.update', '') }}',
           buildings_delete: '{{ route('buildings.destroy', '') }}',

           departments_index: '{{ route('departments.index', '') }}',
           departments_store: '{{ route('departments.store') }}',
           departments_update: '{{ route('departments.update', '') }}',
           departments_delete: '{{ route('departments.destroy', '') }}',

           kin_types_index: '{{ route('kintypes.index', '') }}',
           kin_types_store: '{{ route('kintypes.store') }}',
           kin_types_update: '{{ route('kintypes.update', '') }}',
           kin_types_delete: '{{ route('kintypes.destroy', '') }}',

           provinces_index: '{{ route('provinces.index', '') }}',
           provinces_all_index: '{{ route('provinces.allProvince', '') }}',
           provinces_store: '{{ route('provinces.store') }}',
           provinces_update: '{{ route('provinces.update', '') }}',
           provinces_delete: '{{ route('provinces.destroy', '') }}',

           cities_index: '{{ route('cities.index', '') }}',
           cities_store: '{{ route('cities.store') }}',
           cities_update: '{{ route('cities.update', '') }}',
           cities_delete: '{{ route('cities.destroy', '') }}',
        }
    };
  </script>

  <script src="{{ mix('js/pages/base-structure/index.js') }}" type="text/javascript" charset="utf-8" defer></script>
@endsection
