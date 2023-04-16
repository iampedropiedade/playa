import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'
import Track from "../model/track";

export const useRecommendationsStore = defineStore({
    id: 'recommendations',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'recommendations',
        currentRecommendations: {},
        recommendations: {},
    }),
    actions: {
        async getRecommendationsForTrack(trackId) {
            if(this.recommendations[trackId] === undefined) {
                this.getRecommendationsForTrackFromApi(trackId)
            }
            this.currentRecommendations = this.recommendations[trackId]
            return this.recommendations[trackId]
        },
        async getRecommendationsForTrackFromApi(trackId) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.recommendations + '/track/' + trackId)
                    .then(response => {
                        this.recommendations[trackId] = response.data
                        this.currentRecommendations = this.recommendations[trackId]
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
