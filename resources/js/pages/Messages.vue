<template>
  <Layout>
    <div class="container">
      <div class="left">
        <div class="top"></div>
        <div class="bot">
          <Groups :activeGroup="this.groupId" :user="this.user" />
        </div>
      </div>
      <div class="right">
        <Chats :user="this.user" :group="this.groupId" :key="this.groupId" />
      </div>
    </div>
  </Layout>
</template>

<script>
import Groups from "../components/Groups.vue";
import Layout from "../layouts/index.vue";
import Chats from "../components/Chats.vue";
export default {
  props: ["user", "group"],
  components: {
    Groups,
    Layout,
    Chats,
  },
  data() {
    return {
      groupId: this.group,
    };
  },

  created() {
    this.groupId = this.$route.params.id
  },

  watch: {
    $route(to, from) {
      if (to.params.id !== from.params.id) {
        this.groupId = to.params.id;
      }
    },
  },
};
</script>
<style scoped>
.new-message {
  background-color: #6366f1;
  width: 150px;
  padding-top: 10px;
  padding-bottom: 10px;
  margin: 0 auto;
  color: white;
  margin-bottom: 20px;
  position: sticky;
  bottom: 0;
  display: none;
}
</style>