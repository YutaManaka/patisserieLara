<script>
export default { name: 'UserIndex' }
</script>

<script setup>

import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout'
import DataTable from '@/Components/DataTable'
import Pagination from '@/Components/Pagination'
import PanelLayout from '@/Components/PanelLayout'
import WhiteButton from '@/Components/WhiteButton'

const props = defineProps({
  users: {
    type: Object,
    required: true,
  },
  userLabels: {
    type: Object,
    required: true,
  },
  permissions: {
    type: Object,
    required: true,
  },
})

const headers = {
  name: props.userLabels.name,
  email: props.userLabels.email,
  permission: props.userLabels.permission,
}
const switchPermissionName = (permission) => {
    return props.permissions[permission]
}
const onRowClicked = (user) => {
  Inertia.get(route('user.show', {
    user: user.id,
  }))
}
const onCreateClicked = () => {
  Inertia.get(route('user.create'))
}
const onPaginationChanged = (page) => {
  Inertia.get(route('user', {
    page,
  }))
}
</script>

<template>
  <app-layout>
    <panel-layout :title="userLabels.index_title">
      <div class="bg-white overflow-hidden shadow-xl">
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
          <div class="w-full lg:w-5/6 px-2 lg:px-0">
            <div class="text-right pt-6">
              <white-button @click="onCreateClicked">
                アカウント新規作成
              </white-button>
            </div>
            <div class="bg-white shadow-md rounded my-6">
              <data-table
                :headers="headers"
                :items="users.data"
                @row-click="onRowClicked"
              >
                <template #permission="{ item }">
                  {{ switchPermissionName(item.permission) }}
                </template>
              </data-table>
            </div>
            <div class="mb-5">
              <pagination
                :paginate="users"
                @page-previous="onPaginationChanged"
                @page-next="onPaginationChanged"
                @page-click="onPaginationChanged"
              />
            </div>
          </div>
        </div>
      </div>
    </panel-layout>
  </app-layout>
</template>
