<template>
  <Layout>
    <div class="container">
      <div class="left">
        <div class="top">Paramètres</div>
        <div class="bot">
          <ul class="left-bot-menu">
            <li class="active">Modifier Profile <span>></span></li>
            <li>Notifications <span>></span></li>
            <li>Apparence <span>></span></li>
          </ul>
        </div>
      </div>
      <div class="right"><ProfileSettings :user="this.user" /></div>
    </div>
  </Layout>
</template>

<script>
import Layout from "../layouts/index.vue";
import ProfileSettings from "../components/ProfileSettings.vue";
export default {
  components: {
    Layout,
    ProfileSettings,
  },
  data(){
    return {
      user: {}
    }
  },

  created() {
    axios.get('/api/userinfos').then((response) => {
      this.user = response.data
    })
  }
};

</script>
