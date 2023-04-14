import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'

export const useRecommendationsStore = defineStore({
    id: 'recommendations',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'recommendations',
        recommendations: {},
    }),
    actions: {
        async getRecommendationsForTrack(track) {
            if(this.recommendations[track.id] === undefined) {
                this.getRecommendationsForTrackFromApi(track)
            }
            return this.recommendations[track.id]
        },
        async getRecommendationsForTrackFromApi(track) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.recommendations + '/track/' + track.id)
                    .then(response => {
                        this.recommendations[track.id] = response.data
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
