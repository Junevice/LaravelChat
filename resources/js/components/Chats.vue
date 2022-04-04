<template>
  <div class="flex h-screen antialiased text-gray-800">
    <div class="flex flex-row h-full w-full overflow-x-hidden">
      <Conversation />
      <div class="flex flex-col flex-auto h-screen p-6">
        <div
          class="
            flex flex-col flex-auto flex-shrink-0
            rounded-2xl
            bg-gray-100
            h-full
            p-4
          "
        >
          <div
            class="
              messages
              flex flex-col
              h-screen
              overflow-x-auto
              mb-4
              overflow-y-scroll
            "
          >
            <div class="flex flex-col h-full">
              <div class="grid grid-cols-12 gap-y-2">
                <template v-for="(message, index) in messages" :key="index">
                  <div
                    v-if="this.user.name === message.user.name"
                    class="col-start-6 col-end-13 p-3 rounded-lg"
                  >
                    <div
                      class="flex items-center justify-start flex-row-reverse"
                    >
                      <div
                        class="
                          flex
                          items-center
                          justify-center
                          h-10
                          w-10
                          rounded-full
                          bg-indigo-500
                          flex-shrink-0
                        "
                      >
                        {{ message.user.name.substr(0, 1).toUpperCase() }}
                      </div>
                      <div
                        class="
                          relative
                          mr-3
                          text-sm
                          bg-indigo-100
                          py-2
                          px-4
                          shadow
                          rounded-xl
                        "
                      >
                        <div>{{ message.message }}</div>
                      </div>
                    </div>
                  </div>

                  <div v-else class="col-start-1 col-end-8 p-3 rounded-lg">
                    <div class="flex flex-row items-center">
                      <div
                        class="
                          flex
                          items-center
                          justify-center
                          h-10
                          w-10
                          rounded-full
                          bg-indigo-500
                          flex-shrink-0
                        "
                      >
                        {{ message.user.name.substr(0, 1).toUpperCase() }}
                      </div>
                      <div
                        class="
                          relative
                          ml-3
                          text-sm
                          bg-white
                          py-2
                          px-4
                          shadow
                          rounded-xl
                        "
                      >
                        <div>{{ message.message }}</div>
                      </div>
                    </div>
                  </div>
                </template>
                <div
                  v-if="activeUser"
                  class="col-start-1 col-end-8 p-3 rounded-lg"
                >
                  <div class="flex flex-row items-center">
                    <div
                      class="
                        flex
                        items-center
                        justify-center
                        h-10
                        w-10
                        rounded-full
                        bg-indigo-500
                        flex-shrink-0
                      "
                    ></div>
                    <div
                      class="
                        relative
                        ml-3
                        text-sm
                        bg-white
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
             <button class="new-message text-sm rounded-xl" @click="scrollToButtom"></button>
            </div>
          </div>
         
          <div
            class="
              flex flex-row
              items-center
              h-16
              rounded-xl
              bg-white
              w-full
              px-4
            "
          >
            <div>
              <button
                class="
                  flex
                  items-center
                  justify-center
                  text-gray-400
                  hover:text-gray-600
                "
              >
                <svg
                  class="w-5 h-5"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                  ></path>
                </svg>
              </button>
            </div>
            <div class="flex-grow ml-4">
              <div class="relative w-full">
                <input
                  v-model="newMessage"
                  @input="sendTypingEvent"
                  @keyup.enter="sendMessage"
                  type="text"
                  class="
                    inputText
                    flex
                    w-full
                    border
                    rounded-xl
                    focus:outline-none focus:border-indigo-300
                    pl-4
                    h-10
                  "
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
                  bg-indigo-500
                  hover:bg-indigo-600
                  rounded-xl
                  text-white
                  px-4
                  py-1
                  flex-shrink-0
                "
              >
                <span>Send</span>
                <span class="ml-2">
                  <svg
                    class="w-4 h-4 transform rotate-45 -mt-px"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                    ></path>
                  </svg>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { nextTick } from "vue";
import Conversation from "./Conversation.vue";
export default {
  props: ["user", "group"],
  components: {
    Conversation,
  },
  data() {
    return {
      messages: [],
      newMessage: "",
      activeUser: false,
    };
  },

  created() {
    this.fetchMessages();

    Echo.private(`group.${this.group}`)
      .listen("MessageSent", (event) => {
        this.messages.push(event.message);
        this.activeUser = false;
         document.querySelector('.new-message').innerHTML = "1 nouveau message";
         document.querySelector('.new-message').style.display = 'block';
      })
      .listenForWhisper("typing", () => {
        this.activeUser = true;
        document.querySelector('.new-message').innerHTML = "En train d'écrire...";
        document.querySelector('.new-message').style.display = 'block';
        
      })
      .listenForWhisper("notTyping", () => {
        this.activeUser = false;
        document.querySelector('.new-message').style.display = 'none';
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
      document.querySelector('.new-message').style.display = 'none';
    }
  },
};
</script>
<style scoped>
  .new-message{
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