import ColorModule  from "./color/color";
import FuelModule   from "./fuel/fuel";
import LevelModule  from "./level/level";
import ModelModule  from "./model/model";
import SystemModule from "./system/system";
import TypeModule from "./type/type";
import PlateTypeModule from "./plate_type/plate_type";
import SiteModule from "./site/site";

Vue.use(Vuex);

const modules = {
    ColorModule,
    FuelModule,
    LevelModule,
    ModelModule,
    SystemModule,
    TypeModule,
    PlateTypeModule,
    SiteModule,
};


const getters = {

    carColors: (state, getters) => getters['ColorModule/records'],
    carColorsPaginate: (state, getters) => getters['ColorModule/allData'],

    carFuels: (state, getters) => getters['FuelModule/records'],
    carFuelsPaginate: (state, getters) => getters['FuelModule/allData'],

    carLevels: (state, getters) => getters['LevelModule/records'],
    carLevelsPaginate: (state, getters) => getters['LevelModule/allData'],

    carModels: (state, getters) => getters['ModelModule/records'],
    carModelsPaginate: (state, getters) => getters['ModelModule/allData'],

    carSystems: (state, getters) => getters['SystemModule/records'],
    carSystemsPaginate: (state, getters) => getters['SystemModule/allData'],

    carTypes: (state, getters) => getters['TypeModule/records'],
    carTypesPaginate: (state, getters) => getters['TypeModule/allData'],

    carPlateTypes: (state, getters) => getters['PlateTypeModule/records'],
    carPlateTypesPaginate: (state, getters) => getters['PlateTypeModule/allData'],

    carSites: (state, getters) => getters['SiteModule/records'],
    carSitesPaginate: (state, getters) => getters['SiteModule/allData'],
};

const mutations = {

};

const actions = {
    /**
     * Loads Car Colors.
    */
    loadCarColors(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ColorModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Load Car Fuel
    */
    loadCarFuels(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('FuelModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
    * Load Car Level
    */
    loadCarLevels(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('LevelModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Load Car Model
    */
    loadCarModels(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ModelModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
    * Load Car System
    */
   loadCarSystems(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SystemModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Load Car Type
    */
   loadCarTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('TypeModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Load Car Plate Type
    */
   loadCarPlateTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('PlateTypeModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Load Car Site
    */
   loadCarSites(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SiteModule/loadRecords', data)
                .then(res => {

                    resolve(res)
                })
                .catch(err => reject(err));
        });
    },


    /**
     * update a Car Color
     */
    updateCarColors(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('ColorModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update a Car Fuel
     */
    updateCarFuels(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('FuelModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Update a Car Level
     */
    updateCarLevels(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('LevelModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Update a Car Model
     */
    updateCarModels(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('ModelModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Update a Car System
     */
    updateCarSystems(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('SystemModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

     /**
     * Update a Car Type
     */
    updateCarTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('TypeModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Update a Car Plate Type
     */
    updateCarPlateTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('PlateTypeModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Update a Car Site
     */
    updateCarSites(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('SiteModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create car colors.
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createCarColors(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('ColorModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Create Car Fuel
    */
    createCarFuels(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('FuelModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Create Car Level
    */
    createCarLevels(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('LevelModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Create Car Model
    */
    createCarModels(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('ModelModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
    * Create Car System
    */
   createCarSystems(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('SystemModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

     /**
    * Create Car Type
    */
   createCarTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('TypeModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

     /**
    * Create Car Type
    */
   createCarPlateTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('PlateTypeModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

     /**
    * Create Car Site
    */
   createCarSites(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('SiteModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete a Car Color
     */
    deletecarColors(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ColorModule/deleteRecords', data)
                .then(res => resolve(res))
               .catch(err => reject(err));
        });
    },

     /**
     * delete a Car Fuel
     */
    deletecarFuels(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('FuelModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * delete a Car Level
     */
    deletecarLevels(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('LevelModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * delete a Car Model
     */
    deletecarModels(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ModelModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * delete a Car System
     */
    deletecarSystems(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SystemModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * delete a Car Type
     */
    deletecarTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('TypeModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete a Car Plate Type
     */
    deletecarPlateTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('PlateTypeModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete a Car Site
     */
    deletecarSites(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SiteModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },
};

export default new Vuex.Store({
    modules,
    getters,
    actions,
});
