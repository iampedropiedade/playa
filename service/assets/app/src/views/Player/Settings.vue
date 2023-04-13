<template>
  <div class="d-flex">
    <devices />
    <div class="pe-3">
      <font-awesome-icon :icon="getVolumeIcon()" />
    </div>
    <div class="flex-grow-1 align-self-center">
      <slider v-model="playerStore.volume" :tooltips="false" class="slider slider-volume"></slider>
    </div>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {usePlayerStore} from "../../stores/Player";
import {useSettingsStore} from "../../stores/Settings";
import Slider from '@vueform/slider'
import Devices from './Devices.vue';

export default {
  name: 'Settings',
  components: {
    FontAwesomeIcon,
    Slider,
    Devices
  },
  data() {
    return {
      playerStore: usePlayerStore(),
      settingsStore: useSettingsStore(),
    }
  },
  methods: {
    getVolumeIcon() {
      let icon = 'fa-solid fa-volume-'
      if(this.playerStore.volume === 0) {
        return icon + 'off'
      }
      if(this.playerStore.volume >= 50) {
        return icon + 'high'
      }
      return icon + 'low'
    },
  },
}
</script>