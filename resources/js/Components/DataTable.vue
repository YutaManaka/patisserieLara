<template>
  <div
    class="scroll overflow-x-auto"
    :class="wrapperClass"
  >
    <table
      class="w-full table-auto whitespace-nowrap"
      :class="tableClass"
    >
      <thead>
        <tr
          class="bg-neutral-200 text-neutral-700 leading-normal"
          :class="trClass"
        >
          <th
            v-for="(title, key) in headers"
            :key="`header-${key}`"
            class="py-3 text-center"
            :class="thClass"
          >
            <span v-html="title" />
          </th>
        </tr>
      </thead>
      <tbody
        v-if="items.length > 0"
        class="text-neutral-700 text-sm font-light"
      >
        <tr
          v-for="(item, index) in items"
          :key="item.id"
          :class="tbodyTdClass"
          class="border-b border-gray-200"
          @click.stop="$emit('row-click', item)"
        >
          <template
            v-for="(title, key) in headers"
            :key="`row-${key}`"
          >
            <td
              class="text-center whitespace-nowrap"
              :class="tdClass"
            >
              <slot
                :name="key"
                :item="item"
                :index="index"
              >
                {{ item[key] }}
              </slot>
            </td>
          </template>
        </tr>
      </tbody>
      <tbody
        v-else-if="noDataText"
      >
        <tr
          class="border-b border-gray-200 hover:bg-gray-100"
        >
          <td
            :colspan="Object.keys(headers).length"
            class="py-3 px-6 text-center whitespace-nowrap pt-10 pb-10 text-gray-400 font-bold"
          >
            {{ noDataText }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  headers: {
    type: Object,
    required: true,
  },
  items: {
    type: Array,
    default: () => [],
  },
  noDataText: {
    type: String,
    default: '',
  },
  tdClass: {
    type: String,
    default: 'px-6 py-3',
  },
  thClass: {
    type: String,
    default: 'px-6',
  },
  trClass: {
    type: String,
    default: 'text-sm',
  },
  wrapperClass: {
    type: String,
    default: '',
  },
  tableClass: {
    type: String,
    default: '',
  },
  tbodyTdClass: {
    type: String,
    default: 'hover:bg-gray-100',
  },
})

defineEmits(['row-click'])
// const completed = item => (
//   item.transactions?.[0]?.completed_at ? { class: 'bg-gray-300' } : null
// )

</script>
