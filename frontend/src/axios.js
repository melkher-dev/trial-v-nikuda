import axios from 'axios';
import { useAuthStore } from '@/stores/auth.js'

// axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost';

axios.interceptors.request.use(config => {
    const token = useAuthStore().token
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})
