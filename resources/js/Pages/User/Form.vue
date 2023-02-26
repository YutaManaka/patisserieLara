<template>
  <app-layout :user="user">
    <form-panel-layout
      :is-new="isNew"
      :form="form"
      :title="userLabels.form_title"
      @back="onReturnClicked"
      @submit="onSubmitted">
      <div class="col-span-6">
        <input-control
          id="name"
          v-model="form.name"
          :label="userLabels.name"
          :error="form.errors?.name"
          class="mt-1 block w-7/12" />
      </div>
      <div class="col-span-6">
        <input-control
          id="email"
          v-model="form.email"
          :label="userLabels.email"
          :error="form.errors?.email"
          class="mt-1 block w-7/12" />
      </div>
      <div class="col-span-6">
        <select-control
          v-model="form.permission"
          :label="userLabels.permission"
          :error="form.errors.permission"
          :options="permissions"
          class="mt-1 ">
        </select-control>
      </div>
      <label
        v-if="!isNew"
        class="flex items-center mt-5 mb-5">
        <jet-checkbox
          v-model:checked="form.change_password"
          name="remember" />
        <span class="ml-2 text-sm text-gray-600">パスワードを変更する</span>
      </label>
      <div
        v-if="form.change_password || isNew"
        class="col-span-6">
        <input-control
          id="new_password"
          type="text"
          v-model="form.new_password"
          :label="isNew ? 'パスワード' : '新しいパスワード'"
          :error="form.errors?.new_password"
          class="mt-1 block w-7/12" />
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
export default { name: 'UserForm' }
</script>

<script setup>
import {
  ref, onMounted,
} from 'vue'
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout'
import ConfirmationModal from '@/Components/ConfirmationModal'
import FormPanelLayout from '@/Components/FormPanelLayout'
import JetCheckbox from '@/Components/Checkbox'
import JetSecondaryButton from '@/Components/SecondaryButton'
import InputControl from '@/Components/InputControl'
import SelectControl from '@/Components/SelectControl'
import WarningButton from '@/Components/WarningButton'
import WarningPanelLayout from '@/Components/WarningPanelLayout'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  isNew: {
    type: Boolean,
    default: false,
  },
  user: {
    type: Object,
    default: () => {},
  },
  account: {
    type: Object,
    default: () => {},
  },
  permissions: {
    type: Object,
    required: true,
  },
  userLabels: {
    type: Object,
    required: true,
  },
})

const showConfirmationModal = ref(false)
const form = useForm({
  name: '',
  email: '',
  permission: null,
  change_password: false,
  new_password: '',
})

const onSubmitted = async () => {
  if (props.isNew) {
    await form.post(route('user.store'), {
      preserveScroll: true,
    })
  } else {
    await form.put(route('user.update', { user: props.account.id }), {
      preserveScroll: true,
    })
  }
}
const onReturnClicked = () => Inertia.visit(route('user'))
const onDeleteButtonClicked = async () => {
  await form.delete(route('user.destroy', { user: props.account.id }))
  showConfirmationModal.value = false
}
onMounted(() => {
  if (!props.isNew) {
    form.name = props.account.name
    form.email = props.account.email
    form.permission = props.account.permission
    form.change_password = props.account.change_password
    form.new_password = props.account.new_password
  }
})
</script>
