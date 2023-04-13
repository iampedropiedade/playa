<template>
  <div>
    <h3 class="mb-4">Playlists</h3>
    <div class="row your-library">
      <liked-songs />
      <playlists />
    </div>
  </div>
</template>
<script>
import Playlists from "./Playlists.vue"
import LikedSongs from "./LikedSongs.vue"

export default {
  name: 'YourLibrary',
  components: {
    LikedSongs,
    Playlists
  },
}
</script>