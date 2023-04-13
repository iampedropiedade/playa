<template>
  <div class="col-1-5 mb-3" v-for="(playlist) in playlistsStore.playlists">
    <router-link :to="{ name: 'Playlist', params: { id: playlist.id } }" class="link-light text-decoration-none  me-3 mb-3 w-100 h-100" v-if="playlist.id">
      <div class="cover" :style="getStyle(playlist)">
      </div>
      <div class="title">{{ playlist.name }}</div>
      <div class="description mt-2">{{ getDescription(playlist) }}</div>
    </router-link>
  </div>
</template>
<script>
import {usePlaylistsStore} from "../../stores/Playlists";
import {Text} from "../../functions/text"

export default {
  name: 'Playlists',
  components: {
    Text
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore(),
      text: new Text()
    }
  },
  methods: {
    getDescription(playlist) {
      if(playlist.description.length > 0) {
        return this.text.trim(playlist.description, 60)
      }
      return 'By ' + playlist.owner.display_name
    },
    getStyle(playlist) {
      return 'background-image:url("' + playlist.images[0].url + '");'
    },
  },
}
</script>