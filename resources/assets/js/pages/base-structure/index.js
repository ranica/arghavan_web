import Store from './store';
import CardMobile from '../Components/MobileWidget';
import CityMobile from '../Components/CityWidget';
import BlockMobile from '../Components/BlockWidget';
import BuildingMobile from '../Components/BuildingWidget';
import ContractorMobile from '../Components/ContractorWidget';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import NumberInput from '@chenfengyuan/vue-number-input';

Vue.component('number-input', NumberInput);

window.v = new Vue({
    el: '#app',
    store: Store,
    components: {
        CardMobile,
        CityMobile,
        BlockMobile,
        ContractorMobile,
        BuildingMobile,
        persianCalendar: VuePersianDatetimePicker
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
        this.loadMelliats(this.page);
        this.loadGroups(this.page);
        this.loadCardTypes(this.page);
        this.loadContractors(this.page);
        this.loadContracts(this.page);
        this.loadDepartments(this.page);
        this.loadKinTypes(this.page);
        this.loadProvinces(this.page);
        this.loadAllProvinces(this.page);
        this.loadCities(this.page);
        this.loadBlocks(this.page);
        this.loadBuildingTypes(this.page);
        this.loadBuildings(this.page);
    },

    computed: {
        /**
         * Generate new Empty record
         */
        emptyRecord: () => {
            return {
                id: 0,
                name: '',
                room_count: 0,
                floor_count: 0,
                code: '', // for block
                beginDate: '',
                endDate: '',
                state: 0,
                //for city
                province: {
                    id: 0,
                },
                block:{
                    id: 0,
                },
                building_type: {
                    id: 0,
                },
            }
        },

        hasMelliatRows: state => ((state.$store.getters.melliats != null) &&
            (state.$store.getters.melliats.length > 0)),

        hasGroupRows: state => ((state.$store.getters.groups != null) &&
            (state.$store.getters.groups.length > 0)),

        hasCardTypeRows: state => ((state.$store.getters.card_types != null) &&
            (state.$store.getters.card_types.length > 0)),

        hasContractorRows: state => ((state.$store.getters.contractors != null) &&
            (state.$store.getters.contractors.length > 0)),

        hasContractRows: state => ((state.$store.getters.contracts != null) &&
            (state.$store.getters.contracts.length > 0)),

        hasDepartmentRows: state => ((state.$store.getters.departments != null) &&
            (state.$store.getters.departments.length > 0)),

        hasKinTypeRows: state => ((state.$store.getters.kin_types != null) &&
            (state.$store.getters.kin_types.length > 0)),

        hasProvinceRows: state => ((state.$store.getters.provinces != null) &&
            (state.$store.getters.provinces.length > 0)),

        hasCityRows: state => ((state.$store.getters.cities != null) &&
            (state.$store.getters.cities.length > 0)),

        hasBlockRows: state => ((state.$store.getters.blocks != null) &&
            (state.$store.getters.blocks.length > 0)),

        hasBuildingTypeRows: state => ((state.$store.getters.buildingTypes != null) &&
            (state.$store.getters.buildingTypes.length > 0)),

        hasBuildingRows: state => ((state.$store.getters.buildings != null) &&
            (state.$store.getters.buildings.length > 0)),

        melliats: state => state.$store.getters.melliats,
        melliats_paginate: state => state.$store.getters.melliatsPaginate,

        groups: state => state.$store.getters.groups,
        groups_paginate: state => state.$store.getters.groupsPaginate,

        card_types: state => state.$store.getters.card_types,
        card_types_paginate: state => state.$store.getters.card_typesPaginate,

        contractors: state => state.$store.getters.contractors,
        contractors_paginate: state => state.$store.getters.contractorsPaginate,

        contracts: state => state.$store.getters.contracts,
        contracts_paginate: state => state.$store.getters.contractsPaginate,

        departments: state => state.$store.getters.departments,
        departments_paginate: state => state.$store.getters.departmentsPaginate,

        kin_types: state => state.$store.getters.kin_types,
        kin_types_paginate: state => state.$store.getters.kin_typesPaginate,

        provinces: state => state.$store.getters.provinces,
        allProvinces: state => state.$store.getters.allProvinces,
        provinces_paginate: state => state.$store.getters.provincesPaginate,

        cities: state => state.$store.getters.cities,
        cities_paginate: state => state.$store.getters.citiesPaginate,

        blocks: state => state.$store.getters.blocks,
        blocks_paginate: state => state.$store.getters.blocksPaginate,

        buildingTypes: state => state.$store.getters.buildingTypes,
        building_types_paginate: state => state.$store.getters.buildingTypesPaginate,

        buildings: state => state.$store.getters.buildings,
        buildings_paginate: state => state.$store.getters.buildingsPaginate,

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
    },

    methods: {
        /**
         * Page changed
         */
        pageChanged() {
            this.loadMelliats(this.page);
            this.loadGroups(this.page);
            this.loadCardTypes(this.page);
            this.loadContractors(this.page);
            this.loadContracts(this.page);
            this.loadDepartments(this.page);
            this.loadKinTypes(this.page);
            this.loadProvinces(this.page);
            this.loadAllProvinces(this.page);
            this.loadCities(this.page);
            this.loadBlocks(this.page);
            this.loadBuildingTypes(this.page);
            this.loadBuildings(this.page);
        },

        /**
         * Loads Melliat
         */
        loadMelliats(page) {
            let url = document.pageData.base_structure.pageUrls.melliats_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadMelliats', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },

        /**
         * Loads Groups
         */
        loadGroups(page) {
            let url = document.pageData.base_structure.pageUrls.groups_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadGroups', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Card Type
         */
        loadCardTypes(page) {
            let url = document.pageData.base_structure.pageUrls.card_types_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCardTypes', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Contractor
         */
        loadContractors(page) {
            let url = document.pageData.base_structure.pageUrls.contractors_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadContractors', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Contract
         */
        loadContracts(page) {
            let url = document.pageData.base_structure.pageUrls.contracts_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadContracts', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Department
         */
        loadDepartments(page) {
            let url = document.pageData.base_structure.pageUrls.departments_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadDepartments', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads KinType
         */
        loadKinTypes(page) {
            let url = document.pageData.base_structure.pageUrls.kin_types_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadKinTypes', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Province
         */
        loadProvinces(page) {
            let url = document.pageData.base_structure.pageUrls.provinces_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadProvinces', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads All Province for city page
         */
        loadAllProvinces(page) {
            let url = document.pageData.base_structure.pageUrls.provinces_all_index + '?page=' + page;

            let data = {
                url: url
            };
            this.$store.dispatch('loadAllProvinces', data);
        },


        /**
         * Loads Citie
         */
        loadCities(page) {
            let url = document.pageData.base_structure.pageUrls.cities_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadCities', data);
            Helper.scrollToApp ();
        },
        /**
         * Loads Blocks
         */
        loadBlocks(page) {
            let url = document.pageData.base_structure.pageUrls.blocks_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadBlocks', data);
            Helper.scrollToApp ();
        },

        /**
         * Loads Building Type
         */
        loadBuildingTypes(page) {
            let url = document.pageData.base_structure.pageUrls.building_types_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadBuildingTypes', data);
            Helper.scrollToApp ();
        },

         /**
         * Loads Building
         */
        loadBuildings(page) {
            let url = document.pageData.base_structure.pageUrls.buildings_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadBuildings', data);
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
        editRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                province: 0,
                building_type :0,
                block: 0,
            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * Edit city record
         */
        editCityRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                province: {
                    id: record.province.id,
                    name: record.province.name,
                },

                building_type :0,
                block: 0,
            };

            this.formMode = Enums.FormMode.register;
        },

        /*
         * edit contractor record
         */
        editContractorRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                state: record.state,
                beginDate: Helper.gregorianToJalaali(record.beginDate),
                endDate: Helper.gregorianToJalaali(record.endDate),
                province: 0,
                building_type :0,
                block: 0,
            };

            this.formMode = Enums.FormMode.register;
        },

        /*
         * edit Block record
         */
        editBlockRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                code: record.code,
                province: 0,
                building_type :0,
            };

            this.formMode = Enums.FormMode.register;
        },

         /**
         * Edit Building record
         */
        editBuildingRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                room_count: record.room_count,
                floor_count: record.floor_count,
                building_type: {
                    id: record.building_type.id,
                    name: record.building_type.name,
                },
                block: {
                    id: record.block.id,
                    name: record.block.name,
                },
                 province: 0,
            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * Save Melliat Record
         */
        saveMelliatRecord() {
            this.$validator.validate('name_melliat')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/melliats',
                            function: 'createMelliats',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/melliats/' + data.id;
                            data.function = 'updateMelliats';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Group Record
         */
        saveGroupRecord() {
            this.$validator.validate('name_group')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/groups',
                            function: 'createGroups',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/groups/' + data.id;
                            data.function = 'updateGroups';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save CardType Record
         */
        saveCardTypeRecord() {
            this.$validator.validate('name_card_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/cardtypes',
                            function: 'createCardTypes',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/cardtypes/' + data.id;
                            data.function = 'updateCardTypes';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Contractor Record
         */
        saveContractorRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('name_contractor'),
                this.$validator.validate('startDate_contractor'),
                this.$validator.validate('endDate_contractor'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveDataContractor();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },
        /**
         * Saves a data contractor.
         */
        saveDataContractor() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                name: this.tempRecord.name,
                beginDate: Helper.jalaaliToGregorian(this.tempRecord.beginDate),
                endDate: Helper.jalaaliToGregorian(this.tempRecord.endDate),
                state: this.tempRecord.state,
                url: '/contractors',
                function: 'createContractors',
            };

            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/contractors/' + data.id;
                data.function = 'updateContractors';
                this.updateRecord(data);
            }

            return;

        },



        /**
         * Save Contract Record
         */
        saveContractRecord() {
            this.$validator.validate('name_contract')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/contracts',
                            function: 'createContracts',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/contracts/' + data.id;
                            data.function = 'updateContracts';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Department Record
         */
        saveDepartmentRecord() {
            this.$validator.validate('name_department')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/departments',
                            function: 'createDepartments',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/departments/' + data.id;
                            data.function = 'updateDepartments';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save KinType Record
         */
        saveKinTypeRecord() {
            this.$validator.validate('name_kin_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/kintypes',
                            function: 'createKinTypes',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/kintypes/' + data.id;
                            data.function = 'updateKinTypes';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Province Record
         */
        saveProvinceRecord() {
            this.$validator.validate('name_province')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/provinces',
                            function: 'createProvinces',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/provinces/' + data.id;
                            data.function = 'updateProvinces';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Cities Record
         */
        saveCityRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('name_city'),
                this.$validator.validate('province_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveDataCity();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },
        /**
         * Saves a data city.
         */
        saveDataCity() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                name: this.tempRecord.name,
                province_id: this.tempRecord.province.id,
                url: '/cities',
                function: 'createCities',
            };
            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/cities/' + data.id;
                data.function = 'updateCities';
                this.updateRecord(data);
            }

            return;
        },

        /**
         * Save Blocks Record
         */
        saveBlockRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('name_block'),
                this.$validator.validate('code_block'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveDataBlock();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        /**
         * Saves a block.
         */
        saveDataBlock() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                name: this.tempRecord.name,
                code: this.tempRecord.code,
                url: '/blocks',
                function: 'createBlocks',
            };

            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/blocks/' + data.id;
                data.function = 'updateBlocks';
                this.updateRecord(data);
            }

            return;
        },
        /**
         * Save Building Type Record
         */
        saveBuildingTypeRecord() {
            this.$validator.validate('name_building_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/buildingTypes',
                            function: 'createBuildingTypes',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/buildingTypes/' + data.id;
                            data.function = 'updateBuildingTypes';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Save Building Record
         */
        saveBuildingRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('name_building'),
                this.$validator.validate('room_count_building'),
                this.$validator.validate('floor_count_building'),
                this.$validator.validate('building_type_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveDataBuilding();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

         /**
         * Saves a data building.
         */
        saveDataBuilding() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                name: this.tempRecord.name,
                floor_count: this.tempRecord.floor_count,
                room_count: this.tempRecord.room_count,
                block_id: this.tempRecord.block.id,
                building_type_id: this.tempRecord.building_type.id,
                url: '/buildings',
                function: 'createBuildings',
            };
            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/buildings/' + data.id;
                data.function = 'updateBuildings';
                this.updateRecord(data);
            }

            return;
        },
        /**
         * Create Record
        */
        createRecord(data) {
            this.$store.dispatch(data.function, data)
                .then(res => {
                    this.isLoading = false;
                    if (res) {
                        demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    } else {
                        demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                    } else {
                        demo.showNotification(err.message, 'danger');
                    }
                });
        },
        /**
         * Update Record
        */
        updateRecord(data) {
            this.$store.dispatch(data.function, data)
                .then(res => {
                    this.isLoading = false;
                    if (res) {
                        demo.showNotification('ویرایش اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    } else {
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
        readyToDelete(record, type) {
            this.tempRecord.id = record.id;
            $(`#removeRecordModal${type}`).show();
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
                    this.tempRecord = $.extend(true, {}, this.emptyRecord);
                    this.emptyRecord.id = 0;
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },

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
        changeFormMode(formMode) {
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
