@extends('layouts.login-master')

@section('content')
	<form id="app" class="f-BYekan direction-rtl">
		{{ csrf_field() }}
		<div class="card card-login card-hidden">
			<div class="card-header text-center" data-background-color="rose">
				<img class="image--cover"  src="{{ asset("theme/img/logo/logo.jpg") }}" />
			</div>

			<div class="card-content">
			<!-- 	<h4 class="card-title f-BTitrTGEBold">
					<p class="card-description text-center">ورود به سامانه </p>
				</h4> -->
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">person</i>
					</span>

					<div class="form-group label-floating">
						<label class="control-label">شماره پرسنلی/شماره دانشجویی</label>
						<input type="text" class="form-control"
							v-validate="'required'" data-vv-delay="100"
							v-model="name" :class="{'input': true, 'is-danger': errors.has('name') }"/>
					</div>
				</div>

				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">lock_outline</i>
					</span>

					<div class="form-group label-floating">
						<label class="control-label">کد ملی</label>
						<input type="password" class="form-control" autocomplete="off"
							v-validate="'required|min:6'" data-vv-delay="100" v-model="password"
							:class="{'input': true, 'is-danger': errors.has('password') }"/>
					</div>
				</div>

				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember"
						{{ old('remember') ? 'checked' : '' }} v-model="remember"
						:class="{'input': true, 'is-danger': errors.has('remember') }"/>
	                مرا به خاطر بسپار
	                </label>
				</div>
			</div>

			<div class="footer text-center">
				<button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg"
				@click.prevent="login">
				تایید هویت
				</button>
				<br/>
				<a href="{{ route('password.request') }}">
					کلمه عبور خود را فراموش کرده ام!
				</a>
			</div>
		</div>
	</form>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/login.js') }}"></script>
@endsection
