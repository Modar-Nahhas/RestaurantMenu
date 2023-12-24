import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            userInfo: null,
            callingApi: false,
            discountTypes: {
                category: 'category',
                item: 'item',
                allMenu: 'all_menu'
            },
            discountAmountValidation: [value => (value > 0 && value <= 100) || 'Value should be between 0 and 100'],
        }
    },
    getters: {
        getUser(state) {
            return state.userInfo.user;
        },
        getUserToken(state) {
            return state.userInfo.token;
        },
        isLoggedin(state) {
            return state.userInfo != undefined;
        },
        isCallingApi(state) {
            return state.callingApi;
        }
    },
    mutations: {
        userLogin: (state, {userInfo}) => {
            localStorage.setItem('userInfo', JSON.stringify(userInfo))
            state.userInfo = userInfo;
        },
        userLogout: state => {
            localStorage.removeItem('userInfo')
            state.userInfo = null;
        },
        resetUserInfoFromStorage: state => {
            state.userInfo = JSON.parse(localStorage.getItem('userInfo'))
        },
        callApi: (state, {calling}) => {
            state.callingApi = calling;
        }
    },
});

export default store;
