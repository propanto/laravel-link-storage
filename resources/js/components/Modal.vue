<template>
  <div :id="`modal-${id}`">
    <slot name="button" :open="open" :close="close" :isOpen="isOpen" />
    
    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" @close="close">
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="min-h-screen px-4 text-center bg-gray-900 bg-opacity-50">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0"
              enter-to="opacity-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100"
              leave-to="opacity-0"
            >
              <DialogOverlay :class="['fixed inset-0', overlayStyle]" />
            </TransitionChild>

            <span class="inline-block h-screen align-middle" aria-hidden="true">
              &#8203;
            </span>

            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <div class="inline-block w-full max-w-3xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                  <slot name="title" />
                </DialogTitle>

                <div class="mt-2">
                  <slot name="content" :close="close" />
                </div>
              </div>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import useId from '@/hooks/use-Id'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
} from '@headlessui/vue'

let id = useId()

const props = defineProps({
  overlayStyle: {
    type: [String, Array, Object],
    default: 'bg-black opacity-30'
  }
})

const isOpen = ref(false)
const close = () => isOpen.value = false
const open = () => isOpen.value = true
</script>
