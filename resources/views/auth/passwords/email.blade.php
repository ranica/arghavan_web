@extends('layouts.login-master')

@section('content')
<form class="f-BYekan form-horizontal" method="POST" action="{{ route('password.email') }}">
	{{ csrf_field() }}

	<div class="card card-login card-hidden">
		<div class="card-header text-center" data-background-color="rose">
			<h4 class="card-title f-BTitrTGEBold">
				بازیابی گذرواژه
			</h4>
		</div>

		<div class="card-content">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">email</i>
				</span>

				<div class="form-group label-floating">
					<label class="control-label">ایمیل</label>

					<input type="email" class="form-control" v-validate="'required|email'" name="email"
						data-vv-delay="100" v-model="email" :class="{'input': true, 'is-danger': errors.has('email') }"/>
				</div>
			</div>

			@if (session('status'))
			<div class="alert alert-success" v-show="showAlerts">
				<button type="button" aria-hidden="true" class="close" @click="closeAlerts">
					<i class="material-icons">close</i>
				</button>
				<span>
					{{-- <b> تبریک - </b> --}}
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
				ارسال لینک
			</button>
		</div>
	</div>
</form>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/reset-email.js') }}"></script>
@endsection
