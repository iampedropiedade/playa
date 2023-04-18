<template>
  <tr class="track align-middle" :id="'track-id-' + track.id" role="button">
    <th scope="row" class="small track-number" v-on:click="play($event)" >
      <span class="index">
        {{ index + 1 }}
      </span>
      <span class="play">
        <font-awesome-icon :icon="['fas', 'play']" />
      </span>
    </th>
    <td class="small cover" v-if="track.album" v-on:click="play($event)" >
      <img :src="track.album?.images[0].url"/>
    </td>
    <td v-on:click="play($event)" >
      <h5 class="title">
        {{ track.name }}
      </h5>
      <span v-for="(artist, index) in track.artists" class="artists">
        {{ artist.name }}<span v-if="index+1 !== track.artists.length">, </span>
      </span>
    </td>
    <td class="album" v-if="track.album" v-on:click="play($event)" >
      <button v-on:click="viewAlbum()" class="btn btn-sm btn-link text-light-20 text-decoration-none">{{ track.album?.name }}</button>
    </td>
    <td class="date-added" v-on:click="play($event)" >
      <span v-if="addedAt">
        {{ $date(addedAt).format('MMM D, YYYY') }}
      </span>
    </td>
    <td class="small" v-on:click="play($event)" >
      <button class="dropdown-item" v-on:click="this.yourLibraryStore.addToLibrary(track)">
        <font-awesome-icon :icon="['far', 'heart']" />
      </button>
    </td>
    <td class="small duration" v-on:click="play($event)" >
      {{ new Date(track.duration_ms).toISOString().slice(14, 19) }}
    </td>
    <td class="small">
      <actions :track="track" :type="type" :index="index" />
    </td>
  </tr>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";
import {useYourLibraryStore} from "../../stores/YourLibrary";
import {useAlbumsStore} from "../../stores/Albums";
import {useTracksStore} from "../../stores/Tracks";
import {usePlayerStore} from "../../stores/Player";
import {useRecommendationsStore} from "../../stores/Recommendations";
import Actions from './Actions.vue';

export default {
  name: 'TrackItem',
  components: {
    FontAwesomeIcon,
    Actions
  },
  props: {
    trackObject: {required: true, type: Object},
    index: {required: true, type: Number},
    type: {required: true, type: String},
    contextUri: {required: false, type: String},
  },
  data() {
    return {
      playlistsStore: usePlaylistsStore(),
      tracksStore: useTracksStore(),
      playerStore: usePlayerStore(),
      yourLibraryStore: useYourLibraryStore(),
      albumsStore: useAlbumsStore(),
      recommendationsStore: useRecommendationsStore(),
      track: this.trackObject.added_at ? this.trackObject.track : this.trackObject,
      addedAt: this.trackObject.added_at ?? null
    }
  },
  methods: {
    viewAlbum() {
      this.albumsStore.currentAlbum = this.track.album
      this.$router.push({ name: 'Album', params: { id: this.track.album.id } })
    },
    play(event) {
      if(event.target.getAttribute('data-bs-toggle') === 'dropdown') {
        return
      }
      if(this.type === 'Recommendations') {
        this.playerStore.playTracks(this.recommendationsStore.currentRecommendations.tracks)
      }
      else {
        this.playerStore.playContext(this.track.uri, this.contextUri)
      }
    },
  },
}
</script>