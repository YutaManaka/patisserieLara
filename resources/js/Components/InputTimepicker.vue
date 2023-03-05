<template>
  <div class="w-full">
    <div
      class="flex relative"
    >
      <label
        :for="id"
        class="mb-1 block font-medium text-sm text-gray-700"
        :class="{ 'text-red-600': !!error }"
      >
        {{ label }}
      </label>
      <slot name="help" />
    </div>
    <vue-timepicker
      :model-value="modelValue"
      input-width="100px"
      :input-class="['rounded-md', {'bg-red-50': !!error, 'invalid': !!error }]"
      placeholder="00:00"
      hour-label="時間"
      minute-label="分"
      second-label="秒"
      :format="format"
      auto-scroll
      manual-input
      advanced-keyboard
      :minute-interval="minuteInterval"
      @change="updateValue($event)"
    />
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script setup>
import VueTimepicker from 'vue3-timepicker'
import 'vue3-timepicker/dist/VueTimepicker.css'

defineProps({
  modelValue: {
    type: [Number, String],
    required: false,
    default: '',
  },
  inputWidth: {
    type: String,
    default: '120px',
  },
  placeholder: {
    type: String,
    default: '',
  },
  error: {
    type: String,
    default: null,
  },
  id: {
    type: String,
    default: 'id',
  },
  type: {
    type: String,
    default: 'text',
  },
  label: {
    type: String,
    default: null,
  },
  minuteInterval: {
    type: String,
    default: '1',
  },
  format: {
    type: String,
    default: 'HH:mm',
  },
})

const emit = defineEmits(['update:modelValue'])

const updateValue = (e) => emit('update:modelValue', e.displayTime)
</script>
