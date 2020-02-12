@extends('layouts.login-master')

@section('content')
<form class="f-BYekan form-horizontal" method="POST" action="{{ route('password.request') }}">
	<input type="hidden" name="token" value="{{ $token }}">
	{{ csrf_field() }}

	<div class="card card-login card-hidden">
		<div class="card-header text-center" data-background-color="rose">
			<h4 class="card-title f-BTitrTGEBold">
				تغییر گذرواژه
			</h4>
		</div>

		<div class="card-content">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">email</i>
				</span>

				<div class="form-group label-floating">
					<label class="control-label">ایمیل</label>

					<input type="email" class="form-control" v-validate="'required|email'"
						name="email" value="{{ old('email', '') }}"
						data-vv-delay="100" v-model="email" :class="{'input': true, 'is-danger': errors.has('email') }"/>
				</div>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">lock</i>
				</span>

				<div class="form-group label-floating">
					<label class="control-label">گذرواژه</label>

					<input type="password" class="form-control" v-validate="'required|password'"
						name="password" value="{{ old('password', '') }}"
						data-vv-delay="100" v-model="password" :class="{'input': true, 'is-danger': errors.has('password') }"/>
				</div>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">lock</i>
				</span>

				<div class="form-group label-floating">
					<label class="control-label">تایید گذرواژه</label>

					<input type="password" class="form-control" v-validate="'required|password'"
						name="password_confirmation" value="{{ old('password_confirmation', '') }}"
						data-vv-delay="100" v-model="password_confirmation" :class="{'input': true, 'is-danger': errors.has('password_confirmation') }"/>
				</div>
			</div>

			@if (session('status'))
			<div class="alert alert-success" v-show="showAlerts">
				<button type="button" aria-hidden="true" class="close" @click="closeAlerts">
					<i class="material-icons">close</i>
				</button>
				<span>
					<b> تبریک - </b>
					{{ session('status') }}
				</span>
			</div>
			@endif

			@if (session('errors'))
			<div class="alert alert-danger" v-show="showAlerts">
				<button type="button" aria-hidden="true" class="close" @click="closeAlerts">
					<i class="material-icons">close</i>
				</button>
				<span>
					<b> خطا - </b> ایمیل مورد نظر یافت نشد
				</span>
			</div>
			@endif
		</div>

		<div class="footer text-center">
			<button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">
				تغییر گذرواژه
			</button>
		</div>
	</div>
</form>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/reset-email.js') }}"></script>
@endsection
