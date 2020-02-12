import RoomModule  from "./room/room";
import MaterialTypeModule  from "./material_type/material_type";
import GenderModule  from "./gender/gender";
import BuildingModule  from "../base-structure/building/building";
import MaterialModule  from "./material/material";
import ContactTypeModule  from "./contact_type/contact_type";

Vue.use(Vuex);

const modules = {
    RoomModule,
    MaterialTypeModule,
    ContactTypeModule,
    BuildingModule,
    GenderModule,
    MaterialModule,
};


const getters = {

    buildings: (state, getters) => getters['BuildingModule/records'],
    genders: (state, getters) => getters['GenderModule/records'],

    rooms: (state, getters) => getters['RoomModule/records'],
    roomsPaginate: (state, getters) => getters['RoomModule/allData'],

    materialTypes: (state, getters) => getters['MaterialTypeModule/records'],
    materialTypesPaginate: (state, getters) => getters['MaterialTypeModule/allData'],
    allMaterialTypes: (state, getters) => getters['MaterialTypeModule/allRecords'],

    materials: (state, getters) => getters['MaterialModule/records'],
    materialsPaginate: (state, getters) => getters['MaterialModule/allData'],

    contactTypes: (state, getters) => getters['ContactTypeModule/records'],
    contactTypesPaginate: (state, getters) => getters['ContactTypeModule/allData'],
    allContactTypes: (state, getters) => getters['ContactTypeModule/allRecords'],
};

const mutations = {
    /**
     * Update an existing record
     */
    updateRecord: (state, payload) => {
        let getters = payload.getters;
        let record  = payload.record;

        let index   = getters.records.map(el => el.id )
                                    .indexOf(record.id);
        if (-1 == index){
            return;
        }
        getters.records[index] = record;
    },

};

const actions = {
    /**
     * Loads Building
    */
   loadBuildings(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('BuildingModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Loads Gender
    */
   loadGenders(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('GenderModule/loadRecords', data)
                .then(res =>  {

                  resolve(res);
                } )
                .catch(err => reject(err));
        });
    },

    /**
     * Loads Room
    */
   	loadRooms(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('RoomModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update Room
     */
    updateRooms(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('RoomModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Room
     */
    createRooms(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('RoomModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Room
     */
    deleterooms(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('RoomModule/deleteRecords', data)
				.then(res => resolve(res))
               	.catch(err => reject(err));
        });
    },

     /**
     * Loads MaterialType
    */
    loadMaterialTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('MaterialTypeModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update MaterialType
     */
    updateMaterialTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('MaterialTypeModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create MaterialType
     */
    createMaterialTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('MaterialTypeModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete MaterialType
     */
    deletematerialTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('MaterialTypeModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * Loads Material Type all
    */
   loadAllMaterialTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('MaterialTypeModule/loadAllRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Loads Material
    */
    loadMaterials(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('MaterialModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update Material
     */
    updateMaterials(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('MaterialModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Material
     */
    createMaterials(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('MaterialModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Material
     */
    deletematerials(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('MaterialModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * save Material Room
     */
    saveMaterialRoomRecord: (context, record) => {
        return new Promise((resolve, reject) =>
        {
            let url = '/room/' + record.room_id + '/setMaterial';
            let data = {
                materials: record.materials
            };

            axios.put(url, data)
                .then(res => {

                    let status = (0 == res.data.status);
                    let record = res.data.room;

                    if (null != record) {
                        context.commit ('updateRecord', {
                                    getters: context.getters,
                                    record : record[0]
                                });
                    }
                    resolve(status);
                })
                .catch(err => reject(err));
        });
    },

    /**
     * Loads ContactType
    */
    loadContactTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ContactTypeModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update ContactType
     */
    updateContactTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('ContactTypeModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create ContactType
     */
    createContactTypes(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('ContactTypeModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete ContactType
     */
    deletecontactTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ContactTypeModule/deleteRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * Loads Contact Type all
    */
   loadAllContactTypes(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('ContactTypeModule/loadAllRecords', data)
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
