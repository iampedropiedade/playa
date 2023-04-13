<template>
  <div class="search">
    <div class="input-group">
      <input type="text" placeholder="Playlist share link" class="form-control">
      <button type="button" class="btn btn-light">
        <font-awesome-icon icon="fa-solid fa-bars" />
      </button>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";

export default {
  name: 'Search',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
    }
  },
  methods: {},
}
</script>