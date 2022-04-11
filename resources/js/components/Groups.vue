<template>
  <template v-for="(group, index) in groups" :key="index">
    <router-link :to="'/groups/' + group.id" custom v-slot="{ href }">
      <a :href="href">
        <button
          class="
            flex flex-row
            items-center
            hover:bg-gray-100
            rounded-xl
            p-2
            w-full
          "
        :id="'group-' + group.id">
          <div class="ml-2 text-sm text-primary">{{ group.name }}</div>
        </button>
      </a>
    </router-link>
  </template>
</template>

<script>
export default {
  data() {
    return {
      groups: [],
    };
  },
  props: ["activeGroup"],

  created() {
    this.fetchGroups();
  },

  updated() {
    document.querySelector(`#group-${this.activeGroup}`).classList.add("bg-gray-100")
  },

  methods: {
    fetchGroups() {
      axios.get("/api/groups").then((response) => {
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
  padding-top: 15px;
  padding-bottom: 15px;
  margin: 0 !important;
  border-radius: 0;
  border-bottom: 1px solid #707070;
  border-width: 80%;
}
button div{
  text-overflow: ellipsis;
  overflow: hidden;
}
</style>