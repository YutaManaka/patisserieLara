<template>
  <transition-group appear>
    <div
      v-if="$page.props.jetstream.flash.success && show"
      class="fixed top-14 flex items-center justify-between bg-green-600 w-full opacity-90">
      <div class="flex items-center">
        <svg
          class="ml-4 mt-3 mr-2 flex-shrink-0 w-4 h-4 fill-white"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20">
          <polygon
            fill="white"
            points="0 11 2 9 7 14 18 3 20 5 7 18" />
        </svg>
        <div class="pt-8 pb-4 text-white text-sm font-medium">
          {{ $page.props.jetstream.flash.success }}
        </div>
      </div>
      <button
        type="button"
        class="group mr-2 p-2"
        @click.stop="closeFlashMessage">
        <svg
          class="block mt-3 w-2 h-2 fill-green-800 group-hover:fill-white"
          xmlns="http://www.w3.org/2000/svg"
          width="235.908"
          height="235.908"
          viewBox="278.046 126.846 235.908 235.908">
          <path
            fill="white"
            d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" />
        </svg>
      </button>
    </div>
  </transition-group>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps(['on'])

const show = ref(false)
watch(
  () => props.on.success,
  (newValue, oldValue) => {
    if (newValue === oldValue) return
    show.value = true
    setTimeout(() => {
      show.value = false
    }, 5000)
  },
  { deep: true },
)
if (props.on.success) {
  show.value = true
}
if (show.value) {
  setTimeout(() => {
    show.value = false
  }, 5000)
}
const closeFlashMessage = () => {
  show.value = false
}
</script>

<style scoped>
.v-enter-from {
  opacity: 0;
}
.v-enter-active {
  transition: opacity 0.7s
}
.v-enter-to {
  opacity: 0.9;
}
.v-leave-from {
  opacity: 0.9;
}
.v-leave-active {
  transition: opacity 0.7s
}
.v-leave-to {
  opacity: 0;
}
</style>
