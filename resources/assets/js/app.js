import Vue from 'vue';
window.Vue           = Vue;

import Vuex from 'vuex';
window.Vuex          = Vuex;

import MomentJ from 'moment-jalaali';
window.MomentJ       = MomentJ;

import Cookies from 'js-cookie';
window.JSCookie      = Cookies;

import Enums from './enums';
window.Enums         = Enums;

import Helper from './helper';
window.Helper        = Helper;

import MessageHelper from './MessageHelper';
window.MessageHelper = MessageHelper;

import Preferences from './preferences';
window.Preferences   = Preferences;

import SocketClient from './web-socket';
window.SocketClient  = SocketClient;

import DateTime from './helpers/datetime';
window.DateTime = DateTime;

import PersianDate from 'persian-date';
window.PersianDate = PersianDate;



// Load base url from meta-tag
let baseUrl = document.querySelector('meta[name="O-BASE-URL"]')
                      .getAttribute('content');

let baseUrlElement = document.querySelector('meta[name="O-BASE-URL"]');

if (null != baseUrlElement) {
    document.baseURL = baseUrl;
}

document.pageData = {
    baseURL: baseUrl
};

// Doument Loading event
(function () {
    document.getElementsByTagName('body')[0]
        .addEventListener('load', () => {
            setTimeout(() => {
                Helper.addClass('.body-loading', 'hidden');
                Helper.removeClass('#app', 'hidden');
                Helper.removeClass('.body-main-content', 'hidden');
            }, 1250);
        }, true);

        let input = document.querySelector('.panel-heading');

        if (null != input) {
            let text = input.innerHTML;

            document.querySelectorAll('.navbar-brand')
                    .forEach (c => c.innerHTML = text);
        }
})();

// Vue.component(
//     'passport-clients',
//     require('./components/passport/Clients.vue')
// );

// Vue.component(
//     'passport-authorized-clients',
//     require('./components/passport/AuthorizedClients.vue')
// );

// Vue.component(
//     'passport-personal-access-tokens',
//     require('./components/passport/PersonalAccessTokens.vue')
// );





import VeeValidate, { Validator } from 'vee-validate';
import fa from 'vee-validate/dist/locale/fa';

const Veeconfig = {
    locale: 'fa_IR',
    events: 'blur'
};
Validator.localize({
    fa_IR: fa,
});
Vue.use(VeeValidate, Veeconfig);

import PhoneNumber from 'awesome-phonenumber';
const phoneNumber = {
    getMessage: field => `${field} یک شماره معتبر نمی باشد`,
    validate(value) {
        return new Promise(resolve => {
            let phone = new PhoneNumber(value);

            resolve({
                valid: phone.isValid()
            })
        });
    }
};
Validator.extend('phoneNumber', phoneNumber);

