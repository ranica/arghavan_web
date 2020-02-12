import VuePagination from 'laravel-vue-pagination';
import VeeValidate from 'vee-validate';
import Axios from 'axios';
import Helper from './helper';
import Pjax from  'pjax';

// Register Components
Vue.component('pagination', VuePagination);

window.VeeValidate = VeeValidate;
window.axios = Axios;
window.Helper = Helper;
window.Pjax = Pjax;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
