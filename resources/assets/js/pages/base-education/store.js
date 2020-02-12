import SemesterModule  from "./semester/semester";
import TermModule  from "./term/term";
import UniversityModule  from "./university/university";
import FieldModule  from "./field/field";
import DegreeModule  from "./degree/degree";
import PartModule  from "./part/part";
import SituationModule  from "./situation/situation";

Vue.use(Vuex);

const modules = {
    SemesterModule,
    TermModule,
    UniversityModule,
    FieldModule,
    DegreeModule,
    PartModule,
    SituationModule,
};


const getters = {
    semesters: (state, getters) => getters['SemesterModule/records'],
    // semestersPaginate: (state, getters) => getters['SemesterModule/allData'],

    terms: (state, getters) => getters['TermModule/records'],
    termsPaginate: (state, getters) => getters['TermModule/allData'],

    universities: (state, getters) => getters['UniversityModule/records'],
    allUniversities: (state, getters) => getters['UniversityModule/allRecords'],
    universitiesPaginate: (state, getters) => getters['UniversityModule/allData'],

    fieldDatas: (state, getters) => getters['FieldModule/records'],
    fieldsPaginate: (state, getters) => getters['FieldModule/allData'],

    degrees: (state, getters) => getters['DegreeModule/records'],
    degreesPaginate: (state, getters) => getters['DegreeModule/allData'],

    parts: (state, getters) => getters['PartModule/records'],
    partsPaginate: (state, getters) => getters['PartModule/allData'],

    situations: (state, getters) => getters['SituationModule/records'],
    situationsPaginate: (state, getters) => getters['SituationModule/allData'],
};

const mutations = {

};

const actions = {
    /**
     * Loads Semester
    */
   loadSemesters(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SemesterModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Loads Term
    */
   loadTerms(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('TermModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update Term
     */
    updateTerms(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('TermModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Term
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createTerms(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('TermModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Term
     */
    deleteterms(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('TermModule/deleteRecords', data)
                .then(res => resolve(res))
               .catch(err => reject(err));
        });
    },

    /**
     * Loads Universities
    */
   loadUniversities(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('UniversityModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

     /**
     * Loads University
    */
    loadAllUniversities(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('UniversityModule/loadAllRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },
    /**
     * update Universities
     */
    updateUniversities(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('UniversityModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Universities
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createUniversities(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('UniversityModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Universities
     */
    deleteuniversities(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('UniversityModule/deleteRecords', data)
                .then(res => resolve(res))
               .catch(err => reject(err));
        });
    },
     /**
     * Loads Field
    */
   loadFields(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('FieldModule/loadRecords', data)
                .then(res =>{

                      resolve(res);
                      })
                .catch(err => reject(err));
        });
    },
    /**
     * update Field
     */
    updateFields(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('FieldModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Field
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createFields(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('FieldModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Field
     */
    deletefields(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('FieldModule/deleteRecords', data)
                .then(res => resolve(res))
               .catch(err => reject(err));
        });
    },

    /**
     * Loads Degree
    */
    loadDegrees(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('DegreeModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update Degree
     */
    updateDegrees(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('DegreeModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Degree
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createDegrees(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('DegreeModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Degree
     */
    deletedegrees(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('DegreeModule/deleteRecords', data)
                .then(res => resolve(res))
               .catch(err => reject(err));
        });
    },

     /**
     * Loads Part
    */
   loadParts(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('PartModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },
    /**
     * update Part
     */
    updateParts(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('PartModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Part
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createParts(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('PartModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Part
     */
    deleteparts(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('PartModule/deleteRecords', data)
                .then(res => resolve(res))
               .catch(err => reject(err));
        });
    },

    /**
     * Loads Situation
    */
   loadSituations(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SituationModule/loadRecords', data)
                .then(res => resolve(res))
                .catch(err => reject(err));
        });
    },

    /**
     * update Situation
     */
    updateSituations(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('SituationModule/updateRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * Create Situation
     *
     * @param      {<type>}   context  The context
     * @param      {<type>}   data     The data
     * @return     {Promise}  { description_of_the_return_value }
     */
    createSituations(context, data) {
        return new Promise((response, reject) => {
            context.dispatch('SituationModule/createRecords', data)
                .then(res => response(res))
                .catch(err => reject(err));
        });
    },

    /**
     * delete Situation
     */
    deletesituations(context, data) {
        return new Promise((resolve, reject) => {
            context.dispatch('SituationModule/deleteRecords', data)
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
