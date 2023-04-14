<template>
  <div class="d-flex">
    <div class="cover">
      <img :src="imageUrl" v-if="imageUrl" />
      <span class="d-flex align-items-center justify-content-center" v-else><font-awesome-icon :icon="['fas', 'heart']" class="fa-5x" /></span>
    </div>
    <div class="flex-grow-1 details ps-4">
      <div class="type">{{ heading }}</div>
      <h1 class="title">{{ name }}</h1>
      <div class="description" v-if="description">{{ description }}</div>
      <div class="owner">
        {{ owner?.display_name }}
        <span v-if="totalFollowers">
          <span class="icon-4xs"><font-awesome-icon icon="fa-solid fa-circle" /></span>
          {{ totalFollowers }} likes
        </span>
        <span class="icon-4xs"><font-awesome-icon icon="fa-solid fa-circle" /></span>
        {{ totalItems }} songs
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlaylistsStore} from "../../stores/Playlists";

export default {
  name: 'Info',
  components: {
    FontAwesomeIcon
  },
  props: {
    heading: {required: true, type: String},
    name: {required: true},
    description: {required: false},
    imageUrl: {required: true},
    owner: {required: false},
    totalFollowers: {required: false},
    totalItems: {required: false},
  },
  methods: {
  },
}
</script>