<script setup>
import { Inertia } from "@inertiajs/inertia"
import JetBanner from "@/Components/Banner"
import JetDropdown from "@/Components/Dropdown"
import JetDropdownLink from "@/Components/DropdownLink"
import FlashMessages from "@/Components/FlashMessages"

defineProps({
  cashRegisterValue: {
    type: Number,
    default: null,
  },
  isWebView: {
    type: Boolean,
    required: false,
    default: false,
  },
  isTransactionView: {
    type: Boolean,
    required: false,
    default: false,
  },
})

const onLogoClicked = () => Inertia.get(route('order'))
const logout = () => Inertia.post(route('logout'))

</script>

<template>
  <div>
    <jet-banner />
    <div class="min-h-screen bg-gray-100">
      <nav class="fixed w-full bg-white border-b border-gray-100 z-40">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center">
                <img
                  id="headerLogo"
                  src="/images/header-logo.png"
                  style="height: 50px"
                  @click="onLogoClicked()"
                >
              </div>

              <!-- Navigation Links -->
              <div
                class="hidden text-neutral-700 bg-white hover:text-neutral-900 space-x-8 sm:-my-px sm:ml-10 sm:flex"
              >
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                  <template
                    v-for="(menuItem, menuIndex) in $page.props.menuItems"
                    :key="`menu-${menuIndex}`"
                  >
                    <jet-dropdown>
                      <template #trigger>
                        <span class="inline-flex rounded-md">
                          <button
                            type="button"
                            class="inline-flex items-center px-6 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-neutral-700 bg-white hover:text-neutral-900 focus:outline-none transition ease-in-out duration-150"
                          >
                            {{ menuItem.name }}
                            <svg
                              class="ml-2 -mr-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                              />
                            </svg>
                          </button>
                        </span>
                      </template>
                      <template #content>
                        <jet-dropdown-link
                          v-for="(item, itemIndex) in menuItem.items"
                          :key="`item-${itemIndex}`"
                          :href="route(item.route)"
                        >
                          {{ item.name }}
                        </jet-dropdown-link>
                      </template>
                    </jet-dropdown>
                  </template>
                </div>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Settings Dropdown -->
              <div class="ml-3 relative">
                <jet-dropdown
                  align="right"
                  width="48"
                >
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-neutral-700 bg-white hover:text-neutral-900 focus:outline-none transition ease-in-out duration-150"
                      >
                        {{ $page.props.auth.user.name }}
                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>
                  <template #content>
                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <jet-dropdown-link as="button">
                        ログアウト
                      </jet-dropdown-link>
                    </form>
                  </template>
                </jet-dropdown>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main>
        <flash-messages :on="$page.props.flash" />
        <slot />
      </main>
    </div>
  </div>
</template>
