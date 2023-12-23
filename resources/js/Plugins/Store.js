import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            userInfo: null
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
        }
    },
    mutations: {
        userLogin: (state, {userInfo}) => {
            localStorage.setItem('userInfo',JSON.stringify(userInfo))
            state.userInfo = userInfo;
        },
        userLogout: state => {
            localStorage.removeItem('userInfo')
            state.userInfo = null;
        },
        resetUserInfoFromStorage: state =>{
            state.userInfo = JSON.parse(localStorage.getItem('userInfo'))
        }
    },
});

export default store;
