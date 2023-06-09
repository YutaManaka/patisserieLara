<script>
export default { name: "ItemIndex" }
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout"
import { computed, ref } from "vue"
import { Inertia } from "@inertiajs/inertia"
import PanelLayout from "@/Components/PanelLayout"
import Tooltip from "@/Components/Tooltip"
import WhiteButton from '@/Components/WhiteButton'

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
  itemLabels: {
    type: Object,
    required: true,
  },
})

const isUncategorized = computed(() => (categoryName) =>
  categoryName === props.categories[0].name
)
const onCreateClicked = () => {
  Inertia.get(route('item.create'))
}
const onItemEditClicked = (item) => {
  Inertia.get(route("item.show", { item: item.id }))
}
const expandUnCategorizedStatus = ref(false)
const toggleUnCategorizedItems = () => {
  expandUnCategorizedStatus.value = !expandUnCategorizedStatus.value
}
</script>

<template>
  <app-layout>
    <panel-layout :title="itemLabels.index_title">
      <div class="bg-white overflow-hidden shadow-xl">
        <div class="w-full pt-2 pb-8">
          <div class="flex-none pr-8 text-right">
            <div>
              <white-button
                @click="onCreateClicked"
              >
                商品新規作成
              </white-button>
            </div>
          </div>
          <div class="table-fixed flex flex-wrap pl-5 pt-2 pr-5">
            <div
              v-for="category in categories"
              :key="category.key"
            >
              <a
                :href="`#category-${category.id}`"
                class="text-lg flex flew-row hover:bg-indigo-600 hover:text-blue-50 text-indigo-700 pr-5"
              >
                <svg
                  class="w-6 h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 13l-7 7-7-7m14-8l-7 7-7-7"
                  />
                </svg>
                {{ category.name }}
              </a>
            </div>
          </div>
          <div>
            <div
              v-for="category in categories"
              :key="category.key"
              class="pt-5"
            >
              <a :href="`#category-${category.id}`" />
              <div
                :id="`category-${category.id}`"
                class="flex relative"
              >
                <h1 class="text-2xl font-bold ml-5 mt-8 mb-0">
                  {{ category.name }}
                </h1>
                <tooltip
                  v-if="isUncategorized(category.name)"
                  class="pt-8"
                  :style-object="{ top: '60px', left: '20%', width: '300px' }"
                >
                  <template #content>
                    <p>未分類の商品はアプリに表示されない。</p>
                  </template>
                </tooltip>
              </div>
              <div
                v-if="
                  category.items?.length > 0 &&
                    isUncategorized(category.name) &&
                    !expandUnCategorizedStatus
                "
                class="flex flex-wrap container mx-auto my-auto bg-pink-200 ml-5 mr-10"
              >
                <span
                  class="px-5 py-2"
                  @click.prevent="toggleUnCategorizedItems()"
                >
                  <button
                    class="bg-pink-400 hover:bg-pink-400 text-pink-900 font-bold py-2 px-4 rounded inline-flex items-center"
                  >
                    <svg
                      class="fill-current w-4 h-4 mr-2"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                    </svg>
                    <span> {{ category.items?.length }}個の未分類商品を表示する </span>
                  </button>
                </span>
              </div>
              <div
                v-if="category.items?.length <= 0"
                class="flex flex-wrap container mx-auto my-auto m-10 p-10"
              >
                このカテゴリに商品はありません。
              </div>
              <div>
                <div
                  v-if="!isUncategorized(category.name) || expandUnCategorizedStatus"
                  class="flex flex-wrap container mx-auto my-auto"
                  :class="{ 'bg-pink-200': !category.id }"
                >
                  <div
                    v-for="item in category.items"
                    :key="item.key"
                    class="shadow-md hover:shadow-lg hover:bg-gray-100 rounded-lg bg-white my-12 mx-5"
                  >
                    <img
                      :src="item.img_url"
                      class="overflow-hidden max-h-40 ml-auto mr-auto"
                    >
                    <div class="p-1 md:p-2 lg:p-4">
                      <p
                        class="text-justify text-lg text-black md:font-bold text-gray-900"
                      >
                        [{{ item.code }}] {{ item.name }}
                      </p>
                      <div class="flex flex-wrap gap-1">
                        <div
                          v-if="item.disabled"
                          class="items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-gray-600 rounded-full"
                        >
                          非表示
                        </div>
                      </div>
                      <div class="flex flex-wrap gap-1">
                        <div v-if="item.order_start_date || item.order_end_date">
                          <span
                            class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-yellow-500 rounded-full"
                          >
                            期間限定
                          </span>
                        </div>
                      </div>
                      <div class="ml-1 text-gray-500 text-sm">
                        表示順 {{ item.sort_order }}
                      </div>

                      <div class="flex mt-5">
                        <div class="flex-grow" />
                        <div
                          v-if="category.name !== '保管庫'"
                          class="flex-none text-sm ml-auto mr-0 hover:bg-gray-700 focus rounded py-1.5 px-3 font-semibold cursor-pointer hover:text-white bg-gray-400 text-gray-100"
                          @click.prevent="onItemEditClicked(item)"
                        >
                          編集
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    v-if="isUncategorized(category.name) && expandUnCategorizedStatus"
                    class="flex flex-wrap container mx-auto my-auto bg-pink-200 mr-3"
                  >
                    <span class="flex-grow" />
                    <span
                      class="px-5 py-2"
                      @click.prevent="toggleUnCategorizedItems"
                    >
                      <button
                        class="bg-pink-400 hover:bg-pink-400 text-pink-900 font-bold py-2 px-4 rounded inline-flex items-center"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-5 w-5"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                          />
                        </svg>
                        <span> {{ category.items.length }}個の未分類商品を隠す </span>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </panel-layout>
  </app-layout>
</template>
