<script>
export default { name: 'OrderIndex' }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import ConfirmationModal from '@/Components/ConfirmationModal'
import DataTable from '@/Components/DataTable'
import { Inertia } from '@inertiajs/inertia'
import moment from 'moment'
import Pagination from '@/Components/Pagination'
import PanelLayout from '@/Components/PanelLayout'
import { ref } from 'vue'
import SecondaryButton from '@/Components/SecondaryButton'
import WhiteButton from '@/Components/WhiteButton'

const props = defineProps({
  orders: {
    type: Object,
    required: true,
  },
  orderLabels: {
    type: Object,
    required: true,
  },
})

const showConfirmationModal = ref(false)
const headers = {
  item_name: props.orderLabels.item_name,
  quantity: props.orderLabels.quantity,
  price: props.orderLabels.price,
  created_at: props.orderLabels.created_at,
  actions: props.orderLabels.actions,
}

const reload = window._.debounce(() => {
  Inertia.reload({
    only: ['orders'],
  })
  reload()
}, 10000)
reload()
const onReloadTransactionClicked = () => {
  reload()
}
const onPaginationChanged = (page) => {
  Inertia.get(route('order', {
    page,
  }))
}
const dateFormat = (date, format = 'Y/MM/DD') => {
  return !date
    ? ''
    : moment(date).format(format)
}
</script>

<template>
  <app-layout>
    <panel-layout
      :title="orderLabels.title"
    >
      <div
        class="bg-white overflow-hidden shadow-xl px-3"
      >
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
          <div class="w-full px-2 lg:px-0 ml-5 mr-5">
            <div class="flex">
              <div class="flex-grow" />
              <div class="flex-none mt-5 px-4 py-2 pr-8 ">
                <white-button @click="onReloadTransactionClicked">
                  更新
                </white-button>
              </div>
            </div>
            <div class="bg-white rounded my-6">
              <data-table
                :headers="headers"
                :items="orders.data"
                no-data-text="本日の注文はありません"
              >
                <template #order_no="{ item, index }">
                  <div
                    v-if="item.sequence === 1 || index === 0"
                    class="text-2xl rounded-md bg-gray-500 pl-1 pr-1 pt-1 pb-1 text-white font-bold"
                  >
                    {{ item.order_no }}
                  </div>
                </template>
                <template #price="{ item }">
                  <div>
                    <div class="text-right">
                      ¥{{ item.item?.price.toLocaleString() }}
                      <div class="text-sm">
                        ¥{{ item.tax?.toLocaleString() }}
                      </div>
                    </div>
                  </div>
                </template>
                <template #item_name="{ item }">
                  <div>
                    <div class="text-left">
                      <div class="font-bold">
                        {{ item.order_no }}-{{ item.sequence }}
                      </div>
                      <span class="text-lg">{{ item.item?.name }}</span>
                      <div class="text-sm">
                        {{ item.item?.code }}
                      </div>
                    </div>
                  </div>
                </template>
                <template #quantity="{ item }">
                  <div
                    class="text-2xl font-bold"
                  >
                    {{ item.quantity }}
                  </div>
                </template>
                <template #created_at="{ item }">
                  <div>
                    {{ dateFormat(item.created_at, 'HH:mm:ss') }}
                  </div>
                </template>
              </data-table>
            </div>
            <pagination
              :paginate="orders"
              @page-previous="onPaginationChanged"
              @page-next="onPaginationChanged"
              @page-click="onPaginationChanged"
            />
          </div>
        </div>
      </div>
    </panel-layout>
    <!-- レシート表示用モーダル -->
    <confirmation-modal
      :show="showConfirmationModal"
    >
      <template #title>
        レシート
      </template>
      <template #content>
        レシート内容
      </template>
      <template #footer>
        <secondary-button
          class="mr-4"
          @click="showConfirmationModal = false"
        >
          キャンセル
        </secondary-button>
      </template>
    </confirmation-modal>
  </app-layout>
</template>
