<template>
  <app-layout>
    <form-panel-layout
      :form="form"
      :title="categoryLabels.form_title"
      @back="onReturnClicked"
      @submit="onSubmitted">
      <div class="col-span-6">
        <input-control
          id="name"
          v-model="form.name"
          :label="categoryLabels.name"
          :error="form.errors.name"
          class="mt-1 block w-7/12" />
      </div>
      <div class="col-span-6 mt-6 flex flex-row">
        <div>
          <input-timepicker
            id="order_start_time"
            v-model="form.order_start_time"
            :label="categoryLabels.order_start_time"
            :error="form.errors.order_start_time"
            placeholder="00:00" />
        </div>
        <div class="ml-10">
          <input-timepicker
            id="order_end_time"
            v-model="form.order_end_time"
            :label="categoryLabels.order_end_time"
            :error="form.errors.order_end_time"
            placeholder="23:59" />
        </div>
      </div>
      <div class="col-span-2 mt-4">
        <input-control
          id="name"
          v-model="form.sort_order"
          :label="categoryLabels.sort_order"
          :error="form.errors.sort_order"
          class="mt-1 block w-3/12">
          <template #help>
            <tooltip
              :styleObject="{ top: '-4px', left: '250px', width: '500px' }">
              <template #content>
                <p class="m-1">メニュー選択画面で表示するカテゴリ表示順を設定。</p>
                <p class="m-1">数値が小さいほど先に表示される。</p>
              </template>
            </tooltip>
          </template>
        </input-control>
      </div>
      <div class="col-span-6 mt-6">
        <input
          ref="refImage"
          type="file"
          accept=".jpeg, .jpg, .png"
          class="hidden"
          @change="onImageChanged">
        <div class="flex relative">
          <jet-label
            for="photo"
            :value="categoryLabels.img_url" />
          <tooltip
            :styleObject="{ top: '-4px', left: '150px', width: '300px' }">
            <template #content>
              <p>画像の拡張子はjpeg、jpg、pngが可能。</p>
            </template>
          </tooltip>
        </div>
        <div>
          <img
            :src="imagePreview ?? imageUrl"
            :alt="category?.name"
            class="h-30 w-40 object-cover">
        </div>
        <jet-secondary-button
          class="mt-2 mr-2"
          type="button"
          @click.prevent="openFileView">
          画像追加
        </jet-secondary-button>
        <jet-input-error
          :message="form.errors.image"
          class="mt-2" />
      </div>
    </form-panel-layout>
    <warning-panel-layout
      v-if="!isNew"
      @click="showConfirmationModal = true">
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
      :show="showConfirmationModal">
      <template #title>
        アカウント削除
      </template>
      <template #content>
        「{{ form.name }}」を削除してもよろしいですか？
      </template>
      <template #footer>
        <jet-secondary-button
          class="mr-4"
          @click="showConfirmationModal = false">
          キャンセル
        </jet-secondary-button>
        <warning-button
          @click="onDeleteButtonClicked">
          削除
        </warning-button>
      </template>
    </confirmation-modal>
  </app-layout>
</template>

<script>
export default { name: 'CategoryForm' }
</script>

<script setup>
import {
  ref, computed, onMounted,
} from 'vue'
import AppLayout from '@/Layouts/AppLayout'
import ConfirmationModal from '@/Components/ConfirmationModal'
import FormPanelLayout from '@/Components/FormPanelLayout'
import { Inertia } from '@inertiajs/inertia'
import InputControl from '@/Components/InputControl'
import InputTimepicker from '@/Components/InputTimepicker'
import JetInputError from '@/Components/InputError'
import JetLabel from '@/Components/Label'
import JetSecondaryButton from '@/Components/SecondaryButton'
import preview from '@/actions/image/preview'
import Tooltip from '@/Components/Tooltip'
import { useForm } from '@inertiajs/vue3'
import WarningButton from '@/Components/WarningButton'
import WarningPanelLayout from '@/Components/WarningPanelLayout'

const props = defineProps({
  isNew: {
    type: Boolean,
    default: false,
  },
  category: {
    type: Object,
    default: () => {},
  },
  categories: {
    type: Object,
    required: true,
  },
  categoryLabels: {
    type: Object,
    required: true,
  },
})

const showConfirmationModal = ref(false)
const form = useForm({
  _method: 'POST',
  name: '',
  order_start_time: '00:00',
  order_end_time: '23:59',
  sort_order: 0,
  image: null,
})

const refImage = ref(null)
const imageUrl = computed(() => (props.isNew ? '' : props.category.img_url))
const onSubmitted = async () => {
  if (refImage.value) {
    [form.image] = refImage.value.files
  }
  if (props.isNew) {
    await form.post(route('category.store'))
  } else {
    await form.post(route('category.update', { category: props.category.id }))
  }
}
const { filePreview: imagePreview, openFileView, onFileChanged: onImageChanged } = preview(refImage)
const onReturnClicked = () => {
  Inertia.get(route('category'))
}
const onDeleteButtonClicked = async () => {
  await form.delete(route('category.destroy', { category: props.category.id }))
  showConfirmationModal.value = false
}

onMounted(() => {
  if (!props.isNew) {
    form._method = 'PUT' // eslint-disable-line no-underscore-dangle
    form.name = props.category.name
    form.order_start_time = props.category.order_start_time
    form.order_end_time = props.category.order_end_time
    form.sort_order = props.category.sort_order
    form.image = null
  }
})
</script>
