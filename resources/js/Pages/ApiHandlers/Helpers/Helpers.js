import {ref, watchEffect} from "vue";
import moment from "moment";

export function queryFormatter(params = {}) {
    let query = '?';
    Object.keys(params).forEach(key => {
        if (typeof params[key] == "boolean") {
            query += key + '=' + (params[key] ? 1 : 0) + '&';
        } else if (params[key] != undefined && params[key] != '') {
            if (typeof params[key] != "object") {
                query += key + '=' + params[key] + '&';
            } else {
                Object.values(params[key]).forEach(value => {
                    query += key + '[]=' + value + '&';
                });
            }
        }
    });
    return query;
}

export function dataCleanser(params = {}) {
    let cleansedData = {};
    Object.keys(params).forEach(key => {
        if (typeof params[key] == "boolean") {
            cleansedData[key] = params[key] ? 1 : 0;
        } else if (params[key] != undefined && params[key] != '') {
            cleansedData[key] = params[key];
        }
    });
    return cleansedData;

}

export function useTableParamsExtractor(response, number) {
    let tableParams = ref({});
    if (number == -1) {
        tableParams.value = {
            page: 1,
            itemsPerPage: -1,
            total: response.data.length,
        }
    } else {
        tableParams.value = {
            page: response.data.current_page ?? tableParams.page,
            itemsPerPage: response.data.per_page ?? tableParams.itemsPerPage,
            total: response.data.total ?? tableParams.totalItems,
        }
    }

    return {tableParams};
}

export function dateFormatter(date, format = "YYYY-MM-DD HH:mm") {
    return moment(new Date(date)).format(format);
}
