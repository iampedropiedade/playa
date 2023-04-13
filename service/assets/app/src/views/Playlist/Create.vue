<template>
  <div>
    <h3>Create playlist</h3>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {usePlaylistsStore} from "../../stores/Playlists";

export default {
  name: 'PlaylistCreate',
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore()
    }
  },
}
</script>