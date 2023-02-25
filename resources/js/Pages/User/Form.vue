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
      <div class="col-span-6 mt-4">
        <label
          for="permission"
          class="block font-medium text-sm text-gray-700">
          {{ userLabels.permission }}
        </label>
        <select
          id="permission"
          v-model.number="form.permission"
          class="appearance-none text-gray-600 bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded"
          @change="onChangedPermission">
          <option
            v-for="(permission, id) in permissions"
            :key="id"
            :value="id">
            {{ permission }}
          </option>
        </select>
      </div>
      <!-- <div
        v-if="tenants.length > 1 && form.permission >= 20 && form.permission <= 29"
        class="col-span-6 mt-4">
        <label
          for="permission"
          class="block font-medium text-sm text-gray-700">
          {{ userLabels.tenant }}
        </label>
        <select
          id="tenant"
          v-model="form.table_order_tenant_id"
          class="appearance-none text-gray-600 bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
          <option
            v-for="(tenant, id) in tenants"
            :key="id"
            :value="tenant.id">
            {{ tenant.name }}
          </option>
        </select>
      </div> -->

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
  ref, reactive, onMounted, computed,
} from 'vue'
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout'
import JetCheckbox from '@/Components/Checkbox'
import JetSecondaryButton from '@/Components/SecondaryButton'
import ConfirmationModal from '@/Components/ConfirmationModal'
import InputControl from '@/Components/InputControl'
import FormPanelLayout from '@/Components/FormPanelLayout'
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
  // tenants: {
  //   type: Array,
  //   required: true,
  // },
  // transactionPermissions: {
  //   type: Object,
  //   required: true,
  // },
  userLabels: {
    type: Object,
    required: true,
  },
})

const showConfirmationModal = ref(false)
const form = useForm({
  name: '',
  email: '',
  permission: 1,
  top_page_transition: 0,
  table_order_tenant_id: null,
  change_password: false,
  new_password: '',
})

// const isTenantUser = computed(() => form.permission >= 20 && form.permission <= 29)
const onSubmitted = async () => {
  // if (isTenantUser.value && props.tenants.length === 1) {
  //   form.table_order_tenant_id = props.tenants[0].id
  // }
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
const onChangedPermission = (e) => {
  if (props.permissions[e.target.value]  === 'レジ端末用ユーザー') {
    form.top_page_transition = 0
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
    form.top_page_transition = props.account.top_page_transition
    form.change_password = props.account.change_password
    form.table_order_tenant_id = props.account.table_order_tenant_id
    form.new_password = props.account.new_password
  }
})
</script>
