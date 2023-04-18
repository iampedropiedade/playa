<template>
  <div class="flex-grow-1">
    <div class="playlist align-items-stretch" v-if="playlistsStore.currentPlaylist">
      <div class="header">
        <info
            heading="Playlist"
            :name="playlistsStore.currentPlaylist.name"
            :description="playlistsStore.currentPlaylist.description"
            :cover-images="playlistsStore.currentPlaylist.images"
            :owner="playlistsStore.currentPlaylist.owner"
            :total-followers="playlistsStore.currentPlaylist.followers?.total"
            :total-items="playlistsStore.currentPlaylist.tracks?.total"
            :track-list="playlistsStore.currentPlaylist.tracks.items"
        />
      </div>
      <div class="list mt-4">
        <list :track-list="playlistsStore.currentPlaylist.tracks.items" type="Playlist" :context-uri="playlistsStore.currentPlaylist.uri" />
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
  props: {
    loadMore: {required: true, type: Boolean},
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore(),
      id: null
    }
  },
  watch: {
    loadMore: function(newVal) {
      if(newVal === true) {
          this.playlistsStore.loadMore()
      }
    }
  },
  beforeRouteUpdate(to) {
    this.id = to.params.id
    console.log('Playlist route update: ' + this.id)
    this.playlistsStore.setActivePlaylist(to.params.id)
  },
  mounted() {
    this.id = this.$route.params.id
    console.log('Playlist mounted: ' + this.id)
    this.playlistsStore.setActivePlaylist(this.$route.params.id)
  }
}
</script>