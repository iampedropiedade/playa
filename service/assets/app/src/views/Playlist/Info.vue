<template>
  <div class="d-flex">
    <div class="cover">
      <img :src="playlistsStore.currentPlaylist.images[0].url" />
    </div>
    <div class="flex-grow-1 details ps-4">
      <div class="type">Playlist</div>
      <h1 class="title">{{ playlistsStore.currentPlaylist.name }}</h1>
      <div class="description">{{ playlistsStore.currentPlaylist.description }}</div>
      <div class="owner">
        {{ playlistsStore.currentPlaylist.owner?.display_name }}
        <span class="icon-4xs"><font-awesome-icon icon="fa-solid fa-circle" /></span>
        {{ playlistsStore.currentPlaylist.followers?.total }} likes
        <span class="icon-4xs"><font-awesome-icon icon="fa-solid fa-circle" /></span>
        {{ playlistsStore.currentPlaylist.tracks?.total }} songs
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";

export default {
  name: 'Info',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore(),
    }
  },
  methods: {
  },
}
</script>