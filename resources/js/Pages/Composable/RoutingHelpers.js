import router from "@/Plugins/Router.js";


export function useRedirect({path = '', name = '', params = null}) {
    const route = {}
    if (name != undefined) {
        route['name'] = name;
    } else if (path != undefined) {
        route['path'] = path;
    }
    if (params != undefined) {
        route['params'] = params;
    }
    router.push(route).catch(err => {
        console.log('Error redirecting: ' + err);
    })
}
