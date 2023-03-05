<template>
  <button
    class="inline-flex items-center px-4 py-2 bg-red-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-red-800 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
    @click.stop="$emit('click')"
  >
    <slot />
  </button>
</template>

<script setup>
defineEmits(['click'])
</script>
