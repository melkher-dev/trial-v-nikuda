import { defineStore } from 'pinia'
import axios from 'axios'
import Cookies from 'js-cookie'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: Cookies.get('token')
    }),

    actions: {
        async setToken(token, remember) {
            this.token = token
            Cookies.set('token', token, { expires: remember ? 30 : null })
        },

        async fetchUser() {
            try {
                const { data } = await axios.get('/api/user')
                this.user = data;
                console.log('this.user', this.user)
            } catch (e) {
                console.log('e', e)
            }
        },

        async login(form) {
            const { data } = await axios.post("/api/login", form);
            await this.setToken(data.access_token, form.remember);
        },

        async register(form) {
            await axios.post("/api/register", form);
            await this.login(form);
        }
    }
})