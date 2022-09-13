import axios from "axios";
import store from "./store";

const axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}/api/v1`
});

// what is interceptor ?? why use it?
axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${store.state.user.token}`;
    return config;
});

// add response interceptor
axiosClient.interceptors.response.use((response) => {
    if(response.status === 401) {
        alert("You are not authorized");
    }
    return response;
}, (error) => {
    if (error.response && error.response.data) {
        return Promise.reject(error.response.data);
    }
    return Promise.reject(error.message);
});



export default axiosClient;
