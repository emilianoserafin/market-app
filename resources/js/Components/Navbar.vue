<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Disclosure as="nav" class="bg-gray-700" v-slot="{ open }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <DisclosureButton
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          >
            <span class="sr-only">Open main menu</span>
            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>

        <!-- Desktop Menu -->
        <div
          class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start"
        >
          <ApplicationMark class="h-9 w-auto"> </ApplicationMark>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a href="#" :class="linkStyles">Shop</a>
              <a href="#" :class="linkStyles">Farms</a>
              <a href="#" :class="linkStyles">About</a>
              <Menu as="div" class="relative inline-block text-left">
                <div>
                  <MenuButton :class="linkStyles">
                    Become a Partner
                    <ChevronDownIcon
                      class="ml-2 -mr-1 h-5 w-5 text-violet-200 hover:text-violet-100 float-right"
                      aria-hidden="true"
                    />
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition duration-100 ease-out"
                  enter-from-class="transform scale-95 opacity-0"
                  enter-to-class="transform scale-100 opacity-100"
                  leave-active-class="transition duration-75 ease-in"
                  leave-from-class="transform scale-100 opacity-100"
                  leave-to-class="transform scale-95 opacity-0"
                >
                  <MenuItems
                    class="z-10 absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                  >
                    <div class="px-1 py-1">
                      <MenuItem v-slot="{ active }">
                        <a
                          href="#"
                          :class="[
                            active ? 'bg-gray-500 text-white' : 'text-gray-900',
                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                          ]"
                        >
                          Learn More
                        </a>
                      </MenuItem>
                      <MenuItem v-slot="{ active }">
                        <a
                          href="/register-farm"
                          :class="[
                            active ? 'bg-gray-500 text-white' : 'text-gray-900',
                            'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                          ]"
                        >
                          Register Your Farm
                        </a>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
        </div>
        <div class="justify-end">
          <slot name="right"></slot>
        </div>
      </div>
    </div>
    <!-- Mobile Menu -->
    <DisclosurePanel class="sm:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <DisclosureButton as="a" href="#" :class="mobileStyles"> Shop </DisclosureButton>
        <DisclosureButton as="a" href="#" :class="mobileStyles"> Farms </DisclosureButton>
        <DisclosureButton as="a" href="#" :class="mobileStyles"> About </DisclosureButton>

        <Disclosure v-slot="{ open }">
          <DisclosureButton :class="mobileStyles">
            <span>Become a Partner</span>
            <ChevronDownIcon
              :class="open ? 'rotate-180 transform' : ''"
              class="-mr-1 ml-2 h-5 w-5 inline"
            />
          </DisclosureButton>
          <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
            <DisclosureButton as="a" href="#" :class="mobileStyles">
              Learn More
            </DisclosureButton>
            <DisclosureButton as="a" href="/register-farm" :class="mobileStyles">
              Register Your Farm
            </DisclosureButton>
          </DisclosurePanel>
        </Disclosure>
        <slot name="accountOptions"></slot>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script setup>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { ChevronDownIcon, MenuIcon, XIcon } from "@heroicons/vue/outline";
import ApplicationMark from "../Jetstream/ApplicationMark.vue";

const linkStyles =
  "text-white hover:bg-gray-500 hover:text-white px-2 py-2 rounded-md text-sm font-medium";
const mobileStyles =
  "text-gray-300 hover:bg-gray-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
</script>

<style scoped></style>
