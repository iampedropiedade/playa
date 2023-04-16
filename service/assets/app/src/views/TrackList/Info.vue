<template>
  <div class="d-flex align-items-center">
    <div class="cover">
      <img :src="coverImages[0].url" v-if="coverImages?.length > 0" />
      <span class="d-flex align-items-center justify-content-center" v-else>
        <font-awesome-icon v-if="coverIcon" :icon="coverIcon" class="fa-5x" />
      </span>
    </div>
    <div class="flex-grow-1 details ps-4">
      <div class="type">{{ heading }}</div>
      <h1 class="title">{{ name }}</h1>
      <div class="description" v-if="description">{{ description }}</div>
      <div class="owner">
        <span v-if="owner">
          {{ owner?.display_name }}
          <span class="icon-4xs me-1"><font-awesome-icon icon="fa-solid fa-circle" /></span>
        </span>
        <span v-if="totalFollowers">
          {{ totalFollowers }} likes
          <span class="icon-4xs me-1"><font-awesome-icon icon="fa-solid fa-circle" /></span>
        </span>
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
    coverImages: {required: false},
    coverIcon: {required: false},
    owner: {required: false},
    totalFollowers: {required: false},
    totalItems: {required: false},
  },
  methods: {
  },
}
</script>