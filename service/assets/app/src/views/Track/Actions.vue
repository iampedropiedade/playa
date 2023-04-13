<template>
  <div class="pe-3 devices">
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
          <button class="dropdown-item" v-on:click="">
            Go to song radio
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-on:click="">
            Go to artist
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-on:click="">
            Go to album
          </button>
        </li>
        <li>
          <button class="dropdown-item" v-on:click="">
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
          <button class="dropdown-item" v-if="playlistsStore.currentPlaylist" v-on:click="removeFromCurrentPlaylist()">
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
      </ul>
    </div>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import {usePlaylistsStore} from "../../stores/Playlists";
import {useYourLibraryStore} from "../../stores/YourLibrary";
import { v4 as uuid } from 'uuid';

export default {
  name: 'Actions',
  components: {
    FontAwesomeIcon
  },
  props: {
    track: {required: true, type: Object},
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playlistsStore: usePlaylistsStore(),
      yourLibraryStore: useYourLibraryStore(),
      uid: 'track-actions-dropdown-menu-button-' + uuid()
    }
  },
  methods: {
    like() {
      this.yourLibraryStore.addToLibrary(this.track)
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