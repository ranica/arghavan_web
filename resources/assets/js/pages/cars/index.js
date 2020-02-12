import Store from './store';
import SiteWidget from '../Components/SiteWidget';
import CardMobile from '../Components/MobileWidget';
// import BaseCarWidget from '../Components/BaseCarWidget';

window.v = new Vue({
    el: '#app',
    store: Store,

    components:{
        SiteWidget,
        CardMobile,
        // BaseCarWidget
    },

    data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        isLoading: true,
        tempRecord: {},
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadCarColors(this.page);
        this.loadCarFuels(this.page);
        this.loadCarLevels(this.page);
        this.loadCarModels(this.page);
        this.loadCarSystems(this.page);
        this.loadCarTypes(this.page);
        this.loadCarPlateTypes(this.page);
        this.loadCarSites(this.page);
    },

    computed: {
         /**
         * Generate new Empty record
         */
        emptyRecord: () => { return {
                                        id: 0,
                                        name: '',
                                        capacity: '',
                                        state:0,
                                    }
                            },

        hasColorRows: state => ((state.$store.getters.carColors != null) &&
                                (state.$store.getters.carColors.length  > 0)),

        hasFuelRows: state => ((state.$store.getters.carFuels != null) &&
                                (state.$store.getters.carFuels.length  > 0)),

        hasLevelRows: state => ((state.$store.getters.carLevels != null) &&
                                (state.$store.getters.carLevels.length  > 0)),

        hasModelRows: state => ((state.$store.getters.carModels != null) &&
                                (state.$store.getters.carModels.length  > 0)),

        hasSystemRows: state => ((state.$store.getters.carSystems != null) &&
                                (state.$store.getters.carSystems.length  > 0)),

        hasTypeRows: state => ((state.$store.getters.carTypes != null) &&
                                (state.$store.getters.carTypes.length  > 0)),

        hasCarPlateTypeRows: state => ((state.$store.getters.carPlateTypes != null) &&
                                    (state.$store.getters.carPlateTypes.length  > 0)),

        hasCarSiteRows: state => ((state.$store.getters.carSites != null) &&
                                    (state.$store.getters.carSites.length  > 0)),


        car_colors: state => state.$store.getters.carColors,
        car_colors_paginate: state => state.$store.getters.carColorsPaginate,

        car_fuels: state => state.$store.getters.carFuels,
        car_fuels_paginate: state => state.$store.getters.carFuelsPaginate,

        car_levels: state => state.$store.getters.carLevels,
        car_levels_paginate: state => state.$store.getters.carLevelsPaginate,

        car_models: state => state.$store.getters.carModels,
        car_models_paginate: state => state.$store.getters.carModelsPaginate,

        car_systems: state => state.$store.getters.carSystems,
        car_systems_paginate: state => state.$store.getters.carSystemsPaginate,

        car_types: state => state.$store.getters.carTypes,
        car_types_paginate: state => state.$store.getters.carTypesPaginate,

        car_plate_types: state => state.$store.getters.carPlateTypes,
        car_plate_types_paginate: state => state.$store.getters.carPlateTypesPaginate,

        car_sites: state => state.$store.getters.carSites,
        car_sites_paginate: state => state.$store.getters.carSitesPaginate,

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,


    },

    methods: {
         /**
         * Page changed
         */
        pageChanged() {
            this.loadCarColors(this.page);
            this.loadCarFuels(this.page);
            this.loadCarLevels(this.page);
            this.loadCarModels(this.page);
            this.loadCarSystems(this.page);
            this.loadCarTypes(this.page);
            this.loadCarPlateTypes(this.page);
            this.loadCarSites(this.page);
        },

        /**
         * Loads Car Color.
         */
        loadCarColors(page) {
            let url = document.pageData.carBase.pageUrls.carColors_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarColors', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Car Fuel.
         */
        loadCarFuels(page) {
            let url = document.pageData.carBase.pageUrls.carFuels_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarFuels', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Car Level.
         */
        loadCarLevels(page) {
            let url = document.pageData.carBase.pageUrls.carLevels_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarLevels', data);
            Helper.scrollToApp ();
        },

         /**
         * Loads Car Model.
         */
        loadCarModels(page) {
            let url = document.pageData.carBase.pageUrls.carModels_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarModels', data);
            Helper.scrollToApp ();
        },

         /**
         * Loads Car System.
         */
        loadCarSystems(page) {
            let url = document.pageData.carBase.pageUrls.carSystems_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarSystems', data);
            Helper.scrollToApp ();

        },

        /**
         * Loads Car Type.
         */
        loadCarTypes(page) {
            let url = document.pageData.carBase.pageUrls.carTypes_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarTypes', data);
            Helper.scrollToApp ();

        },

        /**
         * Loads Car Plate Type.
         */
        loadCarPlateTypes(page) {
            let url = document.pageData.carBase.pageUrls.carPlateTypes_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarPlateTypes', data);
            Helper.scrollToApp ();

        },

        /**
         * Loads Car Site
         */
        loadCarSites(page) {
            let url = document.pageData.carBase.pageUrls.carSites_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCarSites', data);
            Helper.scrollToApp ();
        },
        /**
         * New record dialog
         */
        newRecord() {
            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
        },
        /**
         * Edit record
         */
        editRecord(record){
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                capacity: record.capacity,
                state: record.state
            };

            this.formMode = Enums.FormMode.register;
        },
         /**
         * Save Color Record
         */
        saveColorRecord() {
            this.$validator.validate('name_color')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carColors',
                            function: 'createCarColors',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carColors/' + data.id;
                            data.function = 'updateCarColors';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save Fuel Record
         */
        saveFuelRecord() {
            this.$validator.validate('name_fuel')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carFuels',
                            function: 'createCarFuels',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carFuels/' + data.id;
                            data.function = 'updateCarFuels';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Level Record
         */
        saveLevelRecord() {
            this.$validator.validate('name_level')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carLevels',
                            function: 'createCarLevels',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {

                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carLevels/' + data.id;
                            data.function = 'updateCarLevels';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Model Record
         */
        saveModelRecord() {
            this.$validator.validate('name_model')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carModels',
                            function: 'createCarModels',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carModels/' + data.id;
                            data.function = 'updateCarModels';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save System Record
         */
        saveSystemRecord() {
            this.$validator.validate('name_system')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carSystems',
                            function: 'createCarSystems',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carSystems/' + data.id;
                            data.function = 'updateCarSystems';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },
        /**
         * Save Type Record
         */
        saveTypeRecord() {
            this.$validator.validate('name_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carTypes',
                            function: 'createCarTypes',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carTypes/' + data.id;
                            data.function = 'updateCarTypes';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Plate Type Record
         */
        savePlateTypeRecord() {
            this.$validator.validate('name_plate_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/carPlateTypes',
                            function: 'createCarPlateTypes',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carPlateTypes/' + data.id;
                            data.function = 'updateCarPlateTypes';
                            this.updateRecord(data);
                        }
                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save Site Record
         */
        saveSiteRecord() {
            this.$validator.validate('name_site'),
            this.$validator.validate('name_capacity')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            capacity: this.tempRecord.capacity,
                            state: this.tempRecord.state,
                            url: '/carSites',
                            function: 'createCarSites',
                        };

                        this.isLoading = true;

                        if (0 == data.id) {
                            this.createRecord(data);
                        }
                        else {
                            data.url  = '/carSites/' + data.id;
                            data.function = 'updateCarSites';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },
       /**
        *
        * @param {*} data
        */
        createRecord(data){
            this.$store.dispatch(data.function, data)
                .then(res => {
                    this.isLoading = false;
                    if (res) {
                        demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    }
                    else {
                        demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                    }
                    else {
                        demo.showNotification(err.message, 'danger');
                    }
                });
        },
        /**
         * Update Record
         *
         * @param      {<type>}  data    The data
         */
        updateRecord(data){
            this.$store.dispatch(data.function, data)
                .then(res => {
                    this.isLoading = false;
                    if (res) {
                        demo.showNotification('ویرایش اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    }
                    else {
                        demo.showNotification('این نام قبلا ویرایش شده است', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('این نام قبلا ویرایش شده است', 'danger');
                    }
                    else {
                        demo.showNotification(err.message, 'danger');
                    }
                });
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record, type){
            this.tempRecord = record;
            $(`#removeRecordModal${type}`).show();
        },
        /**
         * Preapre to delete for site car
         *
         * @param      {<type>}  record  The record
         */
        readyToDeleteSiteCar(record){
            this.tempRecord = record;
            $('#removeRecordModalSiteCar').modal('show');
        },
        /**
         * Delete a record
         */
        deleteRecord(namePage) {
            this.isLoading = true;
            let funName = 'delete' + namePage;
            let url = '/' + namePage + '/' + this.tempRecord.id;
            let data = {
                url: url,
                record: this.tempRecord
            };

            this.$store.dispatch(funName, data)
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
    },
})
