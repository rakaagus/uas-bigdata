<template>
  <table class="w-full border-b border-gray-200">
    <thead>
      <tr class="text-sm font-medium text-gray-700 border-b border-gray-200">
        <td class="pl-10">
          <div class="flex items-center gap-x-4">
            <span>Product Name</span>
          </div>
        </td>
        <td class="py-4 px-4 text-center">Pricing</td>
        <td class="py-4 px-4 text-center">Downloaded</td>
        <td class="py-4 px-4 text-center">Rating</td>
        <td class="py-4 px-4 text-center">Platforms</td>
        <td class="py-4 pr-10 pl-4 text-center">
          <FilterIcon class="w-6 h-6 fill-current" />
        </td>
      </tr>
    </thead>
    <tbody>
      <tr class="hover:bg-gray-100 transition-colors group">
        <td class="flex gap-x-4 items-center py-4 pl-10">
          <input
            type="checkbox"
            class="w-6 h-6 text-indigo-600 rounded-md border-gray-300"
          />
          <img
            src="/img/organic-landing-page.png"
            alt=""
            class="
              w-40
              aspect-[3/2]
              rounded-lg
              object-cover object-top
              border border-gray-200
            "
          />
          <div>
            <a href="#" class="text-lg font-semibold text-gray-700"> coba </a>
            <div class="font-medium text-gray-400">coba</div>
          </div>
        </td>
        <td class="font-medium text-center">$harga</td>
        <td class="font-medium text-center">download</td>
        <td class="text-center">
          <span class="font-medium">rating</span>
          <span class="text-gray-400">/5</span>
        </td>
        <td>
          <div class="flex gap-x-2 justify-center items-center">
            <a href="#" class="p-2 bg-gray-200 rounded-md hover:bg-gray-300">
              <font-awesome-icon icon="fa-solid fa-book" />
            </a>
          </div>
        </td>
        <td>
          <span class="inline-block w-20 group-hover:hidden"> coba </span>
          <div
            class="
              hidden
              group-hover:flex
              group-hover:w-20
              group-hover:items-center
              group-hover:text-gray-500
              group-hover:gap-x-2
            "
          >
            <button class="p-2 hover:rounded-md hover:bg-gray-200">
              <PencilIcon class="w-6 h-6 fill-current" />
            </button>
            <button class="p-2 hover:rounded-md hover:bg-gray-200">
              <TrashIcon class="w-6 h-6 fill-current" />
            </button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>
