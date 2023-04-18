import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'
import {Download} from "../functions/download"

export const useTracksStore = defineStore({
    id: 'tracks',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'downloadedTracks',
        downloadedTracks: JSON.parse(localStorage.getItem('downloadedTracks')) ?? [],
        tracks: {},
        download: new Download(),
    }),
    actions: {
        setDownloadedTrack(track) {
            this.downloadedTracks.push(track.id)
            localStorage.setItem(this.localStorageKey, JSON.stringify(this.downloadedTracks))
        },
        async downloadTrack(track, index = 0) {
            let indexString = index.toString()
            let trackName = indexString.padStart(4, '0')  + ' - ' + track.name +  ' - ' + track.artists.map(a => a.name).join(', ') + '.mp3'
            return new Promise((resolve, reject) => {
                axios
                    .get(this.settingsStore.endpoints.spotify.tracks + '/' + track.id + '/download')
                    .then(response => {
                        if(!response.data.expiresAt) {
                            return;
                        }
                        axios
                            .get(response.data.link, {responseType: 'blob'})
                            .then((response) => {
                                this.download(response.data, trackName)
                            })
                            .catch(errors => {
                            })
                            .finally(() => {
                                resolve()
                            })
                    })
                    .catch(errors => {
                    })
                    .finally(() => {
                        resolve()
                    })
            })
        },
        async setTrack(track) {
            this.tracks[track.id] = track
        },
        async getTrack(trackId) {
            if(this.tracks[trackId] === undefined) {
                await this.getTrackFromApi(trackId)
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
