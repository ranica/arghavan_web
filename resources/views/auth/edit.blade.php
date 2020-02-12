@extends('layouts.app')

@section('content')

	<div class="content f-BYekan hidden" id ="app">
		<div class="container-fluid">

		  	<div class="row">
		  		<div class="col-md-4">
			      	<div class="card card-profile">
				        <div class="card-avatar">
				          	<a href="#">
				            	<img class="img" :src="tempRecord.people.pictureThumbUrl" />
				          	</a>
			        	</div>
				        <div class="card-body">
				          	<h6 class="card-category text-gray"> @{{ tempRecord.user.group.name }}
				          	</h6>
				          	<h4 class="card-title">@{{ tempRecord.people.name }}   @{{ tempRecord.people.lastname }} </h4>
				          	<p class="card-description">
					            {{-- Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is... --}}
				          	</p>
				          	{{-- <a href="#pablo" class="btn btn-rose btn-round">Follow</a> --}}
				        </div>
			      	</div>
			    </div>
		    	<div class="col-md-8">
		      		<div class="card">

				      	<!-- Card Header -->
			         	<div class="card-header card-header-icon" data-background-color="rose">
				            <i class="material-icons">perm_identity</i>
			         	</div>
				        <!-- /Card Header -->

		        		<div class="card-header card-header-icon card-header-rose">
				          	<h4 class="card-title">
				            	<span class="panel-heading">پروفایل کاربری</span>
				            	{{-- <small class="category f-BYekan">تکمیل پروفایل</small> --}}
				          	</h4>
		        		</div>

				        <div class="card-content">
				          ‍	<form>
				          		<div class="row"></div>
					            <div class="row">
					              	{{-- <div class="col-md-5">
						                <div class="form-group">
						                  	<label class="bmd-label-floating">شماره کاربری (غیرفعال)</label>
						                  	<input type="text" class="form-control" disabled>
						                </div>
					              	</div> --}}
					              	<div class="col-md-6">
						                <div class="form-group">
						                  	<label class="bmd-label-floating">شماره کاربری (غیرفعال)</label>
						                  	<input type="text" class="form-control" disabled  v-model="tempRecord.user.code">
						                </div>
					              	</div>
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">آدرس ایمیل</label>
					                  		<input type="email" class="form-control" disabled v-model="tempRecord.user.email" >
					                	</div>
					              	</div>
					            </div>

					            <div class="row">
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">نام</label>
					                  		<input type="text" class="form-control" disabled v-model ="tempRecord.people.name">
					                	</div>
					              	</div>
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">نام خانوادگی</label>
					                  		<input type="text" class="form-control" disabled v-model="tempRecord.people.lastname">
					                	</div>
					              	</div>
					            </div>

					             <div class="row">
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">جنسیت</label>
					                  		<input type="text" class="form-control" disabled v-model ="tempRecord.people.gender.name">
					                	</div>
					              	</div>
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">ملیت</label>
					                  		<input type="text" class="form-control" disabled v-model="tempRecord.people.melliat.name">
					                	</div>
					              	</div>
					            </div>

 								<div class="row">
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">استان</label>
					                  		<input type="text" class="form-control" disabled v-model = "tempRecord.people.province.name">
					                	</div>
					              	</div>
					              	<div class="col-md-6">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">شهرستان</label>
					                  		<input type="text" class="form-control" disabled v-model="tempRecord.people.city.name">
					                	</div>
					              	</div>
					            </div>

					            <div class="row">
					              	<div class="col-md-12">
					                	<div class="form-group">
					                  		<label class="bmd-label-floating">آدرس</label>
					                  		<input type="text" class="form-control" disabled v-model= "tempRecord.people.address">
					                	</div>
					              	</div>
					            </div>

					            <a type="submit" class="btn btn-rose pull-right" href="{{ route("home") }}">بستن</a>
				            	<div class="clearfix"></div>
				          	</form>
				        </div>
		      		</div>
		    	</div>
		  	</div>
		</div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
	document.pageData.edit = {
		user_id: {{ \Auth::user()->id }},
        load_url: '{{ route('profile_show') }}',

	};
</script>
<script type="text/javascript" src="{{ mix('js/pages/home/index.js') }}"></script>
@endsection
