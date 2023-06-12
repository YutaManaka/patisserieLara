<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: {
      type: String,
      default: ''
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
  <Head title="ログイン" />

  <AuthenticationCard>
    <template #logo>
      <!-- <AuthenticationCardLogo /> -->
      <img
        id="headerLogo"
        src="/images/header-logo.png"
        style="height: 150px"
      >
    </template>

    <div
      v-if="status"
      class="mb-4 font-medium text-sm text-green-600"
    >
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel
          for="email"
          value="メールアドレス"
        />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="username"
        />
        <InputError
          class="mt-2"
          :message="form.errors.email"
        />
      </div>

      <div class="mt-4">
        <InputLabel
          for="password"
          value="パスワード"
        />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
        <InputError
          class="mt-2"
          :message="form.errors.password"
        />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox
            v-model:checked="form.remember"
            name="remember"
          />
          <span class="ml-2 text-sm text-gray-600">ログイン状態を保持する</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          ログイン
        </PrimaryButton>
      </div>
    </form>
  </AuthenticationCard>
</template>
