let Preferences = {
    C_SIDEBAR_ACTIVE_COLOR: 'sidebar-active-color',
    C_SIDEBAR_COLOR: 'sidebar-background-color',
    C_SIDEBAR_MINI_CHECKED: 'sidebar-mini-checked',

    C_SIDEBAR_ACTIVE_COLOR_BUTTONS: '.fixed-plugin .active-color span',
    C_SIDEBAR_COLOR_BUTTONS: '.fixed-plugin .background-color span',
    C_SIDEBAR_MINI: '.togglebutton.switch-sidebar-mini input',


    /**
     * Write Setting
     */
    writeSetting(name, value) {
        JSCookie.set(name, value);
    },

    /**
     * Read Setting
     */
    readSetting(name, defValue = '') {
        let value = JSCookie.get(name);

        return value ? value : defValue;
    },

    /**
     * Bind Events
     */
    bindEvents(){
        // Sidebar colors (white & black)
        let obj = document.querySelectorAll(Preferences.C_SIDEBAR_COLOR_BUTTONS);

        if (obj){
            obj.forEach(el => el.addEventListener('click', Preferences.sidebarBackgroundChanged));
        }

        // Sidebar mini
        obj = document.querySelector(Preferences.C_SIDEBAR_MINI);

        if (obj){
            obj.addEventListener('input', Preferences.sidebarMiniChanged);
        }

        // Sidebar active color buttons
        obj = document.querySelectorAll(Preferences.C_SIDEBAR_ACTIVE_COLOR_BUTTONS);

        if (obj){
            obj.forEach(el => el.addEventListener('click', Preferences.sidebarActiveColorChanged));
        }
    },

    /**
     * Reset Environment state
     */
    loadEnv(){
        Preferences.resetSidebarColor();
        Preferences.resetSidebarActiveColor();
        Preferences.resetSidebarMini();
    },

    /**
     * Reset Sidebar color
     */
    resetSidebarColor(){
        let sbColor = Preferences.readSetting(Preferences.C_SIDEBAR_COLOR, 'black');
        let queryStr = (Preferences.C_SIDEBAR_COLOR_BUTTONS + '[data-color=$sbColor$]')
                            .replace('$sbColor$', sbColor);
        let obj = document.querySelector(queryStr);

        if (obj && obj.click){
            obj.click();
        }
    },

    /**
     * Reset Sidebar active color
     */
    resetSidebarActiveColor(){
        let sbColor = Preferences.readSetting(Preferences.C_SIDEBAR_ACTIVE_COLOR, 'rose');
        let queryStr = (Preferences.C_SIDEBAR_ACTIVE_COLOR_BUTTONS + '[data-color=$sbColor$]')
                            .replace('$sbColor$', sbColor);
        let obj = document.querySelector(queryStr);

        if (obj && obj.click){
            obj.click();
        }
    },

    /**
     * Reset Sidebar Mini
     */
    resetSidebarMini(){
        let sbMini = Preferences.readSetting(Preferences.C_SIDEBAR_MINI_CHECKED, false);
        let queryStr = Preferences.C_SIDEBAR_MINI;
        let obj = document.querySelector(queryStr);

        if (obj){
            sbMini = (sbMini == "true");

            md.misc.sidebar_mini_active = !sbMini;
            obj.checked = sbMini;

            demo.changeMiniBar();
        }
    },


    /**
     * Sidebar Background changed
     */
    sidebarBackgroundChanged(event){
        event.preventDefault();

        let color = event.target.attributes['data-color'].value;

        Preferences.writeSetting(Preferences.C_SIDEBAR_COLOR, color);

        return false;
    },

    /**
     * Sidebar Activecolor changed
     */
    sidebarActiveColorChanged(event){
        event.preventDefault();

        let color = event.target.attributes['data-color'].value;

        Preferences.writeSetting(Preferences.C_SIDEBAR_ACTIVE_COLOR, color);

        return false;
    },

    /**
     * Sidebar Mini changed
     */
    sidebarMiniChanged(event){
        event.preventDefault();

        let checked = event.target.checked;

        Preferences.writeSetting(Preferences.C_SIDEBAR_MINI_CHECKED, checked);

        return false;
    },
};

export default Preferences;
