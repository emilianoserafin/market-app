<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <button
    type="button"
    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
    @click="open = true"
  >
    <slot />
  </button>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed z-10 inset-0 overflow-y-auto">
        <div
          class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <DialogPanel
              class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full"
            >
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-center">
                  <div class="mt-3 sm:mt-0 w-full">
                    <DialogTitle
                      as="h3"
                      class="text-lg leading-6 font-medium text-gray-900"
                    >
                      Create Account
                    </DialogTitle>
                    <div class="mt-2 text-left">
                      <jet-validation-errors class="mb-4" />

                      <form @submit.prevent="submit">
                        <div>
                          <jet-label for="name" value="Name" />
                          <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                          />
                        </div>

                        <div class="mt-4">
                          <jet-label for="email" value="Email" />
                          <jet-input
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                          />
                        </div>

                        <div class="mt-4">
                          <jet-label for="password" value="Password" />
                          <jet-input
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                          />
                        </div>

                        <div class="mt-4">
                          <jet-label
                            for="password_confirmation"
                            value="Confirm Password"
                          />
                          <jet-input
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                          />
                        </div>

                        <div
                          class="mt-4"
                          v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                        >
                          <jet-label for="terms">
                            <div class="flex items-center">
                              <jet-checkbox
                                name="terms"
                                id="terms"
                                v-model="form.terms"
                              />

                              <div class="ml-2">
                                I agree to the
                                <a
                                  target="_blank"
                                  :href="route('terms.show')"
                                  class="underline text-sm text-gray-600 hover:text-gray-900"
                                  >Terms of Service</a
                                >
                                and
                                <a
                                  target="_blank"
                                  :href="route('policy.show')"
                                  class="underline text-sm text-gray-600 hover:text-gray-900"
                                  >Privacy Policy</a
                                >
                              </div>
                            </div>
                          </jet-label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                          <LoginModal
                            class="underline text-sm text-gray-600 hover:text-gray-900"
                          >
                            Already registered?
                          </LoginModal>
                          <button
                            type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="open = false"
                            ref="cancelButtonRef"
                          >
                            Cancel
                          </button>
                          <jet-button
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                          >
                            Register
                          </jet-button>
                        </div>
                      </form>

                      <socialstream-providers v-if="$page.props.socialstream.show" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"></div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import SocialstreamProviders from "@/Socialstream/Providers";
import Link from "@inertiajs/inertia-vue3";
import LoginModal from "./LoginModal.vue";

export default {
  components: {
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    SocialstreamProviders,
    Link,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>

<script setup>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

const open = ref(false);
</script>
