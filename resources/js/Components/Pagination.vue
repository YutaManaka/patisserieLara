<template>
  <ul
    v-if="paginate.last_page > 1"
    class="flex justify-center pl-0 list-none rounded my-2"
  >
    <li
      :class="{ 'bg-gray-200 pointer-events-none': paginate.current_page === 1, 'cursor-pointer' : paginate.current_page !== 1 }"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 ml-0 rounded-l hover:bg-gray-200"
      @click="$emit('page-previous', paginate.current_page - 1)"
    >
      <span class="page-link">前へ</span>
    </li>
    <li
      v-for="(page, index) in frontPageRange"
      :key="index"
      :class="{'bg-blue-500 text-white' : page === paginate.current_page , 'text-blue-700 hover:bg-gray-200' : page !== paginate.current_page }"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 border-r-0 cursor-pointer"
      @click="$emit('page-click', page)"
    >
      <span class="page-link">{{ page }}</span>
    </li>
    <li
      v-show="frontDot"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 border-r-0 disabled"
    >
      ...
    </li>
    <li
      v-for="(page, index) in middlePageRange"
      :key="index"
      :class="{'bg-blue-500 text-white' : page === paginate.current_page , 'text-blue-700 hover:bg-gray-200' : page !== paginate.current_page }"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 border-r-0 cursor-pointer"
      @click="$emit('page-click', page)"
    >
      <span class="page-link">{{ page }}</span>
    </li>
    <li
      v-show="endDot"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 border-r-0 disabled"
    >
      ...
    </li>
    <li
      v-for="(page, index) in endPageRange"
      :key="index"
      :class="{'bg-blue-500 text-white' : page === paginate.current_page , 'text-blue-700 hover:bg-gray-200' : page !== paginate.current_page }"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 border-r-0 cursor-pointer"
      @click="$emit('page-click', page)"
    >
      <span class="page-link">{{ page }}</span>
    </li>
    <li
      :class="{ 'bg-gray-200 pointer-events-none': paginate.current_page >= paginate.last_page, 'cursor-pointer' : paginate.current_page < paginate.last_page }"
      class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 rounded-r hover:bg-gray-200"
      @click="$emit('page-next', paginate.current_page + 1)"
    >
      <span class="page-link">次へ</span>
    </li>
  </ul>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  paginate: {
    type: Object,
    default: () => ({
      total: 0,
      per_page: 0,
      current_page: 0,
      last_page: 0,
      from: 0,
      to: 0,
      data: [],
    }),
  },
})

const emit = defineEmits(['page-click', 'page-next', 'page-previous'])

const paginateDefaultSize = ref(6)
const frontDot = ref(false)
const endDot = ref(false)
const calRange = (start, end) => {
  const range = []
  for (let i = start; i <= end; i += 1) {
    range.push(i)
  }
  return range
}
const showPaginateDot = (front, end) => {
  frontDot.value = front
  endDot.value = end
}
const paginateRange = ref(5)
const hasOverSixPages = computed(() => (props.paginate.last_page > paginateDefaultSize.value))
const frontPageRange = computed(() => (hasOverSixPages.value ? calRange(1, 2) : calRange(1, props.paginate.last_page)))
const middlePageRange = computed(() => {
  if (!hasOverSixPages.value) return []
  const page = {
    start: '',
    end: '',
  }
  if (props.paginate.current_page <= paginateRange.value) {
    page.start = 3
    page.end = paginateRange.value + 2
    showPaginateDot(false, true)
  } else if (props.paginate.current_page > props.paginate.last_page - paginateRange.value) {
    page.start = props.paginate.last_page - paginateRange.value - 1
    page.end = props.paginate.last_page - 2
    showPaginateDot(true, false)
  } else {
    page.start = props.paginate.current_page - Math.floor(paginateRange.value / 2)
    page.end = props.paginate.current_page + Math.floor(paginateRange.value / 2)
    showPaginateDot(true, true)
  }
  return calRange(page.start, page.end)
})
const endPageRange = computed(() => (hasOverSixPages.value ? calRange(props.paginate.last_page - 1, props.paginate.last_page) : []))
</script>

<style scoped>
.disabled {
  cursor: not-allowed;
}
</style>
