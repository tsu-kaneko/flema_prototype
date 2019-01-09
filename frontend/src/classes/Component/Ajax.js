import axios from 'axios'

const SETTINGS = {
    baseURL: 'http://127.0.0.1:8000/',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    },
    responseType: 'json'
};

export default class Ajax {

    /**
     * GET
     */
    static get(url, fn, error) {
        error = error || Ajax.sysError;
        axios.get(url, SETTINGS).then(function(response){
            fn(response.data, response);
        }).catch(error);
    }

    /**
     * POST
     */
    static post(url, params, fn, error) {
        error = error || Ajax.sysError;
        params = params || {};

        axios.post(url, params, SETTINGS).then(function(response){
            fn(response.data, response);
        }).catch(error);
    }

}


