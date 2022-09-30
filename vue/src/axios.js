import axios from "axios";
import store from "./store";
import router from "./router/index.js";

const axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}/api/v1`
});

// what is interceptor ?? why use it?
axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${store.state.user.token}`;
    return config;
});


axiosClient.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        sessionStorage.removeItem('TOKEN')
        router.push({name: 'Login'})
        return error;
    } else if (error.response.status === 404) {
        router.push({name: 'NotFound'})
        return error;
    }
    throw error;
})

export default axiosClient;
