@extends('layouts.app')

@section('content')

    <div class="content f-BYekan hidden" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto">

                            <div class="page-categories">
                                <h3 class="title text-center">اطلاعات پایه خوابگاه </h3>
                                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center"
                                    role="tablist">

                                    @can('menu_dormitory_room')
                                        <li class="nav-item tabStyle active">
                                            <a class="nav-link"
                                                data-toggle="tab"
                                                href="#room"
                                                role="tablist">
                                                <i class="fas fa-door-open"></i>تعریف اتاق
                                            </a>
                                        </li>
                                    @endcan

                                    @can('menu_dormitory_material_type')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link"
                                                data-toggle="tab"
                                                href="#material_type"
                                                role="tablist">
                                                <i class="fas fa-couch"></i>تعریف انواع تجهیزات
                                            </a>
                                        </li>
                                    @endcan

                                    @can('menu_dormitory_material')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link"
                                                data-toggle="tab"
                                                href="#material"
                                                role="tablist">
                                                <i class="fas fa-couch"></i>تعریف تجهیزات
                                            </a>
                                        </li>
                                    @endcan

                                    @can('menu_dormitory_contact_type')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link"
                                                data-toggle="tab"
                                                href="#contact_type"
                                                role="tablist">
                                                <i class="fas fa-address-book"></i>انواع مخاطبین
                                            </a>
                                        </li>
                                    @endcan

                                    @can('menu_dormitory_phone_book')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link"
                                                data-toggle="tab"
                                                href="#phone_book"
                                                role="tablist">
                                                <i class="fas fa-phone-square"></i>دفترچه تلفن
                                            </a>
                                        </li>
                                    @endcan
                                </ul>

                                <div class="tab-content tab-space tab-subcategories">
                                    @can('menu_dormitory_room')
                                        <div class="tab-pane active" id="room">
                                            @include('base-dormitory.rooms.index')
                                        </div>
                                    @endcan

                                    @can('menu_dormitory_material_type')
                                        <div class="tab-pane" id="material_type">
                                            @include('base-dormitory.material_types.index')
                                        </div>
                                    @endcan

                                    @can('menu_dormitory_material')
                                        <div class="tab-pane" id="material">
                                            @include('base-dormitory.materials.index')
                                        </div>
                                    @endcan

                                    @can('menu_dormitory_contact_type')
                                        <div class="tab-pane" id="contact_type">
                                            @include('base-dormitory.contact_types.index')
                                        </div>
                                    @endcan

                                    @can('menu_dormitory_phone_book')
                                        <div class="tab-pane" id="phone_book">
                                            @include('base-dormitory.phone_books.index')
                                        </div>
                                    @endcan
                                </div>
                            </div>

                             <!-- Assign permission dialog -->
                            <div v-show="isAssignMaterial">
                                @include('base-dormitory.assign-material-room.index')
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
        document.pageData.base_dormitory = {
            pageUrls: {
                    buildings_index: '{{ route('buildings.index', '') }}',
                    genders_index: '{{ route('genders.index', '') }}',

                    rooms_index: '{{ route('rooms.index', '') }}',
                    rooms_store: '{{ route('rooms.store') }}',
                    rooms_update: '{{ route('rooms.update', '') }}',
                    rooms_delete: '{{ route('rooms.destroy', '') }}',

                    material_types_index: '{{ route('materialTypes.index', '') }}',
                    material_types_store: '{{ route('materialTypes.store') }}',
                    material_types_update: '{{ route('materialTypes.update', '') }}',
                    material_types_delete: '{{ route('materialTypes.destroy', '') }}',
                    material_types_all_index: '{{ route('materialTypes.allMaterialType', '') }}',

                    materials_index: '{{ route('materials.index', '') }}',
                    materials_store: '{{ route('materials.store') }}',
                    materials_update: '{{ route('materials.update', '') }}',
                    materials_delete: '{{ route('materials.destroy', '') }}',

                    contact_types_index: '{{ route('contactTypes.index', '') }}',
                    contact_types_store: '{{ route('contactTypes.store') }}',
                    contact_types_update: '{{ route('contactTypes.update', '') }}',
                    contact_types_delete: '{{ route('contactTypes.destroy', '') }}',
                    contact_types_all_index: '{{ route('contactTypes.allContactType', '') }}',


            }
        };
    </script>

    <script src="{{ mix('js/pages/base-dormitory/index.js') }}"
            type="text/javascript"
            charset="utf-8"
            defer>
    </script>
@endsection
