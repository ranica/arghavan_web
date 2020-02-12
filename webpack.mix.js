
let mix = require('laravel-mix');

//Config.publicPath = "public_html";

mix
   // .js('resources/assets/js/pages/contractors/index.js', 'public/js/pages/contractors')
   // .js('resources/assets/js/pages/provinces/index.js', 'public/js/pages/provinces')
   // .js('resources/assets/js/pages/cities/index.js', 'public/js/pages/cities')
   // .js('resources/assets/js/pages/groups/index.js', 'public/js/pages/groups')
   // .js('resources/assets/js/pages/departments/index.js', 'public/js/pages/departments')
   // .js('resources/assets/js/pages/cardtypes/index.js', 'public/js/pages/cardtypes')
   // .js('resources/assets/js/pages/melliats/index.js', 'public/js/pages/melliats')
   // .js('resources/assets/js/pages/contracts/index.js', 'public/js/pages/contracts')
   // .js('resources/assets/js/pages/kintypes/index.js', 'public/js/pages/kintypes')
   //
   // .js('resources/assets/js/pages/fields/index.js', 'public/js/pages/fields')
   // .js('resources/assets/js/pages/universities/index.js', 'public/js/pages/universities')
   // .js('resources/assets/js/pages/degrees/index.js', 'public/js/pages/degrees')
   // .js('resources/assets/js/pages/parts/index.js', 'public/js/pages/parts')
   // .js('resources/assets/js/pages/situations/index.js', 'public/js/pages/situations')
   // .js('resources/assets/js/pages/terms/index.js', 'public/js/pages/terms')
   // .js('resources/assets/js/pages/vue-router/index.js', 'public/js/pages/vue-router')
   // .js('resources/assets/js/pages/vue-router/index-gate.js', 'public/js/pages/vue-router')
   // Javascripts
   .js('resources/assets/js/jsapi.js', 'public/js')
   .js('resources/assets/js/Chart.js', 'public/js')

   .js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/jquery-loader.js', 'public/js')
   .js('resources/assets/js/additional.js', 'public/js')
   .js('resources/assets/js/theme.js', 'public/js')
   .js('resources/assets/js/chartist.js', 'public/js')

   .js('resources/assets/js/pages/login.js', 'public/js/pages')
   .js('resources/assets/js/pages/reset-email.js', 'public/js/pages')
   .js('resources/assets/js/pages/cards/index.js', 'public/js/pages/cards')
   .js('resources/assets/js/pages/relatives/index.js', 'public/js/pages/relatives')
   .js('resources/assets/js/pages/resources/index.js', 'public/js/pages/resources')
   .js('resources/assets/js/pages/people/index.js', 'public/js/pages/people')
   .js('resources/assets/js/pages/zones/index.js', 'public/js/pages/zones')
   .js('resources/assets/js/pages/students/index.js', 'public/js/pages/students')
   .js('resources/assets/js/pages/gateoptions/index.js', 'public/js/pages/gateoptions')
   .js('resources/assets/js/pages/gatedevices/index.js', 'public/js/pages/gatedevices')
   .js('resources/assets/js/pages/gatepasses/index.js', 'public/js/pages/gatepasses')
   .js('resources/assets/js/pages/roles/index.js', 'public/js/pages/roles')
   .js('resources/assets/js/pages/permissions/index.js', 'public/js/pages/permissions')
   .js('resources/assets/js/pages/grouppermits/index.js', 'public/js/pages/grouppermits')
   .js('resources/assets/js/pages/reports/index.js', 'public/js/pages/reports')
   .js('resources/assets/js/pages/reports/user.js', 'public/js/pages/reports')
   .js('resources/assets/js/pages/reports/monitor-index.js', 'public/js/pages/reports')
   .js('resources/assets/js/pages/searches/index.js', 'public/js/pages/searches')
   .js('resources/assets/js/pages/dashboard/home/index.js', 'public/js/pages/dashboard/home')
   .js('resources/assets/js/pages/dashboard/car/index.js', 'public/js/pages/dashboard/car')
   .js('resources/assets/js/pages/gategroups/index.js', 'public/js/pages/gategroups')
   .js('resources/assets/js/pages/sms/index.js', 'public/js/pages/sms')
   .js('resources/assets/js/pages/home/index.js', 'public/js/pages/home')
   .js('resources/assets/js/pages/vacationRequests/index.js', 'public/js/pages/vacationRequests')
   .js('resources/assets/js/pages/vacationTypes/index.js', 'public/js/pages/vacationTypes')
   .js('resources/assets/js/pages/warranties/index.js', 'public/js/pages/warranties')
   .js('resources/assets/js/pages/referraltypes/index.js', 'public/js/pages/referraltypes')
   .js('resources/assets/js/pages/referrals/index.js', 'public/js/pages/referrals')

   .js('resources/assets/js/pages/cars/index.js', 'public/js/pages/cars')
   .js('resources/assets/js/pages/cars/car/index.js', 'public/js/pages/cars/car')
   .js('resources/assets/js/pages/base-structure/index.js', 'public/js/pages/base-structure')
   .js('resources/assets/js/pages/base-education/index.js', 'public/js/pages/base-education')
   .js('resources/assets/js/pages/base-dormitory/index.js', 'public/js/pages/base-dormitory')
   .js('resources/assets/js/pages/dormitories/index.js', 'public/js/pages/dormitories')
   .js('resources/assets/js/pages/gatePlans/index.js', 'public/js/pages/gatePlans')
   // .js('resources/assets/js/pages/common_range/index.js', 'public/js/pages/common_range')

   // SASS
   .sass('resources/assets/sass/fonts.scss', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/chart.scss', 'public/css')
   .sass('resources/assets/sass/misc.scss', 'public/css')
   .sass('resources/assets/sass/wizard.scss', 'public/css')
   .sass('resources/assets/sass/login.scss', 'public/css')

   .sass('resources/assets/sass/pages/gate-device.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/people.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/report.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/home.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/sms.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/chart.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/base.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/error.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/lock.scss', 'public/css/pages')
   .sass('resources/assets/sass/pages/car.scss', 'public/css/pages')

   // Directories
   .copyDirectory('resources/assets/vendor/theme/', 'public/theme')
   .copyDirectory('resources/assets/images/', 'public/images')

   // Files
   .copy('./node_modules/smartwizard/dist/js/jquery.smartWizard.js', 'public/js/')
   .copy('./node_modules/smartwizard/dist/css/smart_wizard.min.css', 'public/css/')
   .copy('./node_modules/smartwizard/dist/css/smart_wizard_theme_arrows.css', 'public/css/')
   .copy('./node_modules/smartwizard/dist/css/smart_wizard_theme_circles.min.css', 'public/css/')
   // .copy('./node_modules/vue-range-slider/dist/vue-range-slider.css', 'public/css/')


   // .copy('./node_modules/@fortawesome/fontawesome-free/css/all.css', 'public/css/')


   .js ('resources/assets/js/test.js', 'public/js')

   // Configs
   .disableNotifications()
   .version();
