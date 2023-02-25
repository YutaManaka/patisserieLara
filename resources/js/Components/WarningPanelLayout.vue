<template>
  <div class="mx-auto px-8">
    <div class="bg-gray-600 text-gray-50 font-bold ext-2xl py-4 px-5">
      <slot name="title" />
    </div>
    <div class="py-2 px-3 h-20 bg-gray-50 shadow">
      <div class="px-5 w-full mx-auto h-full flex justify-center items-center bg-red-200 leading-15  rounded text-red-600 text-sm">
        <slot name="body" />
        <warning-button
          v-if="showWarningButton"
          @click="$emit('click')"
          class="ml-5">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path
              fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd" />
          </svg>
          <slot name="button-inner-text" />
        </warning-button>
      </div>
    </div>
  </div>
</template>

<script setup>
import WarningButton from '@/Components/WarningButton'

const props = defineProps({
  showWarningButton: {
    type: Boolean,
    default: true,
  },
})

const emit = defineEmits(['click'])
</script>
