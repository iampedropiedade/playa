<template>
  <div class="user" v-if="settingsStore.profile">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle dropdown-toggle btn-sm btn-dark px-2 rounded-pill button-black" type="button" :id="uid" data-bs-toggle="dropdown" aria-expanded="false">
        <img :src="settingsStore.profile?.images[0]?.url" class="avatar" v-if="settingsStore.profile?.images" />
        <font-awesome-icon icon="fa-regular fa-user" v-else />
        <span class="px-2">{{ settingsStore.profile.display_name }}</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-dark" :aria-labelledby="uid">
        <li>
          <a class="dropdown-item" href="https://www.spotify.com/account/overview/">Account</a>
        </li>
        <li>
          <a class="dropdown-item" :href="'/profile'" target="_blank">Profile</a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Log out</a></li>
      </ul>
    </div>
  </div>
</template>

<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import { v4 as uuid } from 'uuid';

export default {
  name: 'User',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      uid: 'dropdown-menu-button-' + uuid()
    }
  },
  methods: {},
}
</script>