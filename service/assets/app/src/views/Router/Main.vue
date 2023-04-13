<template>
  <div class="align-items-stretch flex-grow-1 p-4 main" :style="playlistsStore.currentPlaylistHeaderStyle">
    <div class="loading" v-if="playlistsStore.loading">
      <font-awesome-icon icon="fa-solid fa-circle-notch" class="fa-spin fa-8x" />
    </div>
    <div class="align-items-stretch">
      <div class="top-nav p-4">
        <top-nav />
      </div>
      <div class="routes p-4">
        <router-view />
      </div>
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useSettingsStore } from "../../stores/Settings";
import { usePlaylistsStore } from "../../stores/Playlists";
import TopNav from "../TopNav/Main.vue";
import Player from "../Player/Main.vue";

export default {
  name: 'Router',
  components: {
    FontAwesomeIcon,
    TopNav,
    Player
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore(),
    }
  },
}
</script>