<template>
  <div class="flex-grow-1">
    <div class="playlist align-items-stretch" v-if="yourLibraryStore.library">
      <div class="header">
        <info
            heading="Library"
            name="Liked Songs"
            :owner="settingsStore.profile"
            :total-items="yourLibraryStore.library.total"
        />
      </div>
      <div class="list mt-4">
        <list :track-list="yourLibraryStore.library.items" type="LikedSongs" />
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {useYourLibraryStore} from "../../stores/YourLibrary";
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
      yourLibraryStore: useYourLibraryStore(),
    }
  },
  mounted() {
    this.yourLibraryStore.getYourLibrary()
  }
}
</script>