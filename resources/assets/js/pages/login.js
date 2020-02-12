import Store from './Stores/LoginStore.js';


/**
 * Ready function
 */
$()
    .ready(() => {
        demo.checkFullPageBackgroundImage();

        setTimeout(() => {
            $('.card')
                .removeClass('card-hidden');
        }, 250);
    });

/**
 * Show Error
 */
function showError(msg) {
    demo.showNotification(msg, 'danger', 2000);
}

/**
 * Show Info
 */
function showInfo(msg) {
    demo.showNotification(msg, 'info', 2000);
}

/**
 * Vue Instance
 */
window.v = new Vue({
    el: '#app',

    store: Store,

    data: {
        name: '',
        code: '',
        password: '',
        remember: false
    },

    methods: {
        login() {
            this.$validator.validateAll()
                .then(result => {
                    if (!result) {
                        showError('لطفا خطاها را برطرف نمایید');

                        return;
                    }

                    let data = {
                        //name: this.name,
                        code: this.name,
                        password: this.password,
                        remember: this.remember
                    };

                    showInfo('در حال تایید هویت ...');

                    this.$store.dispatch('login', data)
                        .then(res => {
                            if (res.data.status) {
                                window.location = "/home";

                                return;
                            }

                            showError('اطلاعات شما نامعتبر می باشد');
                        })
                        .catch(err => {
                            showError('اطلاعات شما نامعتبر می باشد');
                        });
                });
        }
    }
});
