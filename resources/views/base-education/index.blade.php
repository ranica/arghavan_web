@extends('layouts.app')

@section('content')
    <div class="content f-BYekan hidden" id="app">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto">

                            <div class="page-categories">
                                <h3 class="title text-center">اطلاعات پایه تحصیلی </h3>
                                <br/>
                                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center"
                                    role="tablist">

                                    @can('educational_term')
                                        <li class="nav-item tabStyle active">
                                            <a class="nav-link" data-toggle="tab" href="#term" role="tablist">
                                                <i class="material-icons">school</i> نیمسال تحصیلی
                                            </a>
                                        </li>
                                    @endcan

                                    @can('educational_university')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link" data-toggle="tab" href="#university" role="tablist">
                                                <i class="fas fa-university fa-2x"></i> دانشکده تحصیلی
                                            </a>
                                        </li>
                                    @endcan

                                    @can('educational_field')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link" data-toggle="tab" href="#field" role="tablist">
                                                <i class="material-icons">library_books</i>رشته تحصیلی
                                            </a>
                                        </li>
                                    @endcan

                                    @can('educational_degree')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link" data-toggle="tab" href="#degree" role="tablist">
                                                <i class="material-icons">announcement</i>مقطع تحصیلی
                                            </a>
                                        </li>
                                    @endcan

                                    @can('educational_part')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link" data-toggle="tab" href="#part" role="tablist">
                                                <i class="material-icons">dns</i>دوره تحصیلی
                                            </a>
                                        </li>
                                    @endcan

                                    @can('educational_situation')
                                        <li class="nav-item tabStyle">
                                            <a class="nav-link" data-toggle="tab" href="#situation" role="tablist">
                                                <i class="material-icons">gavel</i>وضعیت تحصیلی
                                            </a>
                                        </li>
                                    @endcan
                                </ul>

                                <div class="tab-content tab-space tab-subcategories">

                                    @can('educational_term')
                                        <div class="tab-pane active" id="term">
                                            @include('base-education.terms.index')
                                        </div>
                                    @endcan

                                    @can('educational_university')
                                        <div class="tab-pane" id="university">
                                            @include('base-education.universities.index')
                                        </div>
                                    @endcan

                                    @can('educational_field')
                                        <div class="tab-pane" id="field">
                                            @include('base-education.fields.index')
                                        </div>
                                    @endcan

                                    @can('educational_degree')
                                        <div class="tab-pane" id="degree">
                                            @include('base-education.degrees.index')
                                        </div>
                                    @endcan

                                    @can('educational_part')
                                        <div class="tab-pane" id="part">
                                            @include('base-education.parts.index')
                                        </div>
                                    @endcan

                                    @can('educational_situation')
                                        <div class="tab-pane" id="situation">
                                            @include('base-education.situations.index')
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
         document.pageData.base_education = {
            pageUrls: {
                semesters_index: '{{ route('semesters.index', '') }}',

                terms_index: '{{ route('terms.index', '') }}',
                terms_store: '{{ route('terms.store') }}',
                terms_update: '{{ route('terms.update', '') }}',
                terms_delete: '{{ route('terms.destroy', '') }}',

                universities_all_index: '{{ route('universities.allUniversity', '') }}',
                universities_index: '{{ route('universities.index', '') }}',
                universities_store: '{{ route('universities.store') }}',
                universities_update: '{{ route('universities.update', '') }}',
                universities_delete: '{{ route('universities.destroy', '') }}',

                fields_index: '{{ route('fields.index', '') }}',
                fields_store: '{{ route('fields.store') }}',
                fields_update: '{{ route('fields.update', '') }}',
                fields_delete: '{{ route('fields.destroy', '') }}',

                degrees_index: '{{ route('degrees.index', '') }}',
                degrees_store: '{{ route('degrees.store') }}',
                degrees_update: '{{ route('degrees.update', '') }}',
                degrees_delete: '{{ route('degrees.destroy', '') }}',

                parts_index: '{{ route('parts.index', '') }}',
                parts_store: '{{ route('parts.store') }}',
                parts_update: '{{ route('parts.update', '') }}',
                parts_delete: '{{ route('parts.destroy', '') }}',

                situations_index: '{{ route('situations.index', '') }}',
                situations_store: '{{ route('situations.store') }}',
                situations_update: '{{ route('situations.update', '') }}',
                situations_delete: '{{ route('situations.destroy', '') }}',
            }
        };
    </script>

    <script src="{{ mix('js/pages/base-education/index.js') }}" type="text/javascript" charset="utf-8" defer></script>
@endsection
