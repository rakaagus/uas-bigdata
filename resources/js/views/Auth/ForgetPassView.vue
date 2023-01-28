<template>
  <div class="flex flex-col px-8 pt-10 lg:px-14 xl:px-24">
    <div class="pt-36 pb-6">
      <h1
        class="text-3xl font-bold tracking-wide leading-loose whitespace-nowrap"
      >
        Are You Forget Your Password?
      </h1>
      <span class="font-light text-gray-500">
        we can your password in email
      </span>
      <form>
        <div class="pt-6">
          <label for="email" class="font-light">email</label>
          <div
            class="
              flex
              overflow-hidden
              items-center
              mt-2
              w-full
              rounded-lg
              border border-gray-400
              transition-all
              focus-within:shadow-lg focus-within:border-orange-500
            "
          >
            <div class="flex justify-center items-center pl-6">
              <font-awesome-icon icon="fa-solid fa-envelope" />
            </div>
            <input
              type="email"
              name="email"
              placeholder="Enter Your Email"
              id="email"
              class="
                px-4
                py-4
                w-full
                focus:outline-none
                font-light
                border-0
                focus:ring-0
              "
            />
          </div>
        </div>
        <div class="pt-8">
          <button
            type="submit"
            class="
              py-4
              px-8
              w-full
              text-white
              bg-orange-500
              rounded-lg
              shadow-lg
              hover:bg-orange-600
              focus:ring-4 focus:ring-red-100 focus:outline-none
            "
          >
            Send Email
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>
