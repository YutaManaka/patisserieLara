<template>
  <div class="w-full">
    <div class="flex relative">
      <label
        :for="id"
        class="block font-medium text-sm text-gray-700 whitespace-nowrap"
        :class="{ 'text-red-600': !!error }">
        {{ label }}
      </label>
      <slot name="help" />
    </div>
    <div class="flex flex-row">
      <slot name="before" />
      <input
        :id="id"
        :type="type"
        :value="modelValue"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        :class="{ 'bg-red-50': !!error, 'border-red-600': !!error, 'bg-gray-200' : $attrs.disabled }"
        v-bind="$attrs"
        @input="$emit('update:modelValue', $event.target.value)" />
      <slot name="after" />
    </div>
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
})

const emit = defineEmits(['update:modelValue'])
</script>

<style scoped>
input[type="number"],
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    -moz-appearance:textfield;
}
</style>
