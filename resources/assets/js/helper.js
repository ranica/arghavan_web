let Helper = {
    downloadFile (url, data)
    {
        var mapForm = document.createElement("form");
        mapForm.target = "Map";
        mapForm.method = "POST"; // or "post" if appropriate
        mapForm.action = url;

        var props = Object.keys (data);
        for (var i =0; i<props.length ;i++)
        {
            var oName = props[i];
            var oValue = data[oName];

            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = oName;
            mapInput.value = oValue;
            mapForm.appendChild(mapInput);
        }

        mapInput = document.createElement("input");
        mapInput.type = "hidden";
        mapInput.name = "_token";
        mapInput.value = document.querySelector('[name="csrf-token"]').content;
        mapForm.appendChild(mapInput);

        document.body.appendChild(mapForm);

        var map = window.open("", "Map", "status=0,title=0,height=600,width=800,scrollbars=1");

        if (map) {
            mapForm.submit();

            // setTimeout (() => { map.close ()}, 3000);
        } else {
            alert('You must allow popups for this map to work.');
        }
    },
    /**
     * Scroll to app
     */
    scrollToApp ()
    {
        document.getElementById('app').scrollIntoView();
    },
    /**
     * Redirect to url
     */
    redirect(url) {
        document.location = url;
    },

    /**
     * Get url hash value
     */
    getHashValue(){
        return window.location.hash.substr(1);
    },

    getUrlParameter(key){
        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get(key);

        return c;
    },

    /**
     * Generate error
     *
     * @return     {string}  { description_of_the_return_value }
     */
    generateErrorString() {
        var err = "";

        v.errors.items.forEach(e => err += "<br/>" + e.msg);

        return err;
    },

    /**
     * Bootstrap wizard movement control
     *
     * @param      {<type>}  ctl     The control
     * @param      {<type>}  action  The action     first/next/back/last/show/finish/previous
     */
    bootstrapWizardMove(ctl, action, timeout = 1){
        setTimeout(() => {
            $(ctl).bootstrapWizard()
                   .data()
                   .bootstrapWizard[action]();
        }, timeout);
    },

    /**
     * Validate persian date
     */
    validatePersianDate(date) {
        date = date || '';

        let result = date.match(/^[1-4]\d{3}[\/|\-]((0[1-6][\/|\-]((3[0-1])|([1-2][0-9])|(0[1-9])))|((1[0-2]|(0[7-9]))[\/|\-](30|([1-2][0-9])|(0[1-9]))))$/);

        // console.log('Persian date V ', date, result, 'result', (result != null) && (result.length > 0));

        return (result != null) &&
               (result.length > 0);
    },

    /**
     * Validate gregorian date
     */
    validateGregorianDate(date) {
        date = date || '';

        let result = date.match(/^(\d{4})[\/|\-](\d{1,2})[\/|\-](\d{1,2})$/);

        return (result != null) &&
            (result.length > 0);
    },

    /**
     * Validate persian date
     */
    validatePersianDateTime(date) {
        date = date || '';

        let result = date.match(/^[1-4]\d{3}[\/|\-]((0[1-6][\/|\-]((3[0-1])|([1-2][0-9])|(0[1-9])))|((1[0-2]|(0[7-9]))[\/|\-](30|([1-2][0-9])|(0[1-9]))))\s(\d{1,2}:\d{1,2}:\d{1,2})$/);

        return (result != null) &&
               (result.length > 0);
    },

    /**
     * Validate gregorian date
     */
    validateGregorianDateTime(date) {
        date = date || '';

        let result = date.match(/^(\d{4})[\/|\-](\d{1,2})[\/|\-](\d{1,2})\s(\d{1,2}:\d{1,2}:\d{1,2})$/);

        return (result != null) &&
               (result.length > 0);
    },

    /**
     * Get Current tab index
     */
    smartWizardCurrentStepIndex(smartControl) {
        let ctl = $(smartControl)
            .data()
            .smartWizard;

        return ctl.current_index;
    },

    /**
     * Reset
     */
    smartWizardReset(smartControl) {
        let ctl = $(smartControl)
            .data()
            .smartWizard;

        ctl.reset();
    },

    /**
     * Move to first tab
     */
    smartWizardFirstTab(smartControl) {
        let ctl = $(smartControl)
            .data()
            .smartWizard;

        ctl._showStep(0);
    },

    /**
     * Move to last tab
     */
    smartWizardLastTab(smartControl) {
        let ctl = $(smartControl)
            .data()
            .smartWizard;
        let maxPages = ctl.steps.length-1;

        ctl._showStep(maxPages);
    },

    /**
     * Remove a class
     */
    removeClass(selector, className) {
        let ctl = document.querySelector(selector);

        if (null == ctl) {
            return;
        }

        let classes = ctl.className.split(' ')
            .filter(el => el != className)
            .join(' ');

        ctl.className = classes;
    },

    /**
     * Add a class
     */
    addClass(selector, className) {
        let ctl = document.querySelector(selector);

        if (null == ctl) {
            return;
        }

        let index = ctl.className.split(' ')
            .indexOf(className);

        if (-1 == index) {
            ctl.className = ctl.className + ' ' + className;;
        }
    },

    /**
     * Convert Gregorian date to Jalaali
     */
    gregorianToJalaali(gDate, pFormat, gFormat) {
        if (! Helper.validateGregorianDate(gDate)) {
            return '';
        }

        if ((pFormat === undefined) || (pFormat == "")) {
            pFormat = 'jYYYY/jMM/jDD';
        }

        if ((gFormat === undefined) || (gFormat == "")) {
            gFormat = 'YYYY/MM/DD';
        }

        let result = MomentJ(gDate, gFormat)
            .locale('en')
            .format(pFormat);

        return result;
    },

    /**
     * Convert Gregorian date to Jalaali include time
     */
    gregorianToJalaaliByTime(gDate, pFormat, gFormat) {
        if (! Helper.validateGregorianDateTime(gDate)) {
            return '';
        }

        if ((pFormat === undefined) || (pFormat == "")) {
            pFormat = 'jYYYY/jMM/jDD HH:mm:ss';
        }

        if ((gFormat === undefined) || (gFormat == "")) {
            gFormat = 'YYYY/MM/DD HH:mm:ss';
        }

        let result = MomentJ(gDate, gFormat)
            .locale('en')
            .format(pFormat);

        return result;
    },

    /**
     * Convert Gregorian date to Jalaali include time
     */
    gregorianToJalaaliByOnlyTime(gDate, pFormat, gFormat) {
        if (! Helper.validateGregorianDateTime(gDate)) {
            return '';
        }

        if ((pFormat === undefined) || (pFormat == "")) {
            pFormat = 'HH:mm';
        }

        if ((gFormat === undefined) || (gFormat == "")) {
            gFormat = 'HH:mm';
        }

        let result = MomentJ(gDate, gFormat)
            // .locale('en')
            .format(pFormat);

        return result;
    },


    /**
     * Convert Jalaali date to Gregorian
     */
    jalaaliToGregorian(pDate, gFormat, pFormat) {
        if (! Helper.validatePersianDate(pDate)) {
            return '';
        }

        if ((pFormat === undefined) || (pFormat == "")) {
            pFormat = 'jYYYY/jMM/jDD';
        }

        if ((gFormat === undefined) || (gFormat == "")) {
            gFormat = 'YYYY/MM/DD';
        }

        let result = MomentJ(pDate, pFormat)
            .locale('en')
            .format(gFormat);

        return result;
    },


    /**
     * Convert Jalaali date to Gregorian
     */
    jalaaliToGregorianByTime(pDate, gFormat, pFormat) {
        if (! Helper.validatePersianDateTime(pDate)) {
            return '';
        }

        if ((pFormat === undefined) || (pFormat == "")) {
            pFormat = 'jYYYY/jMM/jDD HH:mm:ss';
        }

        if ((gFormat === undefined) || (gFormat == "")) {
            gFormat = 'YYYY/MM/DD HH:mm:ss';
        }

        let result = MomentJ(pDate, pFormat)
            .locale('en')
            .format(gFormat);

        return result;
    }
};

export default Helper;
