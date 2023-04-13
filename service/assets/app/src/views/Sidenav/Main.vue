<template>
  <div class="align-items-stretch p-4 sidenav">
    <actions />
    <hr />
    <playlists />
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";
import Actions from './Actions.vue';
import Playlists from './Playlists.vue';

export default {
  name: 'Sidenav',
  components: {
    FontAwesomeIcon,
    Actions,
    Playlists,
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore()
    }
  },
}
</script>