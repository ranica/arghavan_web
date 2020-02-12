@extends('layouts.app')

@section('content')

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="col-md-12">
            <h4>
                <span class="panel-heading my-dashboard">اختصاص کارت</span>
            </h4>
             <div class="card">
                <div class="card-header card-header-tabs card-header-rose" v-show="isNormalMode">

                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <!--  Tab Student  -->
                                <li class="nav-item" :class="{'active':lastGroupId == {{ \App\People::$GROUP_STUDENTS }}}">
                                    <a class="nav-link active" href="#" @click="filterUsers({{ \App\People::$GROUP_STUDENTS }})">
                                        <i class="fas fa-graduation-cap fa-2x"></i>
                                       <strong>دانشجویان</strong>
                                        <div class="ripple-container"></div>
                                        {{-- <div class="ripple-container"></div> --}}
                                    </a>
                                </li>
                                <!--  /Tab Student  -->

                                <!--  Tab Staff  -->
                                <li class="nav-item" :class="{'active':lastGroupId == {{ \App\People::$GROUP_STAFFS }}}">
                                    <a class="nav-link" href="#" @click="filterUsers({{ \App\People::$GROUP_STAFFS }})">
                                        <i class="fa fa-user-secret fa-2x"></i>
                                        <strong>کارمندان </strong>
                                        <div class="ripple-container"></div>
                                        {{-- <div class="ripple-container"></div> --}}
                                    </a>
                                </li>
                                <!--  /Tab Staff  -->

                                <!-- Tab Teacher -->
                               <li class="nav-item"
                                    :class="{'active':lastGroupId == {{ \App\People::$GROUP_TEACHERS }}}">
                                    <a class="nav-link"
                                        href="#"
                                        @click="filterUsers({{ \App\People::$GROUP_TEACHERS }})">
                                        <i class="fa fa-book fa-2x"></i>
                                        <strong> اساتید</strong>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                 <!-- /Tab Teacher  -->

                                <!--  Button insert  -->
                                <li class="nav-item pull-left">
                                    @can('command_insert')
                                        <span class="pull-left" v-show="isNormalMode">
                                                <a class="btn btn-white" href="#" @click.prevent="newRecord">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                    ثبت رکورد جدید
                                                </a>
                                        </span>
                                    @endcan
                                </li>

                                <!--  Button insert  -->
                                <div class="input-group no-border">
                                    <input type="search"
                                            v-model="searchWord"
                                            class="form-control form-control-sm text-color"
                                            placeholder="جستجو...">
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                  @include('cards.list')
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        document.pageData = {
            load_url: '{{ route('cards.filter', '') }}',
            group_students: {{ \App\People::$GROUP_STUDENTS }},
            group_staffs: {{ \App\People::$GROUP_STAFFS }},
            group_teachers: {{ \App\People::$GROUP_TEACHERS }}
        };
    </script>
    <script type="text/javascript" src="{{ mix('js/pages/cards/index.js') }}"></script>
@endsection
