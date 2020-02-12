@extends('layouts.lock-master')

@section('content')
<form id="app" class="f-BYekan direction-rtl">
  {{ csrf_field() }}
   <div class="card card-profile text-center card-hidden">
      <div class="card-header ">
        <div class="card-avatar">
          <a href="#pablo">
            <img class="img" :src="tempRecord.people.pictureThumbUrl">
          </a>
        </div>
      </div>
      <div class="card-body">
        <h4 class="card-title"> @{{ tempRecord.people.name }} @{{ tempRecord.people.lastname }} </h4>
        <div class="form-group">
          <label for="exampleInput1" class="bmd-label-floating">رمز را وارد نمایید</label>
          <input type="password" id="exampleInput1"
                  class="form-control"
                  v-validate="{ required: true, is_not: null }"
                  data-vv-delay="100"
                  v-model="tempRecord.user.password"
                  :class="{'input': true, 'is-danger': errors.has('password') }"/>
        </div>
      </div>
      <div class="card-footer justify-content-center">
        <a href="#pablo" class="btn btn-rose btn-round" @click.prevent="login">ورود</a>
      </div>
    </div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
  document.pageData.lock = {
    user_id: {{ \Auth::user()->id }},
    load_url: '{{ route('lock_page') }}',
    unlock_url: '{{ route('unlock') }}',
  };
</script>
<script type="text/javascript" src="{{ mix('js/pages/home/index.js') }}"></script>
@endsection
