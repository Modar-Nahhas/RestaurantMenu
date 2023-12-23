export function queryFormatter(params = {}) {
    let query = '?';
    Object.keys(params).forEach(key => {
        if (typeof params[key] == "boolean") {
            query += key + '=' + (params[key] ? 1 : 0 )+ '&';
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
