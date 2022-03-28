<template>
  <div
    class="
      flex flex-col
      space-y-1
      w-60
      overflow-y-auto
      h-screen
      container-conversation
      shadow
    "
  >
    <div class="relative text-gray-600 focus-within:text-gray-400 m-3">
      <span class="absolute inset-y-0 left-0 flex items-center pl-2">
        <svg
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          viewBox="0 0 24 24"
          class="w-6 h-6 text-gray-500"
        >
          <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </span>
      <input
        aria-placeholder="Rechercher..."
        placeholder="Rechercher..."
        class="
          py-2
          pl-10
          block
          w-full
          rounded
          bg-gray-100
          outline-none
          focus:text-gray-700
        "
        type="search"
        name="search"
        required
        autocomplete="search"
      />
    </div>
    <div class="flex justify-start items-center container-title h-10">
      <p class="py-8 text-xl">Conversations</p>
    </div>
    <template v-for="(group,index) in groups" :key="index">
      <router-link :to="'/groups/' + group.id" custom v-slot="{ href }">
        <a :href="href" >
        <button class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
          <div
            class="
              flex
              items-center
              justify-center
              h-8
              w-8
              bg-indigo-200
              rounded-full
            "
          >
            {{group.name.substr(0,1).toUpperCase()}}
          </div>
          <div class="ml-2 text-sm font-semibold">{{group.name}}</div>
        </button>
        </a>
      </router-link>

    </template>
  </div>
</template>

<script>
export default {

  data() {
    return {
      groups: [],
    };
  },

  created() {
    this.fetchGroups()

  },

  methods: {
    fetchGroups() {
      axios.get("/groups").then((response) => {
        this.groups = response.data;
      });
    },
  },
};
</script>

<style scoped>
.container-title {
  color: black;
  width: 100%;
  padding: 25px;
}
.container-conversation {
  background-color: white;
}
button {
  padding-left: 25px;
  padding-top: 10px;
  padding-bottom: 10px;
  margin: 0 !important;
  border-radius: 0;
}
</style>