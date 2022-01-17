<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create New Link
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="store">
          <div class="px-4 py-5 sm:px-6 sm:pt-6 sm:pb-4 rounded-md shadow-lg bg-white overflow-hidden">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-full"> 
                <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                <input v-model="form.name" type="text" name="name" id="name" placeholder="Url name..." class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <span class="text-red-600 text-xs">{{ $page.props.errors.name }}</span>
              </div>

              <div class="col-span-full">
                <label for="url" class="block text-sm font-semibold text-gray-700">Url</label>
                <input v-model="form.url" type="text" name="url" id="url" placeholder="http://www.example.com/" class="mt-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <span class="text-red-600 text-xs">{{ $page.props.errors.url }}</span>
              </div>

              <div class="col-span-full">
                <label for="description" class="block text-sm font-semibold text-gray-700">
                  Description
                </label>
                <div class="mt-1">
                  <textarea v-model="form.description" id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Add a description for your link." />
                  <span class="text-red-600 text-xs">{{ $page.props.errors.description }}</span>
                </div>
              </div>
              
              <div class="col-span-full">
                <div class="flex justify-end">
                  <loading-button
                    :loading="form.processing"
                    class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
                    type="submit"
                  >Create Link</loading-button>         
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import LoadingButton from '@/components/LoadingButton.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  components: {
    AppLayout,
    LoadingButton
  },

  setup () {
    const form = useForm({
      name: null,
      url: null,
      description: null,
      // thumbnail: null
    })

    function store() {
      form.post('/links')
    }

    return {
      form,
      store,
    }
  },
}
</script>
