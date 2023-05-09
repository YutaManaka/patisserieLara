<script>
export default { name: 'ConfigForm' }
</script>

<script setup>
import {
  ref, onMounted,
} from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout'
import ConfirmationModal from '@/Components/ConfirmationModal'
import FormPanelLayout from '@/Components/FormPanelLayout'
import InputControl from '@/Components/InputControl'
import InputTimepicker from '@/Components/InputTimepicker'
import JetSecondaryButton from '@/Components/SecondaryButton'
import SelectControl from '@/Components/SelectControl'
import TextareaControl from '@/Components/TextareaControl'
import WarningButton from '@/Components/WarningButton'
import WarningPanelLayout from '@/Components/WarningPanelLayout'

const props = defineProps({
  config: {
    type: Object,
    default: () => {},
  },
  userPermission: {
    type: Number,
    required: true,
  },
  permissionSystem: {
    type: Number,
    required: true,
  },
  configLabels: {
    type: Object,
    required: true,
  },
})

// const types = [
//   { name: '文字列', value: 'string' },
//   { name: '数値', value: 'int' },
//   { name: 'URL', value: 'url' },
//   { name: '時間', value: 'time' }
// ]

const types = [
  { name: '文字列', value: 'string' },
  { name: '数値', value: 'int' },
  { name: 'URL', value: 'url' },
  { name: '時間', value: 'time' }
]

const showConfirmationModal = ref(false)
const form = useForm({
  key: '',
  value: '',
  type: 'string',
  description: '',
})
const onSubmitted = async () => {
  if (!props.config) {
    await form.post(route('config.store'), {
      preserveScroll: true,
    })
  } else {
    await form.put(route('config.update', { config: props.config.key }), {
      preserveScroll: true,
    })
  }
}
const onReturnClicked = () => {
  Inertia.get(route('config'))
}
const onDeleteButtonClicked = async () => {
  await form.delete(route('config.destroy', { config: props.config.key }))
  showConfirmationModal.value = false
}
const isSystemOrRoot = props.userPermission >= props.permissionSystem

onMounted(() => {
  if (props.config) {
    form.key = props.config.key
    form.type = props.config.type
    form.value = props.config.value
    form.description = props.config.description
  }
})
</script>

<template>
  <app-layout>
    <form-panel-layout
      :is-new="!!props.config"
      :form="form"
      :title="configLabels.title"
      @back="onReturnClicked"
      @submit="onSubmitted"
    >
      <div class="col-span-6">
        <input-control
          v-if="isSystemOrRoot"
          id="key"
          v-model="form.key"
          label="キー"
          :error="form.errors.key"
          class="mt-1 block w-7/12"
        />
      </div>
      <div class="col-span-6">
        <select-control
          v-if="isSystemOrRoot"
          v-model="form.type"
          :label="configLabels.type"
          :error="form.errors.type"
          :options="types"
          class="mt-1 w-4/12"
        />
      </div>
      <div class="col-span-6">
        <input-control
          id="description"
          v-model="form.description"
          :label="configLabels.description"
          :error="form.errors.description"
          class="mt-1 block w-9/12"
        />
      </div>
      <div class="col-span-6">
        <input-timepicker
          v-if="form.type === 'time'"
          id="time"
          v-model="form.value"
          :class="{'mt-1' : form.type === 'time' }"
          :label="configLabels.value"
          :error="form.errors.value"
          placeholder="00:00"
        />
        <textarea-control
          v-else
          id="value"
          v-model="form.value"
          :label="configLabels.value"
          :error="form.errors.value"
          rows="3"
          cols="50"
          size="9"
          maxlength="500"
          class="mt-1 block w-full"
        />
      </div>
    </form-panel-layout>
    <warning-panel-layout
      v-if="props.config"
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
        設定値削除
      </template>
      <template #content>
        「{{ form.key }}」を削除してもよろしいですか？
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
