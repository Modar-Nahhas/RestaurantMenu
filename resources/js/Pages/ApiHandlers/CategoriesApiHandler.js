import {axiosGetRequest, axiosPostRequest} from "@/Pages/ApiHandlers/Helpers/AxiosHandler.js";
import {useNotifyUser} from "@/Pages/Composable/Notification.js";
import {ref} from "vue";
import {dataCleanser, queryFormatter, useTableParamsExtractor} from "@/Pages/ApiHandlers/Helpers/Helpers.js";

const baseUrl = "api/categories"

export async function useCategoryIndexApi(params = {
    number: 5,
    page: 1,
    with_parent: false,
    with_discount: false,
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

export async function useCategoryStoreApi(params = {
    name: null,
    discount_id: null
}) {
    let data = dataCleanser(params);
    const res = await axiosPostRequest(baseUrl, data);
    useNotifyUser(res);
    return {res};
    // if (res.status) {
    //     return {validationErrors: false, success: true}
    // } else {
    //     if (res.code == 422) {
    //         return {validationErrors: true, errors: res.data}
    //     } else {
    //         useNotifyUser(res);
    //         return {validationErrors: false}
    //     }
    // }

}
