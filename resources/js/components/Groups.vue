<template>
  <button
    class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2 w-full"
    @click="this.openModal = true"
  >
    <PlusIcon class="h-4 w-4 text-primary" />
    <div class="ml-2 text-sm text-primary">Ajouter un groupe</div>
  </button>
  <template v-for="(group, index) in groups" :key="index">
    <router-link :to="'/groups/' + group.id">
      <button
        class="
          flex flex-row
          items-center
          hover:bg-gray-100
          rounded-xl
          p-2
          w-full
        "
        :id="'group-' + group.id"
      >
        <div class="text-sm text-primary ml-2">
          {{ group.name }}
        </div>
      </button>
    </router-link>
  </template>
  <div class="modal" v-bind:class="{show: openModal}">
    <div class="contain">
      <div class="close">
        <XIcon @click="this.openModal = false" class="h-5 w-5 text-primary" />
      </div>
      <Multiselect
        v-model="users"
        :close-on-select="false"
        :searchable="true"
        :options="options"
        mode="tags"
        placeholder="Veuillez choisir une personne à ajouter au groupe"
      />
      <button
        @click="addGroup"
        class="bg-green text-white px-4 text-sm flex-shrink-0"
      >
        Créer un groupe
      </button>
    </div>
  </div>
</template>

<script>
import { PlusIcon, XIcon } from "@heroicons/vue/solid";
import Multiselect from "@vueform/multiselect";
export default {
  data() {
    return {
      groups: [],
      options: [],
      users: null,
      openModal: false,
    };
  },

  props: ["activeGroup", "user"],

  components: {
    PlusIcon,
    Multiselect,
    XIcon,
  },

  created() {
    this.fetchGroups();
    this.fetchUsers();
  },

  updated() {
    if (this.activeGroup) {
      document
        .querySelector(`#group-${this.activeGroup}`)
        .classList.add("bg-gray-100");
    }
  },

  watch: {
    $route(to, from) {
      if (from.params.id) {
        if (to.params.id !== from.params.id) {
          document
            .querySelector(`#group-${to.params.id}`)
            .classList.add("bg-gray-100");
          document
            .querySelector(`#group-${from.params.id}`)
            .classList.remove("bg-gray-100");
        }
      }
    },
  },

  methods: {
    fetchGroups() {
      axios.get("/api/groups").then((response) => {
        this.groups = response.data;
      });
    },

    fetchUsers() {
      axios.get("/api/users").then((response) => {
        response.data.data.forEach((user) => {
          if (user.id !== this.user.id) {
            this.options.push({ value: user, label: user.name });
          }
        });
      });
    },

    addGroup() {
      if (!this.users) return;
      const users = JSON.parse(JSON.stringify(this.users));
      users.push(this.user);
      let name = "";

      users.forEach((user, index) => {
        name += user.name;
        if (users[index + 1]) {
          name += ", ";
        }
      });
      axios
        .post("/api/groups", {
          name,
          users,
        })
        .then((response) => {
          if (response.status === 200) {
            location.reload();
          }
        });
    },
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
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
  padding-top: 15px;
  padding-bottom: 15px;
  margin: 0 !important;
  border-radius: 0;
  border-bottom: 1px solid #707070;
  border-width: 80%;
  border : 1px solid transparent;
}
button div {
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
}
.modal {
  width: 100vw;
  height: 100vh;
  background-color: #00000050;
  z-index: 100;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  display: none;
}
.contain {
  background-color: white;
  width: 500px;
  min-height: 200px;
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  align-items: center;
  border-radius: 10px;
  border: 2px solid #707070;
}
.contain button {
  border-radius: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
}
.close {
  width: 100%;
  display: flex;
  justify-content: end;
  margin-top: -10px;
}
.close svg {
  cursor: pointer;
}
.options {
  display: none;
  background-color: white;
  border: 2px solid #707070;
  font-size: 10px;
  flex-direction: column;
  height: 50px;
  justify-content: space-around;
  padding-left: 10px;
  width: 150px;
  position: absolute;
  z-index: 100;
  margin-top: -10px;
  margin-left: 10px;
  border-radius: 6px;
}
.show {
  display: flex;
}
</style>