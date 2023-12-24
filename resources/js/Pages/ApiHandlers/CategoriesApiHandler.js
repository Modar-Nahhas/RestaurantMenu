import {axiosGetRequest, axiosPostRequest, axiosPutRequest} from "@/Pages/ApiHandlers/Helpers/AxiosHandler.js";
import {useNotifyUser} from "@/Pages/Composable/Notification.js";
import {ref} from "vue";
import {dataCleanser, queryFormatter, useTableParamsExtractor} from "@/Pages/ApiHandlers/Helpers/Helpers.js";

const categoryBaseUrl = "api/categories"
const subCategoryBaseUrl = "api/sub-categories"

export async function useCategoryIndexApi(params = {
    number: 5,
    page: 1,
    with_parent: false,
    with_discount: false,
}) {
    let data = ref([]);

    let query = queryFormatter(params);
    const res = await axiosGetRequest(categoryBaseUrl + query);
    if (res.status) {
        data.value = res.data.data ?? res.data;
        let {tableParams} = useTableParamsExtractor(res, params.number ?? -1);
        return {data, tableParams}
    } else {
        useNotifyUser(res);
    }
}

export async function useCategoryShowApi(id, params = {
    with_parent: false,
    with_discount: false,
}) {
    let resp = ref([]);
    let query = queryFormatter(params);
    let url = categoryBaseUrl + "/" + id;
    const res = await axiosGetRequest(url + query);
    if (res.status) {
        resp.value = res.data
        return {resp};
    } else {
        useNotifyUser(res);
    }
}

export async function useCategoryStoreApi(params = {
    name: null,
    discount_id: null
}) {
    let data = dataCleanser(params);
    const res = await axiosPostRequest(categoryBaseUrl, data);
    useNotifyUser(res);
    return {res};
}

export async function useCategoryUpdateApi(id, params = {
    name: null,
    discount_id: null
}) {
    let data = dataCleanser(params);
    data['discount_id'] = params.discount_id
    let url = categoryBaseUrl + '/' + id;
    const res = await axiosPutRequest(url, data);
    useNotifyUser(res);
    return {res};
}

export async function useSubCategoryStoreApi(params = {
    name: null,
    discount_id: null,
    parent_id: null
}) {
    let data = dataCleanser(params);
    const res = await axiosPostRequest(subCategoryBaseUrl, data);
    useNotifyUser(res);
    return {res};
}

export async function useGetValidCategoryParentsApi() {
    const res = await axiosGetRequest('api/categories/valid-parents');
    if (res.status) {
        return res.data;
    } else {
        useNotifyUser(res);
    }
}
export async function useGetValidCategoryItemsApi() {
    const res = await axiosGetRequest('api/categories/valid-items');
    if (res.status) {
        return res.data;
    } else {
        useNotifyUser(res);
    }
}
