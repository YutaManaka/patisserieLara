<template>
  <div
    v-bind="$attrs"
    @mouseover="show = true"
    @mouseleave="show = false">
    <slot name="icon">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 pb-1"
        style="color: #A9A9A9;"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </slot>
    <div v-show="show">
      <div
        class="absolute z-10 p-4 -mt-1 w-7/12 text-sm leading-tight text-black transform -translate-x-1/2 -translate-y-full rounded-lg shadow-lg bg-gray-100"
        :style="styleObject">
        <slot name="content" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  styleObject: {
    type: Object,
    required: true,
  },
})

const show = ref(false)
</script>
