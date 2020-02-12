import Store from './store'
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import VueFormWizard from 'vue-form-wizard';
Vue.use(VueFormWizard)

import CarWidget from '../../Components/CarWidget';
import CarSearch from '../../Components/CarSearchWidget'


window.v = new Vue({
    el: '#app',
    store: Store,

    components:{
        CarWidget,
        CarSearch,
        persianCalendar: VuePersianDatetimePicker
    },

    data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        isLoading: true,
        tempRecord: {},
        selectedPersonId: null,
        cardTypeId: 4, // tag car type
        modalMode: Enums.FormMode.normalModal,
        lastTimerId: -1,
        searchWord: null,
    },

     watch:{
        /**
         * Search word watcher
         */
        searchWord(oldWord, newWord) {
            clearTimeout(this.lastTimerId);

            this.lastTimerId = setTimeout (() => {
                this.loadRecords(this.page,
                                 this.searchWord);
            }, 500);
        }
    },

    created() {
        this.tempRecord.user = this.emptyRecord.user;
        this.tempRecord.people = this.emptyRecord.people;
        this.tempRecord.card = this.emptyRecord.card;
        this.tempRecord.car = this.emptyRecord.car;
        this.tempRecord.group = {};
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadRecords(this.page, this.searchWord);
        this.loadCarColors();
        this.loadCarTypes();
        this.loadCarLevels();
        this.loadCarSystems();
        this.loadCarModels();
        this.loadCarFuels();
        this.loadCarPlateTypes();
        this.loadCarPlateCities();
        this.loadGroups();
    },

    computed: {
        /**
         * Generate new Empty record
         */
        emptyRecord: () => { return {
                                        id: 0,
                                        editMode: false,
                                        deleteMode: false,
                                        refreshMode: false,
                                        user: {
                                            id:0
                                        },
                                        group:{
                                            id: 0,
                                        },
                                        card: {
                                            id:0,
                                            cdn: '',
                                            startDate: '',
                                            endDate: '',
                                            state: 0,
                                        },

                                        people:{
                                            id: 0,
                                            code: '',
                                            nationalId:'',
                                            name: '',
                                            lastname: '',
                                        },

                                        car:{
                                            id: 0,
                                            plate_first:'',
                                            plate_second: '',
                                            plate_word: '',
                                            model: '',
                                            capacity: '',
                                            chasiscode: '',
                                            enginecode: '',
                                            color:{
                                                id: 0
                                            },
                                            fuel:{
                                                id: 0
                                            },
                                            level:{
                                                id: 0
                                            },
                                            model:{
                                                id:0
                                            },
                                            system:{
                                                id: 0
                                            },
                                            type: {
                                                id: 0
                                            },
                                            plate_type:{
                                                id: 0
                                            },
                                            plate_city:{
                                                id: 0,
                                            },

                                        },


                                    }
                            },

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        searchdata: state => state.$store.getters.searchdata,
        hasSearch: state => (0 < state.searchdata.length),

        searchDataCar: state => state.$store.getters.searchDataCar,
        hasSearchDataCar: state => (0 < state.searchDataCar.length),

        car_types: state => state.$store.getters.car_types,
        car_levels: state => state.$store.getters.car_levels,
        car_systems: state => state.$store.getters.car_systems,
        car_models: state => state.$store.getters.car_models,
        car_fuels: state => state.$store.getters.car_fuels,
        car_colors: state => state.$store.getters.car_colors,
        car_plate_types: state => state.$store.getters.car_plate_types,
        car_plate_cities: state => state.$store.getters.car_plate_cities,
        groups: state => state.$store.getters.groups,
    },

    methods: {
        /**
         * Convert gregorian date to persian
         */
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },

        /**
         * Convert persian date to gregorian
         */
        toGregorian(pDate) {
            return window.Helper.jalaaliToGregorian(pDate);
        },

         /**
         * Change form mode
         *
         * @param      {<type>}  formMode  The form mode
         */
        changeFormMode(formMode){
            this.formMode = formMode;
        },

        /**
         * Show Invisible items
         */
        showInvisibleItems() {
            document.querySelectorAll('.invisible')
                .forEach(item => {
                    item.classList.remove('invisible');
                });
        },

        /**
         * Clear errors
         */
        clearErrors() {
            this.errors.clear();

            document.querySelectorAll('.form-control')
                .forEach(x => {
                    $(x).removeClass('has-error')
                        .parent()
                        .addClass('label-floating is-empty');
                });
        },

         /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * Load Groups list
         */
        loadGroups() {
            this.$store.dispatch('loadGroups')
                .then(res => {
                    this.isLoading = false;
                    Helper.scrollToApp ();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Car Color list
         */
        loadCarColors(callback) {
            this.$store.dispatch('loadCarColors')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Car Color list
         */
        loadCarColors(callback) {
            this.$store.dispatch('loadCarColors')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Car Type list
         */
        loadCarTypes(callback) {
            this.$store.dispatch('loadCarTypes')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Car Level list
         */
        loadCarLevels(callback) {
            this.$store.dispatch('loadCarLevels')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Car Level list
         */
        loadCarSystems(callback) {
            this.$store.dispatch('loadCarSystems')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Car Model list
         */
        loadCarModels(callback) {
            this.$store.dispatch('loadCarModels')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Car Level list
         */
        loadCarFuels(callback) {
            this.$store.dispatch('loadCarFuels')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Plate Type list
         */
        loadCarPlateTypes(callback) {
            this.$store.dispatch('loadCarPlateTypes')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load  Plate Type list
         */
        loadCarPlateCities(callback) {
            this.$store.dispatch('loadCarPlateCities')
                .then(res => {
                    Helper.scrollToApp ();
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
         /**
         * Load  First item comboBox
         */
        fillComoboxes() {
            /**
             *  Group Combo
             */
            if ( (undefined != this.$store.getters.groups[0]) ||
                   (null != this.$store.getters.groups[0]) )
            {
                this.tempRecord.group.id = this.$store.getters.groups[0].id;
            }
            else {
                this.tempRecord.group.id = 0;
            }

            /**
             *  Car Type Combo
             */
            if ( (undefined != this.$store.getters.car_types[0]) ||
                   (null != this.$store.getters.car_types[0]) )
            {
                this.tempRecord.car.type.id = this.$store.getters.car_types[0].id;
            }
            else {
                this.tempRecord.car.type.id = 0;
            }

            /**
             * Car System Combo
             */
            if ((null != this.$store.getters.car_systems[0]) ||
                (undefined != this.$store.getters.car_systems[0]))
            {

                this.tempRecord.car.system.id = this.$store.getters.car_systems[0].id;
            }
            else {
                this.tempRecord.car.system.id = 0;
            }

            /**
             * Car Color Combo
             */
            if ((null != this.$store.getters.car_colors[0]) ||
                (undefined != this.$store.getters.car_colors[0]))
            {
                this.tempRecord.car.color.id = this.$store.getters.car_colors[0].id;
            }
            else {
                this.tempRecord.car.color.id = 0;
            }

            /**
             * Car Fuel Combo
             */
            if ((null != this.$store.getters.car_fuels[0]) ||
                (undefined != this.$store.getters.car_fuels[0]))
            {
                this.tempRecord.car.fuel.id = this.$store.getters.car_fuels[0].id;
            }
            else {
                this.tempRecord.car.fuel.id = 0;
            }

             /**
             * Car Level Combo
             */
            if ((null != this.$store.getters.car_levels[0]) ||
                (undefined != this.$store.getters.car_levels[0]))
            {
                this.tempRecord.car.level.id = this.$store.getters.car_levels[0].id;
            }
            else {
                this.tempRecord.car.level.id = 0;
            }

             /**
             * Car Model Combo
             */
            if ((null != this.$store.getters.car_models[0]) ||
                (undefined != this.$store.getters.car_models[0]))
            {
                this.tempRecord.car.model.id = this.$store.getters.car_models[0].id;
            }
            else {
                this.tempRecord.car.model.id = 0;
            }

            /**
             * Car Plate Type Combo
             */
            if ( (null != this.$store.getters.car_plate_types[0]) ||
                (undefined != this.$store.getters.car_plate_types[0])) {
                    this.tempRecord.car.plate_type.id = this.$store.getters.car_plate_types[0].id;
            }
            else {
                this.tempRecord.car.plate_type.id = 0;
            }

             /**
             * Car Plate City Combo
             */
            if ((null != this.$store.getters.car_plate_cities[0]) ||
                (undefined != this.$store.getters.car_plate_cities[0])) {
                    this.tempRecord.car.plate_city.id = this.$store.getters.car_plate_cities[0].id;
            }
            else {
                this.tempRecord.car.plate_city.id = 0;
            }

        },

        /**
         * Tab Switch Search
         */
        tabSwitchSearch(){
            this.errors.clear ();

            return Promise.all([
                this.$validator.validate('group_id'),
                this.$validator.validate('search'),
              ]).then ((resolve, reject) => {
                    var hasErr = this.errors.any ();

                    if (! hasErr)
                    {
                        this.searchRecord();
                        return true;
                  }

                  let err = this.errors.all ();

                  err = err.join ('<br/>');
                  demo.showNotification(err, 'warning');

                return false;
              });
        },

        /**
         * Tab Switch Search
         */
        tabSwitchUser(){
            this.errors.clear ();
            if (null != this.selectedPersonId) {
                return true;
            }
            else{
                demo.showNotification('شخص مورد نظر را انتخاب نمایید', 'warning');
            }
        },

         /**
         * Tab Switch Car
         */
        tabSwitchCar (){
            this.errors.clear ();
            return Promise.all([
                this.$validator.validate('car_plate_type_id', this.tempRecord.car.plate_type.id),
                this.$validator.validate('plate_first', this.tempRecord.car.plate_first),
                this.$validator.validate('plate_second', this.tempRecord.car.plate_second),
                this.$validator.validate('plate_word', this.tempRecord.car.plate_word),
                this.$validator.validate('plate_city_id', this.tempRecord.car.plate_city.id),
                this.$validator.validate('car_type_id', this.tempRecord.car.type.id),
                this.$validator.validate('car_color_id', this.tempRecord.car.color.id),
                this.$validator.validate('car_model_id', this.tempRecord.car.model.id),
                this.$validator.validate('car_fuel_id', this.tempRecord.car.fuel.id),

              ]).then ((resolve, reject) => {
                  var hasErr = this.errors.any ();

                  if (! hasErr)
                  {
                      return true;
                  }

                  let err = this.errors.all ();

                  err = err.join ('<br/>');
                  demo.showNotification(err, 'warning');

                  return false;
              });
        },

         /**
         * Tab Switch Tag
         */
        tabSwitchTag (){
            this.errors.clear ();

            return Promise.all([
                this.$validator.validate('cdn'),
                this.$validator.validate('startDate'),
                this.$validator.validate('endDate'),

              ]).then ((resolve, reject) => {
                  var hasErr = this.errors.any ();

                  if (! hasErr)
                  {
                      return true;
                  }

                  let err = this.errors.all ();

                  err = err.join ('<br/>');
                  demo.showNotification(err, 'warning');

                return false;
              });
        },

        /**
         * Search Data
         */
        searchRecord(){
             // Prepare data
            let data = {
                search: this.tempRecord.search,
                group_id: this.tempRecord.group.id,
            };
            this.isLoading = true;

            //Try to Search
            this.$store.dispatch('searchRecord', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                    demo.showNotification(err.message, 'danger');
                });
        },

        /**
         * New record dialog
         */
        newRecord() {
            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
             this.$refs.car_wizard.reset();
            this.changeFormMode(Enums.FormMode.register);

            this.fillComoboxes();
        },

        /**
         * Selection Changed
         */
        selectionChanged(userData) {
            this.selectedPersonId = userData.id;
            this.tempRecord.user.id = userData.id;
        },
         /**
        * Edit record from modal
        */
        editDataCar(data){
            let record = {
                id: data.id,
                editMode : true,
                refreshMode: false,
                deleteMode : true,
                card: {
                    id : data.card.id,
                    cdn: data.card.cdn,
                    state: data.card.state,
                    startDate: Helper.gregorianToJalaali(data.card.startDate),
                    endDate: Helper.gregorianToJalaali(data.card.endDate),
                    cardtype : {
                        id: data.card.cardtype.id,
                        name:data.card.cardtype.name,
                    },
                },
                user : {
                    id: this.selectedPersonId,
                },
                group :{
                    id : this.tempRecord.group.id,
                    name : this.tempRecord.group.name,
                },
                car: {
                    id: data.id,
                    plate_first: data.plate_first,
                    plate_second: data.plate_second,
                    plate_word: data.plate_word,
                    // model: record.modal,
                    capacity: data.capacity,
                    chasiscode: data.chasiscode,
                    enginecode: data.enginecode,
                    color:{
                        id: data.car_color_id,
                    },
                    fuel: {
                        id: data.car_fuel_id,
                    },
                    level: {
                        id: data.car_level_id,
                    },
                    model:{
                        id: data.car_model_id,
                    },
                    system: {
                        id: data.car_system_id,
                    },
                    type:{
                        id: data.car_type_id,
                    },
                    plate_type: {
                        id: data.car_plate_type_id,
                    },
                    plate_city:{
                        id: data.car_plate_city_id,
                    }
                },
            };

            $("#carModal").removeClass('show');
            this.editRecord(record);
        },
        /**
        * Show Car
        */
         showCar(userData){
            if (userData.cars.length > 0){
                this.modalMode = Enums.FormMode.normal;
                $("#carModal").modal('show');
            }
        },
        prepareEditRecord(record){
            let data = {
                id: record.id ,
                user: {
                    id: record.users[0].id,
                },
                group: {
                    id: record.users[0].group.id,
                    name: record.users[0].group.name,
                },
                card: {
                    id: record.card.id,
                    cdn: record.card.cdn,
                    startDate:Helper.gregorianToJalaali(record.card.startDate),
                    endDate: Helper.gregorianToJalaali(record.card.endDate),
                    state: record.card.state,
                    cardtype: {
                        id: record.card.cardtype.id,
                        name: record.card.cardtype.name
                    }
                },
                car: {
                    id: record.id,
                    plate_first: record.plate_first,
                    plate_second: record.plate_second,
                    plate_word: record.plate_word,
                    // model: record.modal,
                    capacity: record.capacity,
                    chasiscode: record.chasiscode,
                    enginecode: record.enginecode,
                    color:{
                        id: record.car_color_id,
                    },
                    fuel:{
                        id: record.car_fuel_id,
                    },
                    level: {
                        id: record.car_level_id,
                    },
                    model:{
                        id: record.car_model_id,
                    },
                    system:{
                        id: record.car_system_id,
                    },
                    type:{
                        id: record.car_type_id,
                    },
                    plate_type: {
                      id: record.car_plate_type_id,
                    },
                    plate_city:{
                        id: record.car_plate_city_id,
                    },
                },
            };
            this.editRecord(data);
        },

         /**
         * Edit a record
         */
        editRecord(record) {
            this.clearErrors();
            this.insertMode = true;

            this.tempRecord = {
                id: record.id ,
                user: {
                    id: record.user.id,
                },
                group: {
                    id: record.group.id,
                    name: record.group.name,
                },
                card: {
                    id: record.card.id,
                    cdn: record.card.cdn,
                    startDate:record.card.startDate,
                    endDate: record.card.endDate,
                    state: record.card.state,
                    cardtype: {
                        id: record.card.cardtype.id,
                        name: record.card.cardtype.name
                    }
                },
                car: {
                    id: record.car.id,
                    plate_first: record.car.plate_first,
                    plate_second: record.car.plate_second,
                    plate_word: record.car.plate_word,
                    // model: record.modal,
                    capacity: record.car.capacity,
                    chasiscode: record.car.chasiscode,
                    enginecode: record.car.enginecode,
                    color:{
                        id: record.car.color.id,
                    },
                    fuel:{
                        id: record.car.fuel.id,
                    },
                    level: {
                        id: record.car.level.id,
                    },
                    model:{
                        id: record.car.model.id,
                    },
                    system:{
                        id: record.car.system.id,
                    },
                    type:{
                        id: record.car.type.id,
                    },
                    plate_type: {
                      id: record.car.plate_type.id,
                    },
                    plate_city:{
                        id: record.car.plate_city.id,
                    },
                },
            };

            // Show register mode
            this.formMode = Enums.FormMode.register;
            this.$refs.car_wizard.changeTab(0,2);
        },
        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * Load Records list
         */
        loadRecords(page, searchWord) {
            this.page = page;
            this.isLoading = true;

            if (this.$store.getters.searchMode){
                this.searchCard(page);
                return;
            }

            let data = {
                page: page,
                searchWord: searchWord
            };

            this.$store.dispatch('loadRecords', data)
                .then(res => {
                    Helper.scrollToApp ();
                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record){
            this.tempRecord.id = record.id;
            $('#removeRecordModal').modal('show');
        },

        /**
         * Delete a record
         */
        deleteRecord() {
            this.isLoading = true;

            this.$store.dispatch('deleteRecord', this.tempRecord.id)
                .then(res => {
                    this.isLoading = false;

                    demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
                    this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },

        /**
         * Save record
         */
        saveRecord() {
            let data = {
                id: this.tempRecord.id,

                user :{
                    id: this.tempRecord.user.id,
                },

                card:{
                    id: this.tempRecord.card.id,
                    cdn: this.tempRecord.card.cdn,
                    state: this.tempRecord.card.state,
                    startDate: this.toGregorian(this.tempRecord.card.startDate),
                    endDate: this.toGregorian(this.tempRecord.card.endDate),
                    cardtype_id: this.cardTypeId,
                },

                car:{
                    id: this.tempRecord.car.id,
                    card_id: this.tempRecord.card.id,
                    color_id: this.tempRecord.car.color.id,
                    fuel_id: this.tempRecord.car.fuel.id,
                    level_id: this.tempRecord.car.level.id,
                    system_id: this.tempRecord.car.system.id,
                    model_id: this.tempRecord.car.model.id,
                    type_id: this.tempRecord.car.type.id,
                    plate_type_id: this.tempRecord.car.plate_type.id,
                    plate_city_id: this.tempRecord.car.plate_city.id,
                    plate_first: this.tempRecord.car.plate_first,
                    plate_second: this.tempRecord.car.plate_second,
                    plate_word: this.tempRecord.car.plate_word,
                    capacity: this.tempRecord.car.capacity,
                    chasiscode: this.tempRecord.car.chasiscode,
                    enginecode: this.tempRecord.car.enginecode,
                },
            };

            this.isLoading = true;
            // Try to save
            this.$store.dispatch('saveRecord', data)
                .then(res => {
                    this.isLoading = false;

                    if (res) {
                        demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    }
                    else {
                        demo.showNotification('این پلاک قبلا ثبت شده است', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('این پلاک قبلا ثبت شده است', 'danger');
                    }
                    else {
                        demo.showNotification(err.message, 'danger');
                    }
                });

            return;
        },
    },
})
