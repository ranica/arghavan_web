<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top" id="registerForm">
    <div class="card container pad-top-2em ">

        <!-- Card Header -->
       {{--  <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div> --}}
        <!-- /Card Header -->

        {{-- <div class="row"> --}}
        <div id="smartwizard">
            <ul>
                <li>
                    <a href="#step-sms-text">متن پیامک<br/>
                        {{-- <small>Step description</small> --}}
                    </a>
                </li>
                <li>
                    <a href="#step-sms-receive">گیرندگان<br />
                        {{-- <small>Step description</small> --}}
                    </a>
                </li>
               {{--  <li>
                    <a href="#step-sms-time">زمان ارسال<br />
                    </a>
                </li> --}}
                <li>
                    <a href="#step-sms-send">ارسال<br />
                        {{-- <small>Step description</small> --}}
                    </a>
                </li>
                {{-- <li><a href="#step-4">Step Title<br /><small>Step description</small></a></li> --}}
            </ul>

            <div>
                <div id="step-sms-text" class="">
                    <!-- First Step : Search -->
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header card-header-icon" data-background-color="rose">
                             @{{ lenMessage }}  کاراکتر
                        </div>
                        <!-- /Card Header -->

                         <!-- Card Header -->
                        <div class="card-header card-header-icon" data-background-color="rose">
                             @{{ countMessage }}  پیامک
                        </div>
                        <!-- /Card Header -->
                        <!-- Card Header -->
                       {{--  <div class="card-header card-header-icon" data-background-color="rose">
                            fa 
                        </div> --}}
                        <!-- /Card Header -->

                        <div class="card-content">
                          ‍  <form>
                                <div class="row"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="textSMS"
                                                @input="messageLenght()"
                                                 v-model="tempRecord.message"
                                                 placeholder="متن پیامک خود را وارد نمایید"
                                                 rows="3"
                                                 :max-rows="6"> 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /First Step : Search -->
                </div>

                <div id="step-sms-receive" class="">
                    <!-- Step Select -->
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header card-header-icon" data-background-color="rose">
                             @{{ cReceive }}  تعداد مخاطبین وارد شده
                        </div>
                        <!-- /Card Header -->
                        <div class="card-content">
                          ‍  <form>
                                <div class="row"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="textSMS"
                                                @input="receiveCount()"
                                                 v-model="tempRecord.to"
                                                 placeholder="شماره گیرندگان"
                                                 rows="3"
                                                 :max-rows="6"> 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                   {{--  <div class="row">
                        <div class="col-md-12">
                           <!-- receive field -->
                            <div class="form-group label-floating mrg-top-2em" :class="{'has-error' : errors.has('numberReceive')}">
                                <label class="control-label">شماره گیرنده</label>
                                <input autofocus required class="form-control" 
                                    type="number" 
                                    name="numberReceive" 
                                    minlength="2" 
                                    maxlength="50" 
                                    v-model="tempRecord.to"
                                    v-validate="'required|min:2|max:50'" 
                                    data-vv-delay="250"
                                    data-vv-name ="شماره گیرنده" />

                                <i v-show="errors.has('numberReceive')" class="fa fa-warning"></i>
                                <span v-show="errors.has('numberReceive')" class="help is-danger">شماره گیرنده نامعتبر می باشد</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <!-- /receive field -->
                    </div> --}}
                    <!-- /Step Select -->
                </div>

                {{-- <div id="step-sms-time" class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="" v-validate="'required'"/>
                                    <span class="circle"></span>
                                    <span class="check"></span>
                                    ارسال در زمان کنونی
                                </label>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div id="step-sms-send" class="">
                    <div class="row">
                        <div class="col-md-12 pad-right-2em">
                            <span class="pull-right">
                                <a class="btn btn-rose" href="#" @click.prevent="saveRecord">
                                    <h4>
                                    <span class="glyphicon glyphicon-send"></span>
                                    ارسال پیام
                                    </h4>
                                </a>
                            </span>
                            
                            {{-- <span class="pull-right">
                                <input type="button" value="ارسال پیام" class="btn btn-fill btn-rose" @click.prevent="saveRecord">
                                    <i class="fa fa-paper-plane"></i>
                            </span> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

