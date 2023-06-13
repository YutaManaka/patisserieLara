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
import WarningButton from '@/Components/WarningButton'
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
  commonLabels: {
    type: Object,
    required: true,
  },
  totalPrice: {
    type: Number,
    required: true,
  },
})

const headers = {
  delivered: props.orderLabels.delivered,
  item_name: props.orderLabels.item_name,
  price: props.commonLabels.price,
  quantity: props.orderLabels.quantity,
  created_at: props.orderLabels.created_at,
  receipt: props.orderLabels.receipt,
}

const reload = window._.debounce(() => {
  Inertia.reload({
    only: ['orders'],
  })
  reload()
}, 30000)
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

// 提供済ボタン
const onDeliveredButtonClicked = item => {
  Inertia.put(route('order.set-orders-delivered', {
    order: item.id,
    previous_page: props.orders.current_page,
  }))
}

// 提供済になると見た目が変化
const switchButtonStyle = item => item.delivered_at
  ? 'bg-neutral-300 pointer-events-none'
  : ''
const switchTextStyle = item => item.delivered_at
  ? 'text-neutral-400 line-through'
  : ''

  // レシートボタン
const showReceiptModal = ref(false)
const onReceiptButtonClicked = (item) => {
  const a = props.orders.data.filter(order => order.order_no === item.order_no)
  axios.put(route('get-receipt'), {
    // order_noが同じ注文を取得
    orders: a
  })
  .then()
  showReceiptModal.value = true
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
              <div class="mt-8 text-xl font-bold">
                本日の売上 : {{ totalPrice.toLocaleString() }} 円(税込)
              </div>
              <div class="flex-grow" />
              <div class="flex-none mt-5 px-4 py-2 pr-8 ">
                <white-button
                  @click="onReloadTransactionClicked"
                >
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
                <template #delivered="{ item }">
                  <div v-if="item.sequence === 1">
                    <warning-button
                      :class="switchButtonStyle(item)"
                      @click="onDeliveredButtonClicked(item)"
                    >
                      <div class="text-xl">
                        済
                      </div>
                    </warning-button>
                  </div>
                </template>
                <template #item_name="{ item }">
                  <div :class="switchTextStyle(item)">
                    <div class="text-left">
                      <div class="font-bold">
                        {{ item.order_no }}-{{ item.sequence }}
                      </div>
                      <span class="text-sm">
                        ({{ item.item?.code }})
                      </span>
                      <span class="text-lg">
                        {{ item.item?.name }}
                      </span>
                    </div>
                  </div>
                </template>
                <template #price="{ item }">
                  <div :class="switchTextStyle(item)">
                    <div class="text-center">
                      ¥{{ item.item?.price.toLocaleString() }}
                    </div>
                  </div>
                </template>
                <template #quantity="{ item }">
                  <div
                    class="text-2xl font-bold"
                    :class="switchTextStyle(item)"
                  >
                    {{ item.quantity }}
                  </div>
                </template>
                <template #created_at="{ item }">
                  <div :class="switchTextStyle(item)">
                    {{ dateFormat(item.created_at, 'HH:mm:ss') }}
                  </div>
                </template>
                <template #receipt="{ item }">
                  <div v-if="item.sequence === 1">
                    <secondary-button
                      @click="onReceiptButtonClicked(item)"
                    >
                      レシート
                    </secondary-button>
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
      :show="showReceiptModal"
    >
      <template #icon>
        {{ '' }}
      </template>
      <template #title>
        レシート
      </template>
      <template #content>
        レシート内容
      </template>
      <template #footer>
        <secondary-button
          class="mr-4"
          @click="showReceiptModal = false"
        >
          キャンセル
        </secondary-button>
      </template>
    </confirmation-modal>
  </app-layout>
</template>
