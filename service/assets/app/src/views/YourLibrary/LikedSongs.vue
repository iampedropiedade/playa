<template>
  <div class="col-3 mb-3">
    <router-link :to="{ name: 'LikedSongs' }" class="link-light text-decoration-none">
      <div class="card liked-songs me-3 mb-3 w-100 h-100">
        <div class="card-body p-4 d-flex flex-column align-items-start" v-if="yourLibraryStore.library">
          <div class="mt-5 mb-auto">
            <span v-for="(item, index) in yourLibraryStore.library.items.slice(0, maxLikedSongs)" >
              <span class="artist me-2">{{ item.track.artists[0].name }}</span>
              <span class="track">{{ item.track.name }}</span>
              <span v-if="index < maxLikedSongs-1" class="icon-4xs px-2"><font-awesome-icon icon="fa-solid fa-circle" /></span>
            </span>
            <span v-if="yourLibraryStore.library.total > maxLikedSongs">
              <span class="icon-4xs px-2"><font-awesome-icon icon="fa-solid fa-circle" /></span> ...
            </span>
          </div>
          <div>
            <h3 class="mb-4">Liked songs</h3>
            <div>{{ yourLibraryStore.library.total }} liked songs</div>
          </div>
        </div>
      </div>
    </router-link>
  </div>
</template>
<script>
import {useYourLibraryStore} from "../../stores/YourLibrary"
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

export default {
  name: 'Playlists',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      yourLibraryStore: useYourLibraryStore(),
      maxLikedSongs: 10
    }
  },
  methods: {
  },
  mounted() {
    this.yourLibraryStore.getYourLibrary()
  },
}
</script>