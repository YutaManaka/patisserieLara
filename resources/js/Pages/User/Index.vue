<template>
  <app-layout>
    <panel-layout :title="userLabels.index_title">
      <div class="bg-white overflow-hidden shadow-xl">
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
          <div class="w-full lg:w-5/6 px-2 lg:px-0">
            <div class="text-right pt-6">
              <white-button @click="onCreateClicked">アカウント新規作成</white-button>
            </div>
            <div class="bg-white shadow-md rounded my-6">
              <data-table
                :headers="headers"
                :items="users"
                @row-click="onRowClicked">
              </data-table>
            </div>
          </div>
        </div>
      </div>
    </panel-layout>
  </app-layout>
</template>

<script>
export default { name: 'UserIndex' }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import { Inertia } from '@inertiajs/inertia'
import PanelLayout from '@/Components/PanelLayout'
import WhiteButton from '@/Components/WhiteButton'
import DataTable from '@/Components/DataTable'

const props = defineProps({
  users: {
    type: Object,
    required: true,
  },
  userLabels: {
    type: Object,
    required: true,
  },
})

const headers = {
  name: props.userLabels.header_name,
  email: props.userLabels.header_email,
  permission_name: props.userLabels.header_permission_name,
}
const onRowClicked = (user) => {
  Inertia.get(route('user.show', {
    user: user.id,
  }))
}
const onCreateClicked = () => {
  Inertia.get(route('user.create'))
}
</script>
