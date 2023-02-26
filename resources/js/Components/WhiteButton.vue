<template>
  <button
    v-bind="$attrs"
    :class="{ 'bg-gray-300' : $attrs.disabled }"
    class="disabled:opacity-50 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-neutral-700 uppercase tracking-widest shadow-sm hover:text-neutral-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-neutral-800 active:bg-gray-50 transition ease-in-out duration-150">
    <slot></slot>
  </button>
</template>
