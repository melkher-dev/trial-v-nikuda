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
            Cookies.set('token', token, { expires: remember ? 365 : null })
        },
        async fetchUser() {
            try {
                const { data } = await axios.get('/api/user')
                this.user = data;
            } catch (e) {
                console.log('e', e)
            }
        }
    }
})