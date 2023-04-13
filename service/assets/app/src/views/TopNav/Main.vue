<template>
  <div class="top-nav d-flex align-items-center">
    <div class="flex-grow-1">
      <navigation />
    </div>
    <div class="text-end">
      <user />
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import User from './User.vue';
import Navigation from './Navigation.vue';

export default {
  name: 'TopNav',
  components: {
    FontAwesomeIcon,
    User,
    Navigation
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