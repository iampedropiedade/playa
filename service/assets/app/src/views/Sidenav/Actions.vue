<template>
  <div class="list-group list-group-flush">
    <router-link :to="{ name: 'Home' }" :class="getClass('Home')">
      <font-awesome-icon icon="fa-solid fa-house" class="pe-2" /> Home
    </router-link>
    <router-link :to="{ name: 'Search' }" :class="getClass('Search')">
      <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="pe-2" /> Search
    </router-link>
    <router-link :to="{ name: 'YourLibrary' }" :class="getClass('YourLibrary')">
      <font-awesome-icon icon="fa-solid fa-layer-group" class="pe-2" /> Your library
    </router-link>
    <router-link :to="{ name: 'PlaylistCreate' }" :class="getClass('PlaylistCreate', 'mt-3')">
      <font-awesome-icon icon="fa-solid fa-square-plus" class="pe-2" /> Create playlist
    </router-link>
    <router-link :to="{ name: 'LikedSongs' }" :class="getClass('LikedSongs')">
      <font-awesome-icon icon="fa-solid fa-heart" class="pe-2" /> Liked songs
    </router-link>
    <router-link :to="{ name: 'About' }" :class="getClass('About')">
      <font-awesome-icon :icon="['far', 'circle-question']" class="pe-2" /> About
    </router-link>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

export default {
  name: 'Actions',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      baseLinkClass: 'list-group-item list-group-item-action',
    }
  },
  methods: {
    getClass(routeName, additionalClasses = '') {
      let className = this.baseLinkClass + (additionalClasses ? ' ' + additionalClasses : '');
      if(this.$route.name === routeName) {
        className += ' active'
      }
      return className;
    },
  },
}
</script>