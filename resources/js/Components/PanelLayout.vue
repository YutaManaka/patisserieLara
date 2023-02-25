<template>
  <div class="mx-auto pt-20 pb-10 px-8">
    <div
      class="border-red-700 bg-gray-600 text-gray-50 font-bold text-2xl border-l-8 py-3 px-3 flex"
      :class="h1Hidden">
      <h1>{{ title }}</h1>
      <slot name="help"></slot>
    </div>
    <slot></slot>
    <div
      v-if="$slots.action"
      class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right shadow">
      <slot name="action"></slot>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  h1Hidden: {
    type: String,
    default: '',
  },
})
</script>
