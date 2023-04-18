import { defineStore } from 'pinia'
import axios from 'axios'
import {usePlayerStore} from "./Player";

export const useSettingsStore = defineStore({
    id: 'settings',
    state: () => ({
        token: '',
        tokenDuration: 0,
        endpoints: [],
        devices: [],
        currentDevice: {},
        profile: {},
        playerId: null,
        playerStore: usePlayerStore(),
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
                        let devices = response.data.devices
                        devices.forEach((device) => {
                            device = this.setIcon(device)
                            this.devices.push(device)
                        })
                        this.currentDevice = this.devices.find(function (device) {
                            return device.is_active === true;
                        })
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                    })
            })
        },
        setIcon(device) {
            device.icon = 'fa-solid '
            if(device.type === 'Computer') {
                device.icon += 'fa-laptop'
            }
            else if(device.type === 'Speaker') {
                device.icon += 'fa-headphones-simple'
            }
            else {
                device.icon += 'fa-tv'
            }
            return device
        },
        async setDevice(id) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.endpoints.spotify.devices + '/' + id)
                    .then(response => {
                        this.playerStore.player.activateElement()
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
