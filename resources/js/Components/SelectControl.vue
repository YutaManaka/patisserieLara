<template>
  <div class="w-full">
    <div class="flex relative">
      <label
        :for="id"
        class="block font-medium text-sm text-neutral-700"
        :class="{ 'text-red-600': !!error }"
      >
        {{ label }}
      </label>
      <slot name="help" />
    </div>
    <div class="flex">
      <slot name="before" />
      <select
        :id="id"
        v-model="value"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        :class="{ 'bg-red-50': !!error, 'border-red-600': !!error, 'bg-gray-200' : $attrs.disabled }"
        v-bind="$attrs"
      >
        <!-- optionsが連想配列かどうかを判定 -->
        <template v-if="typeof options[0] === 'object'">
          {{ options[0].value }}
          <option
            v-for="(option,key) in options"
            :key="key"
            :value="option.name"
            :selected="option.value === modelValue"
          >
            {{ option.name }}
          </option>
        </template>
        <template v-else>
          <option
            v-for="(option,key) in options"
            :key="key"
            :value="key"
            :selected="option === modelValue"
          >
            {{ option }}
          </option>
        </template>
      </select>
    </div>
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
export default { name: 'SelectControl' }
</script>

<script setup>
import { computed } from 'vue'
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
  label: {
    type: String,
    default: null,
  },
  options: {
    type: [Array, Object],
    required: true,
  },
})

const emit = defineEmits(['update:modelValue'])

const value = computed({
  get: () => props.modelValue,
  set: (val) => {
    emit('update:modelValue', val)
  },
})
</script>
