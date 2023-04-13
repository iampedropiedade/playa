import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'
import Track from '../model/track'

export const useYourLibraryStore = defineStore({
    id: 'yourLibrary',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'yourLibrary',
        library: null,
        loading: true,
    }),
    actions: {
        async getYourLibrary() {
            if(this.library === null) {
                return this.getYourLibraryFromApi()
            }
            return this.library
        },
        async getYourLibraryFromApi() {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.yourLibrary)
                    .then(response => {
                        this.library = response.data
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
        async addToLibrary(track) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .post(this.settingsStore.endpoints.spotify.yourLibrary + '/' + track.id)
                    .then(() => {
                        if(this.library !== null) {
                            let trackObject = new Track(track)
                            this.library.items.unshift(trackObject)
                            this.library.total++
                        }
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
