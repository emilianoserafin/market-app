<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import RegisterModal from "../Components/RegisterModal.vue";
import LoginModal from "../Components/LoginModal.vue";
import Navbar from "../Components/Navbar.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  canResetPassword: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

const logout = () => {
  Inertia.post(route("logout"));
  location.reload();
};
</script>

<template>
  <Head title="Welcome" />
  <Navbar>
    <template #right>
      <div v-if="canLogin" class="hidden sm:flex">
        <div v-if="$page.props.user" class="flex">
          <Link
            :href="route('dashboard')"
            class="text-white text-left hover:bg-gray-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium mx-2"
          >
            Dashboard
          </Link>
          <form @click="logout">
            <Link
              as="button"
              class="sm:text-white text-left hover:bg-gray-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium mx-2"
            >
              Log Out
            </Link>
          </form>
        </div>

        <div v-else>
          <LoginModal>Log In</LoginModal>
          <RegisterModal>Register</RegisterModal>
        </div>
      </div>

      <Menu as="div" class="sm:hidden relative inline-block text-left">
        <div>
          <MenuButton
            class="inline-flex justify-center w-full rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-700 text-sm font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
          >
            Account
            <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
          </MenuButton>
        </div>

        <transition
          enter-active-class="transition ease-out duration-100"
          enter-from-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-75"
          leave-from-class="transform opacity-100 scale-100"
          leave-to-class="transform opacity-0 scale-95"
        >
          <MenuItems
            v-if="canLogin"
            class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
          >
            <div v-if="$page.props.user" class="py-1">
              <MenuItem v-slot="{ active }">
                <a
                  :href="route('dashboard')"
                  :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']"
                  class="text-left w-full text-gray-700"
                  >Dashboard</a
                >
              </MenuItem>
              <MenuItem v-slot="{ active }">
                <form @click="logout">
                  <Link
                    as="button"
                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']"
                    class="text-left w-full text-gray-700"
                  >
                    Log Out
                  </Link>
                </form>
              </MenuItem>
            </div>
            <div v-else class="py-1 flex flex-col">
              <MenuItem v-slot="{ active }">
                <a
                  :href="route('register')"
                  :class="[
                    active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                    'block px-4 py-2 text-sm',
                  ]"
                  >Register</a
                >
              </MenuItem>
              <MenuItem v-slot="{ active }">
                <a
                  :href="route('login')"
                  :class="[
                    active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                    'block px-4 py-2 text-sm',
                  ]"
                  >Log In</a
                >
              </MenuItem>
            </div>
          </MenuItems>
        </transition>
      </Menu>
    </template>
    <!-- Login, Register, Dashboard access on Mobile -->
    <template #accountOptions></template>
  </Navbar>

  <div
    class="relative flex items-top justify-center min-h-screen bg-gray-300 sm:items-center sm:pt-0"
  ></div>
</template>

<style scoped>
.bg-gray-100 {
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
  border-color: #edf2f7;
  border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
  color: #cbd5e0;
  color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
  color: #a0aec0;
  color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
  color: #718096;
  color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
  color: #4a5568;
  color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
  color: #1a202c;
  color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #2d3748;
    background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
  }

  .dark\:bg-gray-900 {
    background-color: #1a202c;
    background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
  }

  .dark\:border-gray-700 {
    border-color: #4a5568;
    border-color: rgba(74, 85, 104, var(--tw-border-opacity));
  }

  .dark\:text-white {
    color: #fff;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
  }

  .dark\:text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
  }
}
</style>
