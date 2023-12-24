import {axiosGetRequest, axiosPostRequest, axiosPutRequest} from "@/Pages/ApiHandlers/Helpers/AxiosHandler.js";
import {useNotifyUser} from "@/Pages/Composable/Notification.js";
import {ref} from "vue";
import {dataCleanser, queryFormatter, useTableParamsExtractor} from "@/Pages/ApiHandlers/Helpers/Helpers.js";

const baseUrl = "api/menus"

export async function useMenuIndexApi(params = {
    number: 5,
    page: 1,
}) {
    let data = ref([]);

    let query = queryFormatter(params);
    const res = await axiosGetRequest(baseUrl + query);
    if (res.status) {
        data.value = res.data.data ?? res.data;
        let {tableParams} = useTableParamsExtractor(res, params.number ?? -1);
        return {data, tableParams}
    } else {
        useNotifyUser(res);
    }
}

export async function useMenuShowApi(id, params = {}) {
    let data = ref([]);

    let query = queryFormatter(params);
    let url = baseUrl + "/" + id;
    const res = await axiosGetRequest(url + query);
    if (res.status) {
        data.value = res.data;
        return {data}
    } else {
        useNotifyUser(res);
    }
}

export async function useMenuStoreApi(params = {
    name: null,
    discount_id: null,
    items: null
}) {
    let data = dataCleanser(params);
    const res = await axiosPostRequest(baseUrl, data);
    useNotifyUser(res);
    return {res};
}

export async function useMenuUpdateApi(id, params = {
    name: null,
    discount_id: null,
    items: null
}) {
    let data = dataCleanser(params);
    data['discount_id'] = params.discount_id;
    const res = await axiosPutRequest(baseUrl + "/" + id, data);
    useNotifyUser(res);
    return {res};
}
