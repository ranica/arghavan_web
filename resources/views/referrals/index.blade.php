@extends('layouts.app')
@section('content')

    <div class="content f-BYekan hidden" id="app">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">بررسی مراجعه کنندگان
                                <small class="description">جستجو ـ ثبت</small>
                            </h4>
                        </div>

                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="page-categories">
                                        <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-columnr"
                                            role="tablist">
                                            <li class="nav-item tabStyle active">
                                                <a class="nav-link"
                                                    data-toggle="tab"
                                                    href="#check_data"
                                                    role="tablist">
                                                    <i class="fas fa-search"></i>بررسی مراجعه کننده
                                                </a>
                                            </li>

                                            <li class="nav-item tabStyle">
                                                <a class="nav-link"
                                                    data-toggle="tab"
                                                    href="#save_data"
                                                    role="tablist">
                                                    <i class="fas fa-user-plus"></i>ثبت مراجعه کننده
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content tab-space tab-subcategories">
                                            <div class="tab-pane active" id="check_data">
                                                @include('referrals.check.index')
                                            </div>

                                            <div class="tab-pane" id="save_data">
                                                @include('referrals.save.index')
                                            </div>
                                        </div>
                                    </div>
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
    <script type="text/javascript" src="{{ mix('js/pages/referrals/index.js') }}"></script>
@endsection
