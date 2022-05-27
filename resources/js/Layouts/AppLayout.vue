<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import Navbar from "../Components/Navbar.vue";
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

defineProps({
  title: String,
});

const mobileStyles =
  "text-gray-300 hover:bg-gray-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium";

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  Inertia.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  Inertia.post(route("logout"));
};
</script>

<template>
  <Head :title="title" />

  <JetBanner />

  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <Navbar>
        <template #right>
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div v-if="$page.props.user.role !== 'customer'">
                  <div class="ml-3 relative">
                    <!-- Teams Dropdown -->
                    <JetDropdown
                      v-if="$page.props.jetstream.hasTeamFeatures"
                      align="right"
                      width="60"
                    >
                      <template #trigger>
                        <span class="inline-flex rounded-md">
                          <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                          >
                            {{ $page.props.user.current_team.name }}

                            <svg
                              class="ml-2 -mr-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                              />
                            </svg>
                          </button>
                        </span>
                      </template>

                      <template #content>
                        <div class="w-60">
                          <!-- Team Management -->
                          <template v-if="$page.props.jetstream.hasTeamFeatures">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                              Manage Team
                            </div>

                            <!-- Team Settings -->
                            <JetDropdownLink
                              :href="route('teams.show', $page.props.user.current_team)"
                            >
                              Team Settings
                            </JetDropdownLink>

                            <JetDropdownLink
                              v-if="$page.props.jetstream.canCreateTeams"
                              :href="route('teams.create')"
                            >
                              Create New Team
                            </JetDropdownLink>

                            <div class="border-t border-gray-100" />

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                              Switch Teams
                            </div>

                            <template
                              v-for="team in $page.props.user.all_teams"
                              :key="team.id"
                            >
                              <form @submit.prevent="switchToTeam(team)">
                                <JetDropdownLink as="button">
                                  <div class="flex items-center">
                                    <svg
                                      v-if="team.id == $page.props.user.current_team_id"
                                      class="mr-2 h-5 w-5 text-green-400"
                                      fill="none"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      stroke="currentColor"
                                      viewBox="0 0 24 24"
                                    >
                                      <path
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                      />
                                    </svg>
                                    <div>{{ team.name }}</div>
                                  </div>
                                </JetDropdownLink>
                              </form>
                            </template>
                          </template>
                        </div>
                      </template>
                    </JetDropdown>
                  </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                  <JetDropdown align="right" width="48">
                    <template #trigger>
                      <button
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                      >
                        <img
                          class="h-8 w-8 rounded-full object-cover"
                          :src="$page.props.user.profile_photo_url"
                          :alt="$page.props.user.name"
                        />
                      </button>

                      <span v-else class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                        >
                          {{ $page.props.user.name }}

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
                      <!-- Account Management -->
                      <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Account
                      </div>
                      <JetDropdownLink :href="route('dashboard')">
                        Dashboard
                      </JetDropdownLink>

                      <JetDropdownLink :href="route('profile.show')">
                        Profile
                      </JetDropdownLink>
                      <JetDropdownLink href="#"> Orders </JetDropdownLink>

                      <JetDropdownLink
                        v-if="$page.props.jetstream.hasApiFeatures"
                        :href="route('api-tokens.index')"
                      >
                        API Tokens
                      </JetDropdownLink>

                      <div class="border-t border-gray-100" />

                      <!-- Authentication -->
                      <form @submit.prevent="logout">
                        <JetDropdownLink as="button"> Log Out </JetDropdownLink>
                      </form>
                    </template>
                  </JetDropdown>
                </div>
              </div>
            </div>
          </div>
        </template>
        <!-- Responsive Navigation Menu -->
        <template #accountOptions>
          <div class="pb-3 space-y-1">
            <DisclosureButton
              class="text-gray-300 hover:bg-gray-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </DisclosureButton>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-2 pb-1 border-t border-gray-200">
            <Disclosure v-slot="{ open }">
              <DisclosureButton :class="mobileStyles">
                <span>Account Settings</span>
                <ChevronDownIcon
                  :class="open ? 'rotate-180 transform' : ''"
                  class="-mr-1 ml-2 h-5 w-5 inline"
                />
              </DisclosureButton>
              <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
                <div>
                  <div class="font-medium text-base text-gray-400">
                    {{ $page.props.user.name }}
                  </div>
                  <div class="font-medium text-sm text-gray-500">
                    {{ $page.props.user.email }}
                  </div>
                </div>
                <DisclosureButton
                  as="a"
                  :href="route('profile.show')"
                  :active="route().current('profile.show')"
                  :class="mobileStyles"
                >
                  Profile
                </DisclosureButton>
                <DisclosureButton as="a" href="#" :class="mobileStyles">
                  Orders
                </DisclosureButton>
              </DisclosurePanel>
            </Disclosure>
            <div class="flex items-center px-4">
              <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="shrink-0 mr-3"
              >
                <img
                  class="h-10 w-10 rounded-full object-cover"
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                />
              </div>
            </div>

            <div class="space-y-1">
              <JetResponsiveNavLink
                v-if="$page.props.jetstream.hasApiFeatures"
                :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')"
              >
                API Tokens
              </JetResponsiveNavLink>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <button :class="mobileStyles">Log Out</button>
              </form>

              <!-- Team Management -->
              <div v-if="$page.props.user.role !== 'customer'">
                <template v-if="$page.props.jetstream.hasTeamFeatures">
                  <div class="border-t border-gray-200" />

                  <Disclosure v-slot="{ open }">
                    <DisclosureButton :class="mobileStyles">
                      <span>Manage Team</span>
                      <ChevronDownIcon
                        :class="open ? 'rotate-180 transform' : ''"
                        class="-mr-1 ml-2 h-5 w-5 inline"
                      />
                    </DisclosureButton>
                    <!-- Team Settings -->
                    <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
                      <DisclosureButton
                        as="a"
                        :href="route('teams.show', $page.props.user.current_team)"
                        :active="route().current('teams.show')"
                        :class="mobileStyles"
                      >
                        Team Settings
                      </DisclosureButton>
                      <DisclosureButton
                        v-if="$page.props.jetstream.canCreateTeams"
                        as="a"
                        :href="route('teams.create')"
                        :active="route().current('teams.create')"
                        :class="mobileStyles"
                      >
                        Create New Team
                      </DisclosureButton>
                      <!-- Team Switcher -->
                      <div class="block px-4 py-2 text-xs text-gray-300">
                        Switch Teams
                      </div>
                      <template v-for="team in $page.props.user.all_teams" :key="team.id">
                        <form @submit.prevent="switchToTeam(team)">
                          <JetResponsiveNavLink as="button">
                            <div class="flex items-center ml-1">
                              <svg
                                v-if="team.id == $page.props.user.current_team_id"
                                class="absolute mr-3 -ml-2 h-5 w-5 text-green-400"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                              >
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                              <div class="text-gray-300 ml-4">{{ team.name }}</div>
                            </div>
                          </JetResponsiveNavLink>
                        </form>
                      </template>
                    </DisclosurePanel>
                  </Disclosure>
                </template>
              </div>
            </div>
          </div>
        </template>
      </Navbar>
    </nav>

    <!-- Page Heading -->
    <header v-if="$slots.header" class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>

    <!-- Page Content -->
    <main>
      <slot />
    </main>
  </div>
</template>
