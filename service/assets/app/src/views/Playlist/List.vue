<template>
  <table class="table table-dark text-white transparent">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"></th>
      <th scope="col">Title</th>
      <th scope="col">Album</th>
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
    <tbody v-if="playlistsStore.currentPlaylist?.tracks">
      <tr v-for="(track, index) in playlistsStore.currentPlaylist.tracks.items" class="track align-middle" :id="'playlist-track-id-' + track.track.id">
        <th scope="row" class="small">
          {{ index + 1 }}
        </th>
        <td class="small cover">
          <img :src="track.track.album.images[0].url"/>
        </td>
        <td>
          <h5 class="title">
            {{ track.track.name }}
          </h5>
          <span v-for="(artist, index) in track.track.artists" class="artists">
            {{ artist.name }}<span v-if="index+1 !== track.track.artists.length">, </span>
          </span>
        </td>
        <td class="album">
          {{ track.track.album.name }}
        </td>
        <td class="date-added">
          {{ $date(track.added_at).format('MMM D, YYYY') }}
        </td>
        <td class="small">
          <font-awesome-icon :icon="['far', 'heart']" />
        </td>
        <td class="small duration">
          {{ new Date(track.track.duration_ms).toISOString().slice(14, 19) }}
        </td>
        <td class="small">
          <actions :track="track.track" />
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";
import Actions from '../Track/Actions.vue';
export default {
  name: 'List',
  components: {
    FontAwesomeIcon,
    Actions
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore()
    }
  },
}
</script>