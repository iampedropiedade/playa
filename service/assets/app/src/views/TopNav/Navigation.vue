<template>
  <div>
    <button class="btn btn-link text-white" type="button" v-on:click="previous()" :disabled="previousDisabled">
      <font-awesome-icon icon="fa-solid fa-circle-chevron-left" class="fa-xl" />
    </button>
    <button class="btn btn-link text-white" type="button" v-on:click="next()" :disabled="nextDisabled">
      <font-awesome-icon icon="fa-solid fa-circle-chevron-right" class="fa-xl" />
    </button>  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";

export default {
  name: 'Navigation',
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      previousDisabled: false,
      nextDisabled: false,
    }
  },
  methods: {
    next() {
      this.$router.go(1)
    },
    previous() {
      this.$router.go(-1)
    },
  },
  watch:{
    $route (to) {
      this.previousDisabled = this.$router.options.history.state.back === null
      this.nextDisabled = this.$router.options.history.state.forward === null
    }
  },
}
</script>