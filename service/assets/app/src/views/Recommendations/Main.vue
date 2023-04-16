<template>
  <div class="flex-grow-1">
    <div class="playlist align-items-stretch" v-if="recommendationsStore.recommendations[id]">
      <div class="header">
        <info
            heading="Recommendations"
            :name="tracksStore.tracks[id]?.name"
            :description="description()"
            :total-items="recommendationsStore.recommendations[id]?.tracks?.length"
            :cover-images="tracksStore.tracks[id]?.album?.images"
        />
      </div>
      <div class="list mt-4">
        <list :track-list="recommendationsStore.recommendations[$route.params.id]?.tracks" type="Recommendations" />
      </div>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import TopNav from '../TopNav/Main.vue';
import List from '../TrackList/List.vue';
import Info from '../TrackList/Info.vue';
import {useRecommendationsStore} from "../../stores/Recommendations";
import {useTracksStore} from "../../stores/Tracks";

export default {
  name: 'Recommendations',
  components: {
    FontAwesomeIcon,
    TopNav,
    Info,
    List
  },
  data() {
    return {
      recommendationsStore: useRecommendationsStore(),
      tracksStore: useTracksStore(),
      id: null,
      maxDescriptionItems: 5
    }
  },
  methods: {
    description() {
      let trackRecommendations = this.recommendationsStore.recommendations[this.id]?.tracks
      let count = trackRecommendations.length
      if(count === 0) {
        return ''
      }
      let description = 'With '
      let items = trackRecommendations.slice(0, this.maxDescriptionItems)
      items.forEach((item, index) => {
        description += item.artists[0].name
        if(index < this.maxDescriptionItems-1) {
          description += ', '
        }
      })
      if(count > this.maxDescriptionItems) {
        description += ' and ' + (count - this.maxDescriptionItems) + ' more'
      }
      return description
    },
  },
  mounted() {
    this.id = this.$route.params.id
    this.tracksStore.getTrack(this.id)
    this.recommendationsStore.getRecommendationsForTrack(this.id)
  }
}
</script>