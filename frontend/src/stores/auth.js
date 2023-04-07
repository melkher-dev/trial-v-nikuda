import { defineStore } from 'pinia'
import axios from 'axios'
import Cookies from 'js-cookie'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: Cookies.get('token'),
        // admin: false
    }),

    // getters: {
    //     isAdmin: (state) => state.user && state.user.is_admin
    // },

    actions: {
        async setToken(token, remember) {
            this.token = token
            Cookies.set('token', token, { expires: remember ? 365 : null })
        },

        async fetchUser() {
            try {
                const { data } = await axios.get('/api/auth')
                this.user = data;
                localStorage.setItem('admin', data.is_admin);
            } catch (e) {
                console.log('e', e)
            }
        },

        async login(form) {
            const { data } = await axios.post("/api/login", form);
            await this.setToken(data.access_token, form.remember);
            await this.fetchUser();
        },

        async register(form) {
            await axios.post("/api/register", form);
            await this.login(form);
        },

        async logout() {
            this.user = null
            this.token = null
            Cookies.remove('token')
        }
    }
})