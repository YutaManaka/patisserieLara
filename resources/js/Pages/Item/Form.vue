<script>
export default { name: "ItemForm" }
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout"
import { computed, onMounted, ref } from "vue"
import ConfirmationModal from '@/Components/ConfirmationModal'
import FormPanelLayout from "@/Components/FormPanelLayout"
import { Inertia } from "@inertiajs/inertia"
import InputControl from "@/Components/InputControl"
import JetInputError from '@/Components/InputError'
import JetSecondaryButton from '@/Components/SecondaryButton'
import preview from "@/actions/image/preview"
import Tooltip from "@/Components/Tooltip"
import { useForm } from "@inertiajs/vue3"
import WarningButton from '@/Components/WarningButton'
import WarningPanelLayout from '@/Components/WarningPanelLayout'

const props = defineProps({
  isNew: {
    type: Boolean,
    default: false,
  },
  item: {
    type: Object,
    default: () => {},
  },
  categories: {
    type: Array,
    required: true,
  },
  itemLabels: {
    type: Object,
    required: true,
  },
  commonLabels: {
    type: Object,
    required: true,
  },
})
const showConfirmationModal = ref(false)
const form = useForm({
  _method: 'POST',
  category_ids: [],
  code: '',
  name: '',
  receipt_name: '',
  description: '',
  price: 0,
  tax: 0,
  tax_excluded_price: 0,
  image: null,
  sort_order: 0,
  disabled: 0,
})
const refImage = ref(null);
const imageUrl = computed(() => (props.isNew ? '' : props.item.img_url))
const onSubmitted = async () => {
  if (refImage.value) {
    [form.image] = refImage.value.files
  }
  if (props.isNew) {
    console.log('store')
    form.post(route('item.store'))
  } else {
    form.post(route('item.update', { item: props.item.id }))
  }
}
const {
  filePreview: imagePreview,
  openFileView,
  onFileChanged: onImageChanged,
} = preview(refImage)
const onReturnClicked = () => {
  Inertia.get(route('item'))
}
const onDeleteButtonClicked = async () => {
  form.delete(route('item.destroy', { item: props.item.id }))
  showConfirmationModal.value = false
}

onMounted(() => {
  if (!props.isNew) {
    form._method = 'PUT' // eslint-disable-line no-underscore-dangle
    form.category_ids = props.item.categories.map((category) => category.id)
    form.code = props.item.code
    form.name = props.item.name
    form.receipt_name = props.item.receipt_name || props.item.name.slice(0, 8)
    form.description = props.item.description
    form.price = props.item.price
    form.tax = props.item.tax
    form.tax_excluded_price = props.item.tax_excluded_price
    form.sort_order = props.item.sort_order
    form.disabled = props.item.disabled
  }
})
</script>

<template>
  <app-layout>
    <form-panel-layout
      :form="form"
      :title="itemLabels.form_title"
      @back="onReturnClicked"
      @submit="onSubmitted"
    >
      <div class="col-span-6 mt-6">
        <input
          ref="refImage"
          type="file"
          accept=".jpeg, .jpg, .png"
          class="hidden"
          @change="onImageChanged"
        >
        <div class="flex">
          <label class="block font-medium text-sm text-gray-700">
            {{ commonLabels.img_url }}
          </label>
          <tooltip :style-object="{ left: '250px', width: '300px' }">
            <template #content>
              <p>画像の拡張子はjpeg、jpg、pngが可能。</p>
            </template>
          </tooltip>
        </div>
        <div>
          <img
            :src="imagePreview ?? imageUrl"
            :alt="item?.name"
            class="h-52 w-80 object-cover"
          >
        </div>
        <jet-secondary-button
          class="mt-2 mr-2"
          type="button"
          @click.prevent="openFileView"
        >
          画像追加
        </jet-secondary-button>
        <jet-input-error
          :message="form.errors.photo"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 my-3">
        <input-control
          id="code"
          v-model="form.code"
          :label="commonLabels.code"
          :error="form.errors.code"
          class="mt-1 block w-2/12"
        />
      </div>
      <div class="col-span-6 my-3">
        <input-control
          id="name"
          v-model="form.name"
          :label="commonLabels.name"
          :error="form.errors.name"
          class="mt-1 block w-4/12"
        >
          <template #help>
            <tooltip :style-object="{ left: '300px', width: '400px' }">
              <template #content>
                <p class="m-1">
                  20文字まで表示可能。
                </p>
              </template>
            </tooltip>
          </template>
        </input-control>
      </div>
      <div class="col-span-6 my-3">
        <input-control
          id="description"
          v-model="form.description"
          :label="itemLabels.description"
          :error="form.errors.description"
          class="mt-1 block w-full"
        />
      </div>
      <div class="col-span-6 my-3">
        <input-control
          id="receipt_name"
          v-model="form.receipt_name"
          :label="commonLabels.receipt_name"
          :error="form.errors.receipt_name"
          maxlength="10"
          class="mt-1 block w-3/12"
        />
      </div>

      <div class="col-span-4 flex flex-row my-3">
        <div class="mr-10 w-2/12">
          <input-control
            id="price"
            v-model="form.price"
            :label="commonLabels.price"
            :error="form.errors.price"
            class="mt-1 block w-20"
          >
            <template #after>
              <p class="pl-2 pt-4 pr-2 text-sm whitespace-nowrap">
                円
              </p>
            </template>
          </input-control>
        </div>
        <div class="mr-10 w-2/12">
          <input-control
            id="tax"
            v-model="form.tax"
            :label="commonLabels.tax"
            :error="form.errors.tax"
            class="mt-1 block w-20"
          >
            <template #after>
              <p class="pl-2 pt-4 pr-2 text-sm whitespace-nowrap">
                円
              </p>
            </template>
          </input-control>
        </div>
        <div class="mr-10 w-2/12">
          <input-control
            id="tax_excluded_price"
            v-model="form.tax_excluded_price"
            :label="commonLabels.tax_excluded_price"
            :error="form.errors.tax_excluded_price"
            class="mt-1 block w-20"
          >
            <template #after>
              <p class="pl-2 pt-4 pr-2 text-sm whitespace-nowrap">
                円
              </p>
            </template>
          </input-control>
        </div>
      </div>

      <div class="col-span-6 mt-4">
        <label class="block font-medium text-sm text-gray-700">
          {{ itemLabels.category_ids }}
        </label>
        <div
          v-for="category in categories"
          :key="category.id"
          class="flex flex-row"
        >
          <input
            :id="`category_id_${category.id}`"
            v-model="form.category_ids"
            name="category_ids"
            type="checkbox"
            :value="category.id"
            class="ml-4 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          >
          <label
            :for="`category_id_${category.id}`"
            class="ml-1 block font-medium text-sm text-gray-700"
          >
            {{ category.name }}
          </label>
        </div>
      </div>
      <div class="col-span-4 flex flex-row mt-4">
        <div>
          <input-control
            id="sort_order"
            v-model="form.sort_order"
            :label="commonLabels.sort_order"
            :error="form.errors.sort_order"
            class="mt-1 block w-20"
          >
            <template #help>
              <tooltip :style-object="{ left: '300px', width: '500px' }">
                <template #content>
                  <p class="m-1">
                    メニュー選択画面で表示するメニューの順番を設定。
                  </p>
                  <p class="m-1">
                    数値が小さいほど先に表示される。
                  </p>
                </template>
              </tooltip>
            </template>
          </input-control>
        </div>
      </div>

      <div class="col-span-12 mt-10">
        <div class="flex flex-row">
          <input
            id="disabled"
            v-model="form.disabled"
            name="disabled"
            type="checkbox"
            :true-value="1"
            :false-value="0"
            class="circle border-gray-300 text-red-500 shadow-sm focus:border-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50"
          >
          <label
            for="disabled"
            class="ml-1 block font-medium text-sm text-gray-700"
          >
            {{ itemLabels.disabled }}
          </label>
        </div>
      </div>
    </form-panel-layout>
    <warning-panel-layout
      v-if="!isNew && item.categories.length === 0"
      @click="showConfirmationModal = true"
    >
      <template #title>
        <h3>削除</h3>
      </template>
      <template #body>
        この操作は元に戻すことはできません。
      </template>
      <template #button-inner-text>
        削除
      </template>
    </warning-panel-layout>
    <confirmation-modal
      :show="showConfirmationModal"
    >
      <template #title>
        商品削除
      </template>
      <template #content>
        「{{ form.name }}」を削除してもよろしいですか？
      </template>
      <template #footer>
        <jet-secondary-button
          class="mr-4"
          @click="showConfirmationModal = false"
        >
          キャンセル
        </jet-secondary-button>
        <warning-button
          @click="onDeleteButtonClicked"
        >
          削除
        </warning-button>
      </template>
    </confirmation-modal>
  </app-layout>
</template>
