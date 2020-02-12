<?php
require_once('test_web.php');
Auth::routes();
Route::get('/home', 'HomeController@index')
     ->name('home');
Route::redirect('/', '/home');
Route::view('/welcome', 'welcome');
Route::get('/home/dashboard_car', 'HomeController@indexCar')->name('dashboard_car');
Route::get('/gatedevices/allData', 'GatedeviceController@allData');
Route::get('/gatepasses/manual', 'GatepassController@manualData');
Route::get('/gatedirects/manual', 'GatedirectController@manualData');
Route::get('/province/allProvince', 'ProvinceController@allProvince')
            ->name('provinces.allProvince');

Route::get('/university/allUniversity', 'UniversityController@allUniversity')
            ->name('universities.allUniversity');

Route::get('/materialType/allMaterialType', 'MaterialTypeController@allMaterialType')
            ->name('materialTypes.allMaterialType');
Route::get('/contactType/allContactlType', 'ContactTypeController@allContactType')
            ->name('contactTypes.allContactType');
Route::post('/people/loadByNationalCode', 'PeopleController@loadPeopleByNationalCode')
            ->name('people.load_by_national_code');
Route::get('/user/checkUser', 'UserController@checkExsit')
            ->name('user.check.exist');
Route::get('/people/checkNationalPeople', 'PeopleController@checkNationaExsit')
            ->name('people.check.exist.national');

Route::get('/people/getPicFingerprint', 'PeopleController@getPicFingerprint')
                            ->name('people.fingerprint');
Route::resources ([
    // Base data
    '/melliats'             => 'MelliatController',
    '/universities'         => 'UniversityController',
    '/fields'               => 'FieldController',
    '/carColors'            => 'CarColorController',
    '/carFuels'             => 'CarFuelController',
    '/carLevels'            => 'CarLevelController',
    '/carSystems'           => 'CarSystemController',
    '/carModels'            => 'CarModelController',
    '/carTypes'             => 'CarTypeController',
    '/carPlateTypes'        => 'CarPlateTypeController',
    '/carPlateWords'        => 'CarPlateWordController',
    '/carPlateCities'       => 'CarPlateCityController',
    '/commonRanges'         => 'CommonRangeController',
    '/contractors'          => 'ContractorController',
    '/cars'                 => 'CarController',
    '/carSites'             => 'CarSiteController',
     '/provinces'           => 'ProvinceController',
     '/degrees'             => 'DegreeController',
     '/parts'               => 'PartController',
     '/situations'          => 'SituationController',
     '/cities'              => 'CityController',
     '/departments'         => 'DepartmentController',
     '/contracts'           => 'ContractController',
     '/genders'             => 'GenderController',
     '/zones'               => 'ZoneController',
     '/cards'               => 'CardController',
     '/cardtypes'           => 'CardtypeController',
     '/students'            => 'StudentController',
     '/groups'              => 'GroupController',
     '/blocks'              => 'BlockController',
     '/buildingTypes'       => 'BuildingTypeController',
     '/buildings'           => 'BuildingController',
     '/gatezones'           => 'GatezoneController',
     '/gateoptions'         => 'GateoptionController',
     '/gategenders'         => 'GategenderController',
     '/gatetraffics'        => 'GatetrafficController',
     '/gategroups'          => 'GategroupController',
     '/gatemessages'        => 'GatemessageController',
     '/gatepasses'          => 'GatepassController',
     '/gatedevices'         => 'GatedeviceController',
     '/gatedirects'         => 'GatedirectController',
     '/registration'        => 'RegistrationController',
     '/permissions'         => 'PermissionController',
     '/roles'               => 'RoleController',
     '/grouppermits'        => 'GroupPermitController',
     '/kintypes'            => 'KintypeController',
     '/relatives'           => 'RelativeController',
     '/vacationRequests'    => 'VacationRequestController',
     '/vacationTypes'       => 'VacationTypeController',
     '/vacationStatuses'    => 'VacationStatusController',
     '/people'              => 'PeopleController',
     '/warranties'          => 'WarrantyController',
     '/referralTypes'       => 'ReferralTypeController',
     '/referrals'           => 'ReferralController',
     '/semesters'           => 'SemesterController',
     '/terms'               => 'TermController',
     '/rooms'               =>'RoomController',
     '/materialTypes'       =>'MaterialTypeController',
     '/materials'           =>'MaterialController',
     '/buildingInformations'  =>'BuildingInformationController',
     '/gatePlans'           =>'GatePlanController',
     '/contactTypes'        =>'ContactTypeController',
     '/deviceTypes'         =>'DeviceTypeController',
]);

Route::get('/auth/edit', 'HomeController@editProfile')
        ->name('profile_show');

Route::get('/auth/lock', 'HomeController@lockPage')
     ->name('lock_page');

Route:: view('error', 'layouts.error-master');

Route::get('/auth/error', 'HomeController@errorPage')
        ->name('error_page');

Route::get('carLoad', 'CarController@loadCar');

Route::view('carBase', 'base-car.index')
                ->name('car_base');
Route::view('base-structure', 'base-structure.index')
                ->name('base.structure');
Route::view('base-education', 'base-education.index')
                ->name('base.education');
Route::view('base-dormitory', 'base-dormitory.index')
                ->name('base.dormitory');
Route::view('base-parking', 'base-parking.index')
                ->name('base.parking');
Route::get('/cars/load', 'CarController@loadCar')
        ->name('cars.filter');
Route::get('/cards/filter/{groupType}', 'CardController@filterCard')
        ->name('cards.filter');

Route::get('/gategroups/data/all', 'GategroupController@allGateGroup');
Route::put('/gategroups/{gategroup}/setGatedevice', 'GategroupController@setGatedevice');
Route::put('/gateoptions/{gateoption}/setGatedevice', 'GateoptionController@setGatedevice');
Route::get('/gatemessages/manual', 'GatemessageController@manualData');
Route::get('/gatedevices/manual', 'GatedeviceController@manualData');
Route::get('/gatedevices/data/all', 'GatedeviceController@allGatedevices');
Route::get('/permissions/data/all', 'PermissionController@allPermissions');
//Route::get('/permissions/data/dashboard', 'PermissionController@dashboardPermissions');
// Route::get('/permissions/data/menuStructure', 'PermissionController@menuStructurePermissions');
// Route::get('/permissions/data/menuUser', 'PermissionController@menuUserPermissions');
Route::put('/roles/{role}/setPermission', 'RoleController@setPermission');
Route::get('/roles/data/all', 'RoleController@allRoles');
Route::put('/grouppermits/{grouppermit}/setRole', 'GroupPermitController@setRole');
Route::get('/grouppermits/data/all', 'GroupPermitController@allGroupPermit');
Route::get('/vacationManagment', 'VacationRequestController@managment')
        ->name('vacation_managment');

Route::get('/cars/loadCar', 'CarController@loadCar');

Route::put(
        '/vacationRequests/{vacationRequest}/updateField',
        'VacationRequestController@updateField'
        )->name('update_field_readed');

Route::put(
        '/vacationRequests/{vacationRequest}/updateRequest',
        'VacationRequestController@updateRequest'
        )->name('update_request');

Route::get('base/data/notification/unread_count',
           'VacationRequestController@unreadVacationRequest')
    ->name('notification.count_unreaded_vacation');

//Find user for manual tarffic , reportStore
// Route::post('/people/loaduser', 'PeopleController@loaduser');
Route::put('/people/{user}/setGrouppermit', 'PeopleController@setGrouppermit');
Route::put('/people/{user}/setGateGroup', 'PeopleController@setGateGroup');
Route::put('/people/{user}/setGatePlan', 'PeopleController@setGatePlan');
Route::put('/people/{user}/setTerm', 'PeopleController@setTerm');
Route::post('/people/uploadImage', 'PeopleController@uploadImage');
Route::get('/people/{people}/loadParent', 'PeopleController@loadParent');
Route::put('/people/{user}/setParent', 'PeopleController@setParent');
Route::get('/people/filter/{groupType}', 'PeopleController@filterPeople')
        ->name('people.filter');

Route::get('/uploadImage', 'PeopleController@upload')
        ->name('upload_images');

// Upload images from folder
Route::get('/uploadImageFromFolder', 'PeopleController@uploadImageFromFolder');
Route::get('/grouppermit/{user}/loadGroupPermit', 'GroupPermitController@loadGroupPermit');
Route::get('/gategroup/{user}/loadGateGroup', 'GategroupController@loadGateGroup');
Route::resource('/sms', 'SmsController')
        ->parameters([
                'sms' => 'sms'
        ]);

Route::post('/car/search', 'CarController@search')
        ->name('search_car');

/* search info search by data for card */
Route::post('/card/search', 'CardController@indexSearch')
        ->name('search_card');

Route::post('/card/loadCard', 'CardController@loadCard')
        ->name('load_card');
/* search only card*/
Route::post('/cards/searchCard', 'CardController@cardSearch')
        ->name('card_search');

Route::get('/terms/data/all', 'TermController@allTerm');

Route::get('/base/all_information', 'RegistrationController@baseInformation')
    ->name ('base.all_Information');

Route::get('/dormitory/all_information', 'BuildingInformationController@dormitoryInformation')
    ->name ('dormitory.all_Information');

Route::post('unlock', 'HomeController@checkAndUnlockUser')
     ->name ('unlock');
/*
 * Report based on
 */
/* report  show user*/
Route::get('/report/showUser', 'ReportController@showUser')
        ->name('report_show_user');
/* report search user */
Route::post('/report/search', 'ReportController@searchUser')
        ->name('report_search_user');
/* report search edit user */
Route::post('/report/search/edit', 'ReportController@searchEditUser')
        ->name('report_search_edit_user');
/* report  traffic */
Route::get('/report/traffic', 'ReportController@index')
        ->name('report_traffic');
/* report show 50 log traffic */
Route::get('/report/showTraffic', 'ReportController@showTraffic')
        ->name('report_show_traffic');
 /* report show 50 log traffic */
Route::get('/report/monitorTraffic', 'ReportController@monitorTraffic')
        ->name('report_monitor_traffic');
/* report search traffic */
Route::post('/report/searchTraffic', 'ReportController@searchTraffic')
        ->name('report_search_tarffic');
/* report search traffic */
Route::post('/report/searchMyTraffic', 'ReportController@searchMyTraffic')
        ->name('report_search_my_tarffic');
 /* Dashboard chart based on */
Route::get('/report/chartTodayTraffic', 'ReportController@chartTodayTraffic')
        ->name('chart_today_hour');
Route::get('/report/InputOutput', 'InputOutputReportController@InputOutputPDF')
        ->name('download_all_traffic');
// Route::post('/report/exportToExcel', 'GatetrafficController@exportToExcel');
Route::post('/report/traffic/exportToExcel', 'GatetrafficController@trafficExportToExcel')
        ->name('export.report.traffic.excel');

Route::post('/report/traffic/exportToPDF', 'GatetrafficController@trafficExportToPDF')
        ->name('export.report.traffic.pdf');
/* Dashboard  home group */
/**
 * Show Count Daily Traffic
 */
Route::get('traffic-count-daily', 'DashboardChartController@chartCountDailyTraffic')
        ->name('report.count.traffic.daily');

Route::get('report-traffic-daily', 'DashboardChartController@loadPresentReport')
        ->name('report.traffic.present');

/**
 * Show Count Gate Device active
 */
Route::get('gatedevice-count-active', 'GatedeviceController@chartCountActiveDevice')
        ->name('report.count.gatedevice.active');

Route::get('report-gatedevice-active', 'DashboardChartController@loadGateDeviceActiveReport')
        ->name('report.gatedevice.active');

/**
 * Show Count SMS
 */
Route::get('posted-sms-count', 'SmsController@CountPostedSMS')
        ->name('report.count.posted.sms');

Route::get('report-posted-sms', 'DashboardChartController@loadPostedSMSReport')
        ->name('report.posted.sms');
/**
 * Show Count Refferal
 */
Route::get('referral-data-count', 'ReferralController@countReferral')
        ->name('report.count.referral.data');
/**
 * Show Chart daily traffic
 */
Route::get('traffic-daily', 'DashboardChartController@chartDailyTraffic')
        ->name('report.traffic.daily');
/**
 * Show Chart weekday traffic
 */
Route::get('traffic-weekly', 'DashboardChartController@chartWeekdayTraffic')
        ->name('report.traffic.weekly');
/**
 * Show Chart month traffic
 */
Route::get('traffic-monthly', 'DashboardChartController@chartMonthTraffic')
        ->name('report.traffic.monthly');
/* end Dashboard  home group */
/* Car Dashboard group */
/**
 * Show Count Daily Traffic
 */
Route::get('car-traffic-count-daily', 'DashboardCarController@CountDailyCarTraffic')
        ->name('report.count.car.traffic.daily');
/**
 * Show Count Antenna
 */
Route::get('antenna-count-active', 'GatedeviceController@CountActiveAntenna')
        ->name('report.count.antenna.active');
/**
 * Show Chart daily traffic
 */
Route::get('car-traffic-daily', 'DashboardCarController@chartDailyCarTraffic')
        ->name('report.car.traffic.daily');
/**
 * Show Chart weekday traffic
 */
Route::get('car-traffic-weekly', 'DashboardCarController@chartWeekdayCarTraffic')
        ->name('report.car.traffic.weekly');
/**
 * Show Chart month traffic
 */
Route::get('car-traffic-monthly', 'DashboardCarController@chartMonthCarTraffic')
        ->name('report.car.traffic.monthly');
/* end Car Dashboard group */
/**
 * Show  Pie Chart Staff in report Users
 */

Route::get('/pie-chart-report-user-card/{groupId}/{cardtypeId}',
            'CardController@reportCardChart')
            ->name('report.user.card.count.all');

Route::put('/room/{room}/setMaterial', 'RoomController@setMaterial');
Route::put('/cards/{card}/setGatedevice', 'CardController@setGatedevice');

/**
 * get cdn -> send user picture
 */
Route::get('getUserCDN/{cdn}/image', 'RaspberryController@getPictureUserByCDN');

/**
 * get cdn -> send Data user:(name, lastname, code, enabled_card, enabled_user)
 */
Route::get('getDataUser/{cdn}/listdata', 'RaspberryController@getDataUserByCDN');
/**
 * get IP Amoeba ->  send [cdn, gatedevice_ip]
 */
Route::get('listAllowTraffic/{amoeba_ip}', 'AmoebaController@listAllowTraffic');

Route::get('listDataUser/{amoeba_ip}', 'AmoebaController@listDataUser');

Route::get('myData', 'RaspberryController@routin_check_data');

Route::get('accesscontrol/{code}/{ip}/{command}', 'RaspberryController@parseData');
Route::get('accesscontrol/duplicate/{code}/{ip}/{command}', 'RaspberryController@duplicate_data');
Route::get('accesscontrol/{card}/{ip}/{date}/{direct}/{message}', 'RaspberryController@saveData');
Route::get('updateGate/{ip}/{status}', 'RaspberryController@updateStatusNetworkGate');
Route::get('disconnectGate/{state}', 'RaspberryController@disconnectAllGate');

// Route::get('accesscontrol/{code}/{ip}', 'RaspberryController@webService');
// Route::get('gateresponse/{code}/{ip}', 'RaspberryController@sendResponseWebService');
Route::get('sendresponse/{code}/{ip}', 'RaspberryController@sendResponseWebService');
Route::get('getDataFromAmoeba', 'AmoebaController@getDataAmoeba');
Route::get('listDataFingerprint', 'FingerprintController@listDataFingerprint');

Route::get('publish', function () {
    Redis::publish('test-channel', json_encode(['foo' => 'bar']));
});
Route::post('lock_gate_device', 'GatedeviceController@LockGateDevice')
          ->name('tcp.client.unlock.input');

