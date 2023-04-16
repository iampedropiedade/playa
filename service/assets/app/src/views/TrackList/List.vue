<template>
  <table class="table table-dark text-white transparent">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col" v-if="type !== 'Album'"></th>
        <th scope="col">Title</th>
        <th scope="col" v-if="type !== 'Album'">Album</th>
        <th scope="col">
          <font-awesome-icon icon="fa-solid fa-calendar-days" />
        </th>
        <th scope="col"></th>
        <th scope="col">
          <font-awesome-icon icon="fa-regular fa-clock"/>
        </th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody v-if="trackList?.length > 0">
      <template v-for="(track, index) in trackList">
        <track-item :track-object="track" :index="index" :type="type" :context-uri="contextUri" />
      </template>
    </tbody>
  </table>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";
import {useYourLibraryStore} from "../../stores/YourLibrary";
import {useAlbumsStore} from "../../stores/Albums";
import TrackItem from './TrackItem.vue';

export default {
  name: 'TrackList',
  components: {
    FontAwesomeIcon,
    TrackItem
  },
  props: {
    trackList: {required: true},
    type: {required: true, type: String},
    contextUri: {required: false},
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore(),
      yourLibraryStore: useYourLibraryStore(),
      albumsStore: useAlbumsStore(),
    }
  }
}
</script>