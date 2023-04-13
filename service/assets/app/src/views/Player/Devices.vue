<template>
  <div class="pe-3 devices">
    <div class="btn-group dropup">
      <button class="button" type="button" :id="uid" data-bs-toggle="dropdown" aria-expanded="false">
        <font-awesome-icon icon="fa-solid fa-tv" />
      </button>
      <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" :aria-labelledby="uid" v-if="settingsStore.devices" >
        <li>
            <span class="dropdown-item-text">
              <span class="title">Current device</span><br>
              <font-awesome-icon :icon="getIcon(getActive())" class="pe-2" />
              {{ getActive().name }}
            </span>
        </li>
        <li><span class="dropdown-item-text title">Select another device</span></li>
        <li v-for="device in settingsStore.devices" >
          <button class="dropdown-item" v-on:click="settingsStore.setDevice(device.id)">
            <font-awesome-icon :icon="getIcon(device)" class="pe-2" />
            {{ device.name }}
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {useSettingsStore} from "../../stores/Settings";
import { v4 as uuid } from 'uuid';

export default {
  name: 'Devices',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
      uid: 'dropdown-menu-button-' + uuid()
    }
  },
  methods: {
    getActive() {
      return this.settingsStore.devices.filter(function (device) {
        return device.is_active === true;
      })
    },
    getIcon(device) {
      let icon = 'fa-solid '
      if(device.type === 'Computer') {
        return icon + 'fa-laptop'
      }
      if(device.type === 'Speaker') {
        return icon + 'fa-headphones-simple'
      }
      return icon + 'fa-tv'
    },
  },
}
</script>