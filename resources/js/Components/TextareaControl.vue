<template>
  <div class="w-full">
    <div class="flex relative">
      <label
        :for="id"
        class="block font-medium text-sm text-gray-700"
        :class="{ 'text-red-600': !!error }">
        {{ label }}
      </label>
      <slot name="help" />
    </div>
    <textarea
      :id="id"
      :value="modelValue"
      class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
      :class="{ 'bg-red-50': !!error, 'border-red-600': !!error, 'bg-gray-200' : $attrs.disabled }"
      :rows="rows"
      @input="$emit('update:modelValue', $event.target.value)" />
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script setup>
const props = defineProps({
  modelValue: {
    type: [Number, String],
    required: false,
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
  rows: {
    type: String,
    default: '5',
  },
})

const emit = defineEmits(['update:modelValue'])
</script>
