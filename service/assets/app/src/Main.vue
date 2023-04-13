<template>
  <div class="spotify">
    <div class="d-flex">
      <sidenav />
      <router />
    </div>
    <player />
  </div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Router from './views/Router/Main.vue';
import Sidenav from './views/Sidenav/Main.vue';
import Player from './views/Player/Main.vue';
import {useSettingsStore} from "./stores/Settings";
import {usePlaylistsStore} from "./stores/Playlists";

export default {
  components: {
    FontAwesomeIcon,
    Router,
    Sidenav,
    Player
  },
  props: {
    route: {required: true, type: String},
    token: {required: true, type: String},
    tokenDuration: {required: true, type: Number},
    spotifyEndpoints: {required: true, type: String},
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore(),
    }
  },
  methods: {
    init() {
      this.settingsStore.endpoints.spotify = JSON.parse(this.spotifyEndpoints);
      this.settingsStore.token = this.token;
      this.settingsStore.tokenDuration = this.tokenDuration;
      this.settingsStore.setTokenRefreshTimeout()
      this.playlistsStore.getPlaylistsFromApi();
      this.$router.push(this.route)
    }
  },
  created() {
    this.init()
  },
}
</script>
