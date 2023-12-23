import axios from "axios";
import router from "@/Plugins/Router.js";
import store from "@/Plugins/Store.js";
window.axios = axios;
window.axios.defaults.baseURL = window.location.origin
window.axios.interceptors.response.use(function (response) {

    return response;
}, function (error) {
    if(error.response.data.code == 401){
        store.commit('userLogout')
        router.push({name:'login'})
    }
    return error.response;
});
export function setAxiosToken(token){
    window.axios.defaults.headers.common = {'Authorization': `Bearer ` + token}
}
export async function axiosGetRequest(url) {

    let res = await window.axios.request({
        url:  url,
        method: 'GET',
        'headers': {
            'accept': 'application/json',
        }
    }).catch(e => {
        console.log('Error getting contact details: ' + e);
        return e.response;

    });
    return res.data;
}

export async function axiosPostRequest(url, data) {

    let res = await window.axios.request({
        url: window.location.origin + "/" + url,
        method: 'Post',
        'headers': {
            'accept': 'application/json',
        },
        data: data
    }).catch(e => {
        console.log('Error getting contact details: ' + e);
        return e.response;

    });
    return res.data;
}

export async function axiosPutRequest(url, data) {
    data._method = 'put';
    let res = await window.axios.request({
        url: window.location.origin + "/" + url,
        method: 'Post',
        'headers': {
            'accept': 'application/json',
        },
        data: data
    }).catch(e => {
        console.log('Error getting contact details: ' + e);
        return e.response;

    });
    return res.data;
}
