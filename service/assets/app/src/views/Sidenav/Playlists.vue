<template>
  <div class="list-group list-group-flush" v-if="playlistsStore.playlists">
    <template v-for="(playlist) in playlistsStore.playlists">
      <router-link :to="{ name: 'Playlist', params: { id: playlist.id } }" class="list-group-item list-group-item-action" :class="getClass(playlist.id)" v-if="playlist.id">
        <div class="d-flex">
          <span class="flex-grow-1">{{ playlist.name }}</span>
          <span v-if="playlist.id === playlistsStore.currentPlaylist?.id"><font-awesome-icon icon="fa-solid fa-volume-high" class="button-active" /></span>
        </div>
      </router-link>
    </template>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";
import Actions from './Actions.vue';

export default {
  name: 'Playlists',
  components: {
    FontAwesomeIcon,
    Actions
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore(),
      baseLinkClass: 'list-group-item list-group-item-action',
    }
  },
  methods: {
    getClass(playlistId) {
      let className = this.baseLinkClass;
      if(this.$route.params?.id === playlistId) {
        className += ' active'
      }
      return className;
    },
  },
}
</script>