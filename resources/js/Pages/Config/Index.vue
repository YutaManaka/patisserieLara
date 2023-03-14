<script>
export default { name: 'ConfigIndex' }
</script>

<script setup>
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout'
import PanelLayout from '@/Components/PanelLayout'
import WhiteButton from '@/Components/WhiteButton'
import DataTable from '@/Components/DataTable'
import Pagination from '@/Components/Pagination'

const props = defineProps({
  configs: {
    type: Object,
    required: true,
  },
  userPermission: {
    type: Number,
    required: true,
  },
  configLabels: {
    type: Object,
    required: true,
  },
})

const headers = {
  description: props.configLabels.description,
  value: props.configLabels.value,
}
const onRowClicked = (config) => {
  Inertia.get(route('config.show', {
    config: config.key,
  }))
}
const onCreateClicked = () => {
  Inertia.get(route('config.create'))
}
const onPaginationChanged  = (page) => {
  Inertia.get(route('config', {
    page,
  }))
}
</script>

<template>
  <app-layout>
    <panel-layout
      :title="configLabels.title"
    >
      <div class="bg-white overflow-hidden shadow-xl">
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
          <div class="w-full lg:w-5/6 px-2 lg:px-0">
            <div class="text-right pt-6">
              <white-button @click="onCreateClicked">
                新規登録
              </white-button>
            </div>
            <div class="bg-white shadow-md rounded my-6">
              <data-table
                :headers="headers"
                :items="configs.data"
                @row-click="onRowClicked"
              />
            </div>
            <div class="mb-5">
              <pagination
                :paginate="configs"
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
