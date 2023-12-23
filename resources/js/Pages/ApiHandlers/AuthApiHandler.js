import {ref} from "vue";
import {axiosGetRequest, axiosPostRequest, setAxiosToken} from "@/Pages/ApiHandlers/Helpers/AxiosHandler.js";
import {useNotifyUser} from "@/Pages/Composable/Notification.js";
import store from "@/Plugins/Store.js";
import router from "@/Plugins/Router.js";


export async function useLoginApi(params = {
    email: null,
    password: ''
}) {

    let user = ref();
    const res = await axiosPostRequest('api/login', params);
    useNotifyUser(res);
    if (res.status) {
        let userInfo = res.data;
        user.value = userInfo;
        setAxiosToken(userInfo.token);
        store.commit('userLogin', {userInfo});
        router.push({name:'home'})
    }
}

export async function useLogoutApi() {
    const res = await axiosGetRequest('api/logout');
    useNotifyUser(res);
    if (res.status) {
        store.commit('userLogout')
        router.push({name: 'login'})
    }
}
