const DateTime = {
    /**
     * String to Gregorian date
     *
     * @param      {<type>}  date    The date
     */
    strToGregorainDate(date){
        return new Date(date);
    },

    /**
     * To Persian date
     *
     * @param      {<type>}  date    The date
     */
    toPersianDate(date, locale, format) {
        if (null == date){
            date = new Date();
        }

        if (null == locale) {
            locale = 'en';
        }

        if (null == format){
            format = 'YYYY-MM-DD';
        }

        date = this.strToGregorainDate(date);

        return new PersianDate(date).toLocale(locale)
                                    .format(format);
    },

    /**
     * To Persian date
     *
     * @param      {<type>}  date    The date
     */
    toPersianTime(date, locale, format) {
        if (null == date){
            date = new Date();
        }

        if (null == locale) {
            locale = 'en';
        }

        if (null == format){
            format = 'HH:mm:ss';
        }

        date = this.strToGregorainDate(date);

        return new PersianDate(date).toLocale(locale)
                                    .format(format);
    },

    /**
     * To Persian date-time
     *
     * @param      {<type>}  date    The date
     */
    toPersianDateTime(date, locale, format) {
        if (null == date){
            date = new Date();
        }

        if (null == locale) {
            locale = 'en';
        }

        if (null == format){
            format = 'YYYY-MM-DD HH:mm:ss';
        }

        date = this.strToGregorainDate(date);

        return new PersianDate(date).toLocale(locale)
                                    .format(format);
    }
};

export default DateTime;
