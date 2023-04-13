<template>
  <div class="d-flex" v-if="modelValue">
    <div class="cover">
      <img :src="modelValue.album?.images[0].url" alt="cover" />
    </div>
    <div class="flex-grow-1 details ps-3 align-self-center">
      <h5 class="title">{{ modelValue.name }}</h5>
      <span v-for="(artist, index) in modelValue.artists" class="artists">
        {{ artist.name }}<span v-if="index+1 !== modelValue.artists.length">, </span>
      </span>
    </div>
  </div>
</template>
<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import { storeToRefs } from 'pinia'
import "@vueform/slider/themes/default.css"
import {usePlayerStore} from "../../stores/Player";

export default {
  name: 'NowPlaying',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      playerStore: usePlayerStore(),
      progress: storeToRefs(this.playerStore)
    }
  },
  props: ['modelValue'],
  computed: {
    value: {
      get() {
        return this.modelValue
      },
      set(value) {
        this.$emit('update:modelValue', value)
      }
    }
  },

  methods: {
    getRepeatClass() {
      this.playerStore.$subscribe((mutation, state) => {
        console.log(mutation)
        console.log(state)
      })
    },
  },
}
</script>