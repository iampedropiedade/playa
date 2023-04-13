<template>
  <div class="flex-grow-1">
    <div class="playlist align-items-stretch" v-if="playlistsStore.currentPlaylist">
      <div class="header">
        <info />
      </div>
      <div class="list mt-4">
        <list />
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {usePlaylistsStore} from "../../stores/Playlists";
import TopNav from '../TopNav/Main.vue';
import List from './List.vue';
import Info from './Info.vue';

export default {
  name: 'Playlist',
  components: {
    FontAwesomeIcon,
    TopNav,
    List,
    Info
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore(),
    }
  },
  beforeRouteUpdate(to) {
    console.log('Route update')
    console.log(to.params.id)
    this.playlistsStore.setActivePlaylist(to.params.id)
  },
  mounted() {
    this.playlistsStore.setActivePlaylist(this.$route.params.id)
  }
}
</script>