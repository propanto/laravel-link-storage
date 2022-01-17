<template>
  <app-layout title="My Links">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My Links
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4 flex justify-end">
          <Link
            href="/links/create"
            class="rounded-md shadow-sm px-4 py-2 sm:w-auto sm:text-sm bg-indigo-500 text-white text-base font-medium hover:bg-indigo-600 focus:outline-none"
          >Add Link</Link>
        </div>

        <template v-if="links.data.length">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="min-w-full divide-y divide-gray-200">
                      <div class="flex justify-between items-center" v-for="link in links.data" :key="link.id">
                        <div class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                              <div class="flex justify-center items-center w-10 h-10 rounded-md bg-green-600">
                                <BeakerIcon class="w-6 h-6 text-white" />
                              </div>
                            </div>
                            <div class="ml-4">
                              <div class="text-sm font-semibold text-gray-900">
                                <a :href="link.url">{{ link.name }}</a>
                              </div>
                              <div class="text-sm text-gray-400">
                                {{ link.description }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="px-6 py-4 text-sm font-medium">
                          <div class="flex justify-center items-center h-full">
                            <div>
                              <Link :href="`/links/${link.id}`" method="delete" as="button" type="button">
                                <TrashIcon class="w-5 h-5 text-red-600" />
                              </Link>
                            </div>
                            <div class="ml-3">
                              <Link :href="`/links/${link.id}/edit`">
                                <PencilAltIcon class="w-5 h-5 text-indigo-600" />
                              </Link>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>              
        </template>

        <div class="flex justify-end" v-if="links.data.length">
          <nav class="relative mt-6 z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
            <Component
              :is="link.url ? 'Link' : 'span'"
              v-for="(link, index) in links.links"
              :key="index"
              :href="link.url"
              v-html="link.label"
              :class="[
                'bg-white border-gray-300 text-gray-500',
                'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                 link.url ? 'hover:bg-gray-50' : 'bg-gray-100 cursor-not-allowed'
              ]"
            />
          </nav>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
  import { defineComponent, ref } from 'vue'
  import AppLayout from '@/Layouts/AppLayout.vue'
  import { BeakerIcon, TrashIcon, PencilAltIcon } from '@heroicons/vue/outline'
  import { Link } from '@inertiajs/inertia-vue3'

  export default defineComponent({
    components: {
      // Components
      AppLayout,
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
