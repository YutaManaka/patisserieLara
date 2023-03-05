<template>
  <div class="mx-auto pt-20 pb-10 px-8">
    <div
      class="bg-neutral-700 text-gray-50 font-bold text-2xl py-3 px-3 flex"
      :class="h1Hidden"
    >
      <h1>{{ title }}</h1>
      <slot name="help" />
    </div>
    <slot />
    <div
      v-if="$slots.action"
      class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right shadow"
    >
      <slot name="action" />
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
