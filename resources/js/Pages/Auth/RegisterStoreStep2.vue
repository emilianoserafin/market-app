<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

const form = useForm({
  user_id: "",
  farm_name: "",
  first_name: "",
  last_name: "",
  business_id: "",
  street_address: "",
  city: "",
  province: "",
  postal_code: "",
  country: "",
  phone: "",
  farm_description: "",
});

const submit = () => {
  form.post(route("register-farm.store"));
};
</script>

<template>
  <Head title="Register Farm" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <JetValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="farm_name" value="Farm Name" />
        <JetInput
          id="farm_name"
          v-model="form.farm_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="farm_name"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="first_name" value="First Name" />
        <JetInput
          id="first_name"
          v-model="form.first_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="first_name"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="last_name" value="Last Name" />
        <JetInput
          id="last_name"
          v-model="form.last_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="last_name"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="business_id" value="Business ID" />
        <JetInput
          id="business_id"
          v-model="form.business_id"
          type="text"
          class="mt-1 block w-full"
          required
        />
      </div>
      <div class="mt-4">
        <JetLabel for="street_address" value="Street Address" />
        <JetInput
          id="street_address"
          v-model="form.street_address"
          type="text"
          class="mt-1 block w-full"
          required
          autocomplete="street_address"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="city" value="City" />
        <JetInput
          id="city"
          v-model="form.city"
          type="text"
          class="mt-1 block w-full"
          required
          autocomplete="city"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="province" value="Province" />
        <select
          name="province"
          id="province"
          v-model="form.province"
          class="block w-full mt-1 rounded-md"
        >
          <option value="select">Select</option>
          <option value="ontario">Ontario</option>
          <option value="british columbia">British Columbia</option>
        </select>
      </div>
      <div class="mt-4">
        <JetLabel for="postal_code" value="Postal Code" />
        <JetInput
          id="postal_code"
          v-model="form.postal_code"
          type="text"
          class="mt-1 block w-full"
          required
          autocomplete="postal_code"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="phone" value="Phone" />
        <JetInput
          id="phone"
          v-model="form.phone"
          type="tel"
          class="mt-1 block w-full"
          required
          autocomplete="phone"
        />
      </div>
      <div class="mt-4">
        <JetLabel for="farm_description" value="Farm Description" />
        <JetInput
          id="farm_description"
          v-model="form.farm_description"
          type="text"
          class="mt-1 block w-full"
          required
          autocomplete="farm_description"
        />
      </div>
      <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
        <JetLabel for="terms">
          <div class="flex items-center">
            <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />
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
        </JetLabel>
      </div>
      <div class="flex items-center justify-end mt-4">
        <JetButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Finish
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>
