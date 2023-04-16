<template>
  <div class="flex-grow-1">
    <div class="playlist align-items-stretch" v-if="albumsStore.currentAlbum">
      <div class="header">
        <info
            heading="Album"
            :name="albumsStore.currentAlbum.name"
            :total-items="albumsStore.currentAlbum.total_tracks"
            :cover-images="albumsStore.currentAlbum.images"
        />
      </div>
      <div class="list mt-4">
        <list :track-list="albumsStore.currentAlbum.tracks?.items" type="Album" />
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {useAlbumsStore} from "../../stores/Albums";
import TopNav from '../TopNav/Main.vue';
import List from '../TrackList/List.vue';
import Info from '../TrackList/Info.vue';

export default {
  name: 'Album',
  components: {
    FontAwesomeIcon,
    TopNav,
    Info,
    List
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      albumsStore: useAlbumsStore(),
      id: null,
    }
  },
  mounted() {
    this.id = this.$route.params.id
    this.albumsStore.getAlbum(this.id)
  }
}
</script>