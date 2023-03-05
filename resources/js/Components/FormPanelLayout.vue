<template>
  <form @submit.prevent="$emit('submit')">
    <panel-layout :title="title">
      <validation-errors
        :errors="form.errors"
        class="bg-red-50 px-5 py-3"
      />
      <div class="px-4 py-5 bg-white shadow">
        <slot />
      </div>
      <template #action>
        <jet-secondary-button
          v-if="!form.wasSuccessful"
          type="button"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="$emit('back')"
        >
          戻る
        </jet-secondary-button>
        <jet-action-message
          :on="form.recentlySuccessful"
          class="mr-3 flex-1"
        >
          <span class="text-green-700 font-bold">
            保存しました。
          </span>
        </jet-action-message>
        <div class="mr-4">
          <slot
            v-if="!form.wasSuccessful"
            name="submitButton"
          >
            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              保存
            </jet-button>
          </slot>
          <jet-secondary-button
            v-else
            type="button"
            @click="$emit('back')"
          >
            戻る
          </jet-secondary-button>
        </div>
      </template>
    </panel-layout>
  </form>
</template>

<script setup>
import PanelLayout from '@/Components/PanelLayout'
import ValidationErrors from '@/Components/ValidationErrors'
import JetActionMessage from '@/Components/ActionMessage'
import JetButton from '@/Components/Button'
import JetSecondaryButton from '@/Components/SecondaryButton'

defineProps({
  isNew: {
    type: Boolean,
    default: false,
  },
  form: {
    type: Object,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
})

defineEmits(['submit', 'back'])
</script>
