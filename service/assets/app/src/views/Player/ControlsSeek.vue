<template>
  <div class="seek d-flex"  v-if="playerStore.state">
    <div class="current pe-3 text-small">
      {{ new Date(this.playerStore.progress).toISOString().slice(14, 19) }}
    </div>
    <div class="seek-bar align-self-center flex-grow-1">
      <slider v-model="playerStore.relativeProgress" :tooltips="false" class="slider slider-seek" :min="0" :max="1000"></slider>
    </div>
    <div class="total ps-3">
      {{ new Date(playerStore.state?.duration).toISOString().slice(14, 19) }}
    </div>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import Slider from '@vueform/slider'
import {usePlayerStore} from "../../stores/Player";

export default {
  name: 'ControlsSeek',
  components: {
    FontAwesomeIcon,
    Slider,
  },
  data() {
    return {
      playerStore: usePlayerStore(),
    }
  },
  methods: {}
}
</script>