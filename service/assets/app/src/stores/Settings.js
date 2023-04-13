import { defineStore } from 'pinia'
import axios from 'axios'

export const useSettingsStore = defineStore({
    id: 'settings',
    state: () => ({
        token: '',
        tokenDuration: 0,
        endpoints: [],
        devices: [],
        currentDevice: {},
        profile: {}
    }),
    actions: {
        async getProfile() {
            return new Promise((resolve, reject) => {
                axios
                    .get(this.endpoints.spotify.profile)
                    .then(response => {
                        this.profile = response.data
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                    })
            })
        },
        async getDevices() {
            return new Promise((resolve, reject) => {
                axios
                    .get(this.endpoints.spotify.devices)
                    .then(response => {
                        this.devices = response.data.devices
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                    })
            })
        },
        async setDevice(id) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.endpoints.spotify.devices + '/' + id)
                    .then(response => {
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                    })
            })
        },
        setTokenRefreshTimeout() {
            setTimeout(() => {
                this.refreshAccessToken()
            }, this.tokenDuration * 1000)
        },
        async refreshAccessToken() {
            return new Promise((resolve, reject) => {
                axios
                    .get(this.endpoints.spotify.refreshToken)
                    .then(response => {
                        this.token = response.data.accessToken
                        this.tokenDuration = response.data.tokenDuration
                        this.setTokenRefreshTimeout()
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                    })
            })
        },
    }
})
