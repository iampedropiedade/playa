<template>
  <div class="controls-buttons pb-3">
    <button :class="getShuffleClass()" type="button">
      <font-awesome-icon icon="fa-solid fa-shuffle" size="lg" />
    </button>
    <button class="button" type="button" v-on:click="playerStore.player.previousTrack()">
      <font-awesome-icon icon="fa-solid fa-backward-step" size="lg" />
    </button>
    <button class="button" type="button" v-on:click="playerStore.player.togglePlay()">
      <font-awesome-icon icon="fa-solid fa-circle-play" size="2xl" v-if="playerStore.state?.paused" />
      <font-awesome-icon icon="fa-solid fa-circle-pause" size="2xl" v-else />
    </button>
    <button class="button" type="button" v-on:click="playerStore.player.nextTrack()">
      <font-awesome-icon icon="fa-solid fa-forward-step" size="lg" />
    </button>
    <button :class="getRepeatClass()" type="button">
      <font-awesome-icon icon="fa-solid fa-repeat" size="lg" />
    </button>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css"
import {usePlayerStore} from "../../stores/Player";

export default {
  name: 'ControlsButtons',
  components: {
    FontAwesomeIcon,
    Slider,
  },
  data() {
    return {
      playerStore: usePlayerStore(),
    }
  },
  methods: {
    getRepeatClass() {
      return 'button' + (this.playerStore.state?.repeat_mode ? ' button-active' : '');
    },
    getShuffleClass() {
      return 'button' + (this.playerStore.state?.shuffle ? ' button-active' : '');
    }
  },
}
</script>