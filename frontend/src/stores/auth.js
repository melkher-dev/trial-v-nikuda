import { defineStore } from 'pinia'
import axios from 'axios'
import Cookies from 'js-cookie'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: Cookies.get('token'),
        fetched: false,
        admin: null
    }),

    actions: {
        async setToken(token, remember) {
            this.token = token
            Cookies.set('token', token, { expires: remember ? 365 : null })
        },

        async fetchUser() {
            if (this.fetched) {
                return;
            }

            try {
                const { data } = await axios.get('/api/auth')
                this.user = data;
                this.admin = data.is_admin;
                this.fetched = true;
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