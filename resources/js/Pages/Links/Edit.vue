<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create New Link
      </h2>
    </template>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="update">
          <div class="px-4 py-5 sm:px-6 sm:pt-6 sm:pb-4 rounded-md shadow-lg bg-white overflow-hidden">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-1">
                <label for="thumbnail" class="block items-center text-sm font-semibold text-gray-700 cursor-pointer">
                  Cover Thumbnail
                  <svg class="mt-2 mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </label>
                <input id="thumbnail" type="file" name="thumbnail" class="hidden" />
              </div>

              <div class="col-span-6 sm:col-span-5">
                <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                <input v-model="form.name" type="text" name="name" id="name" placeholder="Url Name" class="mt-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <span class="text-red-600 text-xs">{{ $page.props.errors.name }}</span>
              </div>

              <div class="col-span-full">
                <label for="url" class="block text-sm font-semibold text-gray-700">Url</label>
                <input v-model="form.url" type="text" name="url" id="url" placeholder="http://www.example.com/" class="mt-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                <span class="text-red-600 text-xs">{{ $page.props.errors.url }}</span>
              </div>

              <div class="col-span-full">
                <label for="description" class="block text-sm font-semibold text-gray-700">
                  Description
                </label>
                <div class="mt-1">
                  <textarea v-model="form.description" id="description" name="description" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Add a description for your list." />
                  <span class="text-red-600 text-xs">{{ $page.props.errors.description }}</span>
                </div>
              </div>
              
              <div class="col-span-full">
                <div class="flex justify-end">
                  <loading-button
                    :loading="form.processing"
                    class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none"
                    type="submit"
                  >Edit Link</loading-button>         
                </div>
                <!-- <button type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  Save
                </button> -->
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

  props: {
    link: Object
  },

  setup (props) {
    const form = useForm({
      _method: 'put',
      name: props.link.name,
      url: props.link.url,
      description: props.link.description,
      // thumbnail: null
    })

    function update() {
      form.post(`/links/${props.link.id}`)
    }

    return {
      form,
      update,
    }
  },
}
</script>
