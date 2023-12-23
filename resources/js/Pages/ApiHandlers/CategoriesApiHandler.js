import {axiosGetRequest, axiosPostRequest} from "@/Pages/ApiHandlers/Helpers/AxiosHandler.js";
import {useNotifyUser} from "@/Pages/Composable/Notification.js";
import {ref} from "vue";
import {queryFormatter, useTableParamsExtractor} from "@/Pages/ApiHandlers/Helpers/Helpers.js";

const baseUrl = "api/categories"

export async function useCategoryIndexApi(params = {
    number: 5,
    page: 1,
    with_parent: false
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

export async function useCategoryStoreApi() {

}
