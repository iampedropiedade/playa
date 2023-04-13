<template>
  <footer class="row player">
    <div class="col-2 playing align-self-center">
      <now-playing v-model="playerStore.currentTrack" />
    </div>
    <div class="col-8 controls text-center">
      <div class="row">
        <div class="col-6 offset-3">
          <controls-buttons />
          <controls-seek />
        </div>
      </div>
    </div>
    <div class="col-2 settings align-self-center">
      <settings />
    </div>
  </footer>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import Slider from '@vueform/slider'
import "@vueform/slider/themes/default.css"
import {useSettingsStore} from "../../stores/Settings";
import {usePlayerStore} from "../../stores/Player";
import ControlsButtons from './ControlsButtons.vue';
import ControlsSeek from './ControlsSeek.vue';
import NowPlaying from './NowPlaying.vue';
import Settings from './Settings.vue';

export default {
  name: 'Player',
  components: {
    ControlsButtons,
    ControlsSeek,
    NowPlaying,
    Settings,
    FontAwesomeIcon,
    Slider,
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      playerStore: usePlayerStore(),
      loading: false,
      volume: 50,
      seek: 0
    }
  },
  methods: {
  },
  mounted() {
    this.playerStore.initPlayer()
  },
}
</script>