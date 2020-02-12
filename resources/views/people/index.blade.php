@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/people.css') }}">
<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="col-lg-12 col-md-12">
            <h4>
                <span class="panel-heading my-dashboard">کاربران</span>
            </h4>

            <div class="card">
                <div class="card-header card-header-tabs card-header-rose" v-show="isNormalMode">

                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                {{-- Tab Student --}}
                                <li class="nav-item" :class="{'active':lastGroupId == {{ \App\People::$GROUP_STUDENTS }}}">
                                    <a class="nav-link active" href="#" @click="filterUsers({{ \App\People::$GROUP_STUDENTS }})">
                                       <i class="fas fa-user-graduate fa-2x"></i>
                                       <strong>دانشجویان</strong>
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                {{-- /Tab Student --}}

                                {{-- Tab Staff --}}
                                <li class="nav-item" :class="{'active':lastGroupId == {{ \App\People::$GROUP_STAFFS }}}">
                                    <a class="nav-link" href="#" @click="filterUsers({{ \App\People::$GROUP_STAFFS }})">
                                        <i class="fa fa-user-secret fa-2x"></i>
                                        <strong>کارمندان </strong>
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                {{-- /Tab Staff --}}

                                {{-- Tab Teacher --}}
                               <li class="nav-item"  :class="{'active':lastGroupId == {{ \App\People::$GROUP_TEACHERS }}}">
                                    <a class="nav-link" href="#" @click="filterUsers({{ \App\People::$GROUP_TEACHERS }})">
                                        <i class="fa fa-book fa-2x"></i>
                                        <strong> اساتید</strong>
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                {{-- /Tab Teacher --}}


                                {{-- Button insert --}}
                                <li class="nav-item pull-left">
                                    @can('command_insert')
                                        <span class="pull-left">
                                                <a class="btn btn-white" href="#" @click.prevent="newRecord">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                    ثبت رکورد جدید
                                                </a>
                                        </span>
                                    @endcan
                                </li>
                                {{-- Button insert --}}

                                <!-- <li class="nav-item pull-right"> -->
                                <!-- <form class="navbar-form"> -->
                                    <div class="input-group no-border">
                                        <input type="search"
                                                v-model="searchWord"
                                                class="form-control form-control-sm text-color"
                                                placeholder="جستجو...">
                                        <!-- <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                            <i class="material-icons">search</i>
                                            <div class="ripple-container"></div>
                                        </button> -->
                                    </div>
                                    <!-- </form> -->
                                <!-- </li> -->

                            </ul>
                        </div>
                    </div>
                </div>

                @include('people.list')
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    document.pageData.people = {
        load_url: '{{ route('people.filter', '') }}',
        baseInformation: '{{ route('base.all_Information') }}',
        load_by_national_code: '{{ route('people.load_by_national_code') }}',
        check_user: '{{ route('user.check.exist') }}',
        check_national_people: '{{ route('people.check.exist.national') }}',
        group_students: {{ \App\People::$GROUP_STUDENTS }},
        group_staffs: {{ \App\People::$GROUP_STAFFS }},
        group_teachers: {{ \App\People::$GROUP_TEACHERS }},

        load_pic_fingerprint: '{{ route('people.fingerprint') }}',


    };
</script>
<script type="text/javascript" src="{{ mix('js/pages/people/index.js') }}" ></script>
@endsection
