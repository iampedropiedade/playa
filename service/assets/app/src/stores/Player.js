import { defineStore } from 'pinia'
import { useSettingsStore } from './Settings'
import { usePlaylistsStore } from './Playlists'
import axios from 'axios'

export const usePlayerStore = defineStore({
    id: 'player',
    state: () => ({
        player: null,
        currentTrack: null,
        state: null,
        playbackState: null,
        progress: 0,
        relativeProgress: 0,
        volume: 50,
        settingsStore: useSettingsStore(),
        playlistStore: usePlaylistsStore(),
    }),
    actions: {
        initPlayer() {
            const script = document.createElement("script")
            script.src = "https://sdk.scdn.co/spotify-player.js"
            script.async = true
            document.body.appendChild(script)
            window.onSpotifyWebPlaybackSDKReady = () => {
                this.player = new window.Spotify.Player({
                    name: 'Playa',
                    getOAuthToken: cb => {
                        cb(this.settingsStore.token)
                    }
                });
                this.player.connect().then(() => {
                    this.playbackState().then(() => {
                        this.currentTrack = this.playbackState.item
                    })
                    this.settingsStore.getProfile()
                    this.settingsStore.getDevices()
                    this.player.getVolume().then(volume => {
                        this.volume = Math.round(volume * 100)
                    });
                    this.player.activateElement()
                });
                this.player.addListener("player_state_changed", state => {
                    this.state = state
                    this.currentTrack = state.track_window.current_track
                });
                this.player.addListener("progress", progress => {
                    this.$patch({ progress: progress.position })
                    this.relativeProgress = this.state?.duration === 0 ? 0 : Math.round(this.progress / this.state?.duration * 1000)
                });
            };
        },
        async playbackState() {
            return new Promise((resolve, reject) => {
                axios
                    .get(this.settingsStore.endpoints.spotify.playbackState)
                    .then(response => {
                        this.playbackState = response.data
                        this.getContextFromApi(this.playbackState.context?.uri);
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
            })
        },
        async getContextFromApi(context) {
            if(context === undefined) {
                return
            }
            return new Promise((resolve, reject) => {
                this.loading = true;
                axios
                    .get(this.settingsStore.endpoints.spotify.context + '/' + context)
                    .then(response => {
                        let context = response.data
                        this.playlistStore.setPlaylist(context.id, context)
                        this.playlistStore.setActivePlaylist(context.id);
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
