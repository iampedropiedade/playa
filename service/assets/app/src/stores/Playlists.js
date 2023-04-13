import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'
import ColorThief from 'colorthief'

export const usePlaylistsStore = defineStore({
    id: 'playlists',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'currentPlaylist',
        playlists: {},
        currentPlaylist: null,
        currentPlaylistHeaderStyle: '',
        loading: true,
    }),
    actions: {
        saveToLocalStorage() {
            localStorage.setItem(this.localStorageKey, JSON.stringify(this.sidenav))
        },
        getFromLocalStorage() {
            let sidenav = JSON.parse(localStorage.getItem(this.localStorageKey))
            this.sidenav = sidenav !== null ? sidenav : {}
        },
        setDominantColour() {
            const colorThief = new ColorThief();
            const img = new Image();
            img.addEventListener('load', () => {
                let dominantColour = colorThief.getColor(img);
                this.currentPlaylistHeaderStyle = 'background-image: linear-gradient(to bottom, rgba(' + dominantColour[0] + ', ' + dominantColour[1] + ', ' + dominantColour[2] + ', 1), transparent 20%)'
            });
            let imageURL = this.currentPlaylist?.images[0]?.url;
            if(imageURL === undefined) {
                return
            }
            let googleProxyURL = 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&refresh=2592000&url=';
            img.crossOrigin = 'Anonymous';
            img.src = googleProxyURL + encodeURIComponent(imageURL);
        },
        async setPlaylist(id, data) {
            this.playlists[id] = data
        },
        async setActivePlaylist(id) {
            if(id === undefined) {
                return
            }
            if(this.playlists[id] === undefined || this.playlists[id].tracks.items === undefined) {
                this.getPlaylistFromApi(id)
            }
            this.currentPlaylist = this.playlists[id]
        },
        async getPlaylist(id) {
            if(this.playlists[id] === undefined) {
                return this.getPlaylistFromApi(id)
            }
            this.currentPlaylist = this.playlists[this.currentPlaylist.id]
        },
        async getPlaylistFromApi(id) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.playlists + '/' + id)
                    .then(response => {
                        this.currentPlaylist = response.data
                        this.playlists[this.currentPlaylist.id] = this.currentPlaylist
                        // this.setDominantColour()
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
        async getPlaylistsFromApi() {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.playlists)
                    .then(response => {
                        let playlists = response.data.items
                        playlists.forEach((playlist) => {
                            if(playlist.id !== undefined) {
                                this.playlists[playlist.id] = playlist
                            }
                        })
                        // this.setDominantColour()
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
