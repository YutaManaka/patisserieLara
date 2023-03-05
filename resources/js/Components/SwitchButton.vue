<template>
  <div
    :class="{ 'bg-cyan-700': inactiveColor, 'bg-blue-700': activeColor, 'cursor-not-allowed' : isCursorNotAllowed }"
    class="w-14 h-7 flex items-center bg-gray-300 rounded-full px-1"
    @click.stop="$emit('change', modelValue)"
  >
    <div
      class="bg-white w-5 h-5 rounded-full shadow-md transform"
      :class="{ 'translate-x-7': activeColor}"
    />
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: [Boolean, Number],
    required: true,
  },
  isColorChanged: {
    type: Boolean,
    default: false,
  },
  isCursorNotAllowed: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['change'])

const activeColor = computed(() => (props.isColorChanged ? !props.modelValue : props.modelValue))
const inactiveColor = computed(() => (props.isColorChanged ? props.modelValue : !props.modelValue))
</script>
