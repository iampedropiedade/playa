import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'

export const useTracksStore = defineStore({
    id: 'tracks',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'tracks',
        tracks: {},
    }),
    actions: {
        async setTrack(track) {
            this.tracks[track.id] = track
        },
        async getTrack(trackId) {
            if(this.tracks[trackId] === undefined) {
                this.getTrackFromApi(trackId)
            }
            return this.tracks[trackId]
        },
        async getTrackFromApi(trackId) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.tracks + '/' + trackId)
                    .then(response => {
                        this.setTrack(response.data)
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                        this.loading = false
                    })
            })
        },
        async addToQueue(trackId) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .post(this.settingsStore.endpoints.spotify.queue + '/track/' + trackId)
                    .then(response => {
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                        this.loading = false
                    })
            })
        },
    },
})
