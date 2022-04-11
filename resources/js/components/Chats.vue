<template>
  <div v-if="this.loading" :key="this.loading" class="h-full flex justify-center items-center">
    <div class="loading">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
  </div>
  <div class="overflow-hidden container-messages">
    <div class="messages flex flex-col overflow-x-auto overflow-y-scroll">
      <div class="flex flex-col h-full">
        <div class="grid grid-cols-12 gap-y-2">
          <template v-for="(message, index) in messages" :key="index">
            <div
              v-if="this.user.name === message.user.name"
              class="col-start-6 col-end-13 p-3 rounded-lg"
            >
              <div class="flex items-center justify-start flex-row-reverse">
                <div class="flex items-center justify-center flex-shrink-0">
                  <img src="/images/rose.svg" width="30" height="30" />
                </div>
                <div
                  class="
                    relative
                    mr-3
                    text-sm
                    bg-green
                    py-1
                    perso-message
                    rounded-xl
                    text-white
                  "
                >
                  <div>{{ message.message }}</div>
                  <div class="time">{{ message.time }}</div>
                </div>
              </div>
            </div>

            <div v-else class="col-start-1 col-end-8 p-3 rounded-lg">
              <div class="flex flex-row items-center">
                <div class="flex items-center justify-center flex-shrink-0">
                  <img src="" />
                </div>
                <div
                  class="
                    relative
                    ml-3
                    text-sm
                    bg-gray-message
                    py-1
                    other-message
                    text-white
                    rounded-xl
                    flex 
                    flex-col
                  "
                >
                  <div class="name">{{ message.user.name }}</div>
                  <div>{{ message.message }}</div>
                  <div class="time">{{ message.time }}</div>
                </div>
              </div>
            </div>
          </template>
          <div v-if="activeUser" class="col-start-1 col-end-8 p-3 rounded-lg">
            <div class="flex flex-row items-center">
              <div class="flex items-center justify-center flex-shrink-0">
                <img src="" />
              </div>
              <div
                class="
                  relative
                  ml-3
                  text-sm
                  bg-gray-message
                  py-2
                  px-4
                  shadow
                  rounded-xl
                "
              >
                <div>
                  <div class="typing">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button
          class="new-message text-sm rounded-xl bg-green mb-4"
          @click="scrollToButtom"
        ></button>
      </div>
    </div>
  </div>
  <div
    class="flex flex-row items-center h-16 container-input bg-white w-full px-4"
  >
    <div class="flex-grow ml-4">
      <div class="relative w-full">
        <input
          v-model="newMessage"
          @input="sendTypingEvent"
          @keyup.enter="sendMessage"
          type="text"
          class="inputText flex w-full border rounded-xl text-sm h-8"
          placeholder="Entrez votre messages..."
        />
        <button
          class="
            absolute
            flex
            items-center
            justify-center
            h-full
            w-12
            right-0
            top-0
            text-gray-400
            hover:text-gray-600
          "
        >
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            ></path>
          </svg>
        </button>
      </div>
    </div>
    <div class="ml-4">
      <button
        @click="sendMessage"
        class="
          flex
          items-center
          justify-center
          bg-green
          rounded-xl
          text-white
          px-4
          text-sm
          py-1
          flex-shrink-0
        "
      >
        <span>Envoyer</span>
      </button>
    </div>
  </div>
</template>
<script>
import { nextTick } from "vue";
export default {
  props: ["user", "group"],
  data() {
    return {
      messages: [],
      newMessage: "",
      activeUser: false,
      loading: true,
    };
  },

  updated() {
    this.loading = false;
  },

  created() {
    this.fetchMessages();

    Echo.private(`group.${this.group}`)
      .listen("MessageSent", (event) => {
        this.messages.push(event.message);
        this.activeUser = false;
        document.querySelector(".new-message").innerHTML = "1 nouveau message";
        document.querySelector(".new-message").style.display = "block";
      })
      .listenForWhisper("typing", () => {
        this.activeUser = true;
        document.querySelector(".new-message").innerHTML =
          "En train d'écrire...";
        document.querySelector(".new-message").style.display = "block";
      })
      .listenForWhisper("notTyping", () => {
        this.activeUser = false;
        document.querySelector(".new-message").style.display = "none";
      });
  },

  mounted() {
    setTimeout(() => {
      let messages = document.querySelector(".messages");
      messages.scrollTo({ top: messages.scrollHeight, behavior: "smooth" });
    }, 1000);
  },

  methods: {
    fetchMessages() {
      axios
        .get("/api/messages", { params: { group_id: this.group } })
        .then((response) => {
          this.messages = response.data[0].messages;
          this.messages.forEach((message) => {
            let hours = new Date(message.created_at).getHours()
            let minutes = new Date(message.created_at).getMinutes()
            if(minutes < 10){
              minutes = `0${minutes}`
            }
            message.time = `${hours}:${minutes}`
          })
        });
    },

    sendMessage() {
      this.messages.push({
        user: this.user,
        message: this.newMessage,
      });
      axios.post("/api/messages", {
        message: this.newMessage,
        group_id: this.group,
      });

      this.newMessage = "";
      setTimeout(() => {
        let messages = document.querySelector(".messages");
        messages.scrollTo({ top: messages.scrollHeight, behavior: "smooth" });
      }, 200);
    },

    async sendTypingEvent() {
      await nextTick();
      if (this.newMessage !== "") {
        Echo.private(`group.${this.group}`).whisper("typing", this.user);
      } else {
        Echo.private(`group.${this.group}`).whisper("notTyping");
      }
    },

    scrollToButtom() {
      let messages = document.querySelector(".messages");
      messages.scrollTo({ top: messages.scrollHeight, behavior: "smooth" });
      document.querySelector(".new-message").style.display = "none";
    },
  },
};
</script>
<style scoped>
input {
  outline: none !important;
}
.new-message {
  width: 150px;
  padding-top: 10px;
  padding-bottom: 10px;
  margin: 0 auto;
  color: white;
  margin-bottom: 20px;
  position: sticky;
  bottom: 10px;
  display: none;
}
.messages {
  height: 100%;
}
.container-messages {
  height: 482px;
}
.container-input {
  border-bottom-right-radius: 10px;
}
.loading {
  align-items: center;
  display: flex;
}

.loading .dot {
  animation: TypingAnimation 1.8s infinite ease-in-out;
  background-color: #62BE93;
  border-radius: 50%;
  height: 15px;
  margin-right: 10px;
  vertical-align: middle;
  width: 15px;
  display: inline-block;
}

.loading .dot:nth-child(1) {
  animation-delay: 200ms;
}

.loading .dot:nth-child(2) {
  animation-delay: 300ms;
}

.loading .dot:nth-child(3) {
  animation-delay: 400ms;
}

.loading .dot:last-child {
  margin-right: 0;
}
.name{
  font-size: 12px;
  margin-bottom: 10px;
}
.other-message{
  padding-right: 15px;
  padding-left: 10px;
}
.perso-message{
  padding-left: 15px;
  padding-right: 10px;
}
.time{
  font-size: 10px;
  margin-top: 5px;
  text-align: right;
}
</style>