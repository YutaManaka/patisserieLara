<script>
export default { name: 'CategoryIndex' }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import DataTable from '@/Components/DataTable'
import { Inertia } from '@inertiajs/inertia'
import PanelLayout from '@/Components/PanelLayout'
import SwitchButton from '@/Components/SwitchButton'
import WhiteButton from '@/Components/WhiteButton'

const props = defineProps({
  categories: {
    type: Object,
    required: true,
  },
  categoryLabels: {
    type: Object,
    required: true,
  },
  commonLabels: {
    type: Object,
    required: true,
  },
})

const headers = {
  img_url: props.commonLabels.img_url,
  name: props.commonLabels.name,
  order_start_time: props.categoryLabels.order_start_time,
  order_end_time: props.categoryLabels.order_end_time,
  sort_order: props.commonLabels.sort_order,
  disabled: props.categoryLabels.disabled,
}
const onRowClicked = (category) => {
  Inertia.get(route('category.show', {
    category: category.id,
  }))
  return
}
const onCreateClicked = () => {
  Inertia.get(route('category.create'))
}
const onCategoryDisabled = async (item) => {
  await Inertia.put(route('category.disabled', {
    category: item.id,
  }))
  window.scroll(0, 0)
}
</script>

<template>
  <app-layout>
    <panel-layout :title="categoryLabels.index_title">
      <div
        class="bg-white overflow-hidden shadow-xl"
      >
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
          <div class="w-full lg:w-5/6 px-2 lg:px-0">
            <div class="flex-none text-right pt-6">
              <div>
                <white-button
                  @click="onCreateClicked"
                >
                  カテゴリ新規作成
                </white-button>
              </div>
            </div>
            <div class="bg-white shadow-md rounded my-6">
              <data-table
                :headers="headers"
                :items="categories.data"
                no-data-text="カテゴリはありません"
                @row-click="onRowClicked"
              >
                <template #image_url="slotProps">
                  <td class="py-3 px-6 md:p-0 text-center whitespace-nowrap">
                    <img
                      :src="slotProps.item.image_url"
                      class="mx-auto shadow-lg rounded max-w-full h-auto align-middle border-none"
                      style="width:120px"
                    >
                  </td>
                </template>
                <template #disabled="{ item }">
                  <div class="flex justify-center items-center mt-8">
                    <switch-button
                      v-model="item.disabled"
                      is-color-changed
                      @change="onCategoryDisabled(item)"
                    />
                  </div>
                  <div
                    class="text-center font-bold"
                    :class="{ 'text-red-600': item.disabled, 'text-green-600': !item.disabled }"
                  >
                    {{ item.disabled ? '非表示': '表示中' }}
                  </div>
                </template>
              </data-table>
            </div>
          </div>
        </div>
      </div>
    </panel-layout>
  </app-layout>
</template>
