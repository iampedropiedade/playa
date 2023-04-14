<template>
  <div class="flex-grow-1">
    <div class="playlist align-items-stretch" v-if="playlistsStore.currentPlaylist">
      <div class="header">
        <info
            heading="Playlist"
            :name="playlistsStore.currentPlaylist.name"
            :description="playlistsStore.currentPlaylist.description"
            :imageUrl="playlistsStore.currentPlaylist.images[0].url"
            :owner="playlistsStore.currentPlaylist.owner"
            :total-followers="playlistsStore.currentPlaylist.followers?.total"
            :total-items="playlistsStore.currentPlaylist.tracks?.total"
        />
      </div>
      <div class="list mt-4">
        <list :track-list="playlistsStore.currentPlaylist.tracks.items" type="Playlist" />
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {usePlaylistsStore} from "../../stores/Playlists";
import TopNav from '../TopNav/Main.vue';
import List from '../TrackList/List.vue';
import Info from '../TrackList/Info.vue';

export default {
  name: 'Playlist',
  components: {
    FontAwesomeIcon,
    TopNav,
    Info,
    List
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