<template>
  <Layout>
    <div class="container">
      <div class="left">
        <div class="top"></div>
        <div class="bot">
            <Groups :user="this.user" />
        </div>
      </div>
      <div class="right"></div>
    </div>
  </Layout>
</template>

<script>
import Layout from "../layouts/index.vue";
import Groups from "../components/Groups.vue";
export default {
  props: ["user"],
  components: {
    Layout,
    Groups,
  },
};
</script>
