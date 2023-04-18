<template>
  <div class="pe-3">
    <div class="btn-group dropup track">
      <button class="button" type="button" :id="uid" data-bs-toggle="dropdown" aria-expanded="false">
        <font-awesome-icon icon="fa-solid fa-ellipsis-vertical" />
      </button>
      <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" :aria-labelledby="uid">
        <li>
          <button class="dropdown-item" v-on:click="">
            Add to queue
          </button>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <button class="dropdown-item" v-on:click="recommendations()">
            View song recommendations
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-on:click="">
            Go to artist
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-on:click="" v-if="track.album">
            Go to album
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-on:click=""  data-bs-toggle="modal" :data-bs-target="'#credits-modal-' + uid">
            Show credits
          </button>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <button class="dropdown-item" v-on:click="like()">
            Save to your liked songs
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-if="type === 'Playlist' && playlistsStore.currentPlaylist" v-on:click="removeFromCurrentPlaylist()">
            Remove from this playlist
          </button>
        </li>
        <li>
          <div class="btn-group dropstart">
            <button class="dropdown-item" v-on:click="" :id="'add-to-playlist-' + uid" data-bs-toggle="dropdown" aria-expanded="false">
              Add to playlist
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" :aria-labelledby="'add-to-playlist-' + uid">
              <li v-for="(playlist) in playlistsStore.playlists">
                <button class="dropdown-item" v-on:click="addToPlaylist(playlist.id)">{{ playlist.name }}</button>
              </li>
            </ul>
          </div>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <button class="dropdown-item" v-on:click="">
            Share
          </button>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <button class="dropdown-item" v-on:click="">
            Open in Desktop app
          </button>
        </li>
        <li>
            <button class="dropdown-item" v-on:click="tracksStore.downloadTrack(track, index+1)">
                Download as mp3
            </button>
        </li>
      </ul>
    </div>
    <div class="modal fade" :id="'credits-modal-' + uid" tabindex="-1" :aria-labelledby="'credits-modal-label' + uid" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-dark text-white p-4">
          <div class="modal-header">
            <h3 class="modal-title" :id="'credits-modal-label' + uid">{{ track.name }}</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <font-awesome-icon :icon="['fas', 'xmark']" class="text-white fa-2xl" />
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <img class="img-fluid" :src="track.album?.images[0]?.url" :alt="track.name" />
              </div>
              <div class="col-6">
                <h6 class="mb-2">Performed by</h6>
                <div class="mb-4">
                  <span v-for="(artist, index) in track.artists">
                    {{ artist.name }}<span v-if="index+1 !== track.artists.length">, </span>
                  </span>
                </div>
                <div v-if="track.album">
                  <h6 class="mb-2">Album</h6>
                  <div class="mb-4">
                    {{ track.album.name }}
                  </div>
                  <h6 class="mb-2">Released</h6>
                  <div class="mb-4">
                    {{ $date(track.album.release_date).format('MMM D, YYYY') }}
                  </div>
                </div>
                <h6 class="mb-2">Popularity</h6>
                <div class="mb-4">
                  {{ track.popularity }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {usePlaylistsStore} from "../../stores/Playlists";
import {useYourLibraryStore} from "../../stores/YourLibrary";
import {useRecommendationsStore} from "../../stores/Recommendations";
import { v4 as uuid } from 'uuid';
import {useTracksStore} from "../../stores/Tracks";

export default {
  name: 'Actions',
  components: {
    FontAwesomeIcon
  },
  props: {
    track: {required: true, type: Object},
    index: {required: true, type: Number},
    type: {required: true, type: String},
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore(),
      yourLibraryStore: useYourLibraryStore(),
      recommendationsStore: useRecommendationsStore(),
      tracksStore: useTracksStore(),
      uid: 'track-actions-' + uuid()
    }
  },
  methods: {
    like() {
      this.yourLibraryStore.addToLibrary(this.track)
    },
    recommendations() {
      this.recommendationsStore.getRecommendationsForTrack(this.track.id)
      this.$router.push({ name: 'Recommendations', params: { id: this.track.id } })
    },
    addToPlaylist(playlistId) {
      this.playlistsStore.addTrackToPlaylist(playlistId, this.track)
    },
    removeFromCurrentPlaylist() {
      this.playlistsStore.removeTrackFromCurrentPlaylist(this.track)
    },
  },
}
</script>