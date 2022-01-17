<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white sm:py-8 rounded">
        <welcome />
      </div>
    </div>
  </app-layout>
</template>

<script>
  import { defineComponent, ref } from 'vue'
  import AppLayout from '@/Layouts/AppLayout.vue'
  import Welcome from '@/Jetstream/Welcome.vue'
  import { BeakerIcon, TrashIcon, PencilAltIcon } from '@heroicons/vue/outline'
  import { Link } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    components: {
      // Components
      AppLayout,
      Welcome,
      Link,

      // Icons
      BeakerIcon,
      TrashIcon,
      PencilAltIcon,
    },

    props: {
      links: Object
    },
  })
</script>
