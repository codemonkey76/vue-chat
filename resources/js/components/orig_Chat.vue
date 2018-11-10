<template>
    <div>

        <transition name="slide-left">
            <div v-if="open" class="chat-window chat-shadow">

                <transition name="slide-up">

                </transition>

                <transition name="slide-right">
                    <div v-if="conversationView">
                        <div class="conversation-window">
                            <div class="conversation-header">
                                Conversations
                            </div>
                            <!--<transition name="slide-up">-->
                                <div v-if="! newConversation">
                                    <div class="conversation-body">
                                        <p class="conversation-item"
                                           v-for="conversation in conversations"
                                           @click="selectConversation(conversation.id)">{{ conversation.number }}</p>
                                    </div>
                                    <div class="conversation-footer">
                                        <button class="btn btn-primary" @click="newConversation = !newConversation">New
                                            Conversation
                                        </button>
                                    </div>
                                </div>
                            <!--</transition>-->

                            <!--<transition name="slide-down">-->
                                <div v-if="newConversation">
                                    <div class="conversation-body">Body</div>
                                    <div class="conversation-footer">
                                        <button class="btn btn-primary">Create</button>
                                        <button class="btn btn-secondary" @click="newConversation=!newConversation">Cancel
                                        </button>
                                    </div>
                                </div>
                            <!--</transition>-->
                        </div>
                    </div>
                </transition>

                <transition name="slide-left">
                    <div v-if="! conversationView">
                        <div class="message-window">
                            <div class="message-header">
                                <i @click="conversationView=!conversationView"
                                   class="fas fa-lg fa-angle-left mr-2 back-arrow"></i>
                                Conversation with:
                            </div>
                            <div id="message-body" class="message-body">
                                <p v-for="message in messages"
                                   :class="{sent: message.sent}">{{ message.text }}</p>
                            </div>
                            <div class="message-footer">
                                <textarea @click="scrollDown"
                                          @keyup="validateMessage"
                                          class="form-control chat-message"
                                          placeholder="Enter message..."
                                          v-model="message" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['selectedConversation'],
        data() {
            return {
                open: false,
                conversationView: true,
                newConversation: false,
                conversationId: null,
                conversations: [],
                messages: [],
                message: ''
            }
        },
        mounted() {
            this.conversationId = this.selectedConversation;
            this.getConversations();
            if (this.conversationId)
                this.getMessages();
        },
        methods: {
            validateMessage(e) {
                if (e.keyCode === 13) {
                    if (!e.shiftKey) {
                        alert('Send message: ' + this.message);
                        this.message = '';
                    }
                }
            },
            getMessages() {
                axios.get('/api/messages/' + this.conversationId).then(response => {
                    this.messages = response.data;
                    this.scrollDown();
                })
            },
            getConversations() {
                axios.get('/api/conversations').then(response => {
                    this.conversations = response.data;
                });
            },
            selectConversation(item) {
                this.conversationId = item;
                this.getMessages();
                this.conversationView = !this.conversationView;
            },
            scrollDown() {
                let msgWindow = $('#message-body');
                msgWindow.scrollTop(1000000);
                console.log('scrolling down');
            }
        }
    }
</script>
<style>
    .front {
        z-index: 1000;
    }

    .chat-message {
        border-radius: 0 0 1em 1em;
        height: 90px;
        resize: none;
    }

    .back-arrow {
        cursor: pointer;
    }

    .message-header {
        background: #aae !important;
        font-weight: 600;
        border-radius: 1em 1em 0 0 !important;
        padding: 20px !important;
    }

    .conversation-header {
        background: #aae !important;
        font-weight: 600;
        border-radius: 1em 1em 0 0 !important;
        padding: 20px !important;
    }

    .conversation-item {
        cursor: pointer;
    }

    .message-body {
        height: 455px;
    }

    .conversation-body {
        height: 480px;
        background:white;
    }

    .conversation-body, .message-body {
        padding: 20px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .message-window {
        left: 0;
        background: rgba(255, 255, 255, 1);
        width: 100%;
        border-radius: 1em;
    }

    .conversation-footer {
        padding: 10px;
        border-radius: 0 0 1em 1em;
        text-align: center;
        background: #aae;
    }

    .conversation-window {
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 1);
        width: 100%;
        min-height: 100%;
        border-radius: 1em;
    }

    .message-body > p.sent {
        color: white;
        background: #aae;
        border-radius: 0.5em;
        padding: 8px;
        margin-left: 30px;
    }

    .conversation-body > p, .message-body > p:not(.sent) {
        color: black;
        background: rgb(245, 245, 245);
        border-radius: 0.5em;
        padding: 8px;
        margin-right: 30px;
    }

    .chat-shadow {
        box-shadow: 5px 5px 10px #aaa;
    }

    .chat-window {
        position: fixed;
        bottom: 100px;
        right: 25px;
        min-width: 400px;
        min-height: 600px;
        max-width: 400px;
        max-height: 600px;
        background: #ddd;
        border-radius: 1em;
        overflow: hidden;
    }

    .slide-down-enter-active, .slide-down-leave-active,
    .slide-up-enter-active, .slide-up-leave-active,
    .slide-right-enter-active, .slide-right-leave-active,
    .slide-left-enter-active, .slide-left-leave-active,
    .spin-enter-active, .spin-leave-active {
        transition: all 4s ease-in-out;
    }

    .spin-enter, .spin-leave-to {
        transform: rotate(720deg);
    }

    .slide-up-enter, .slide-up-leave-to {
        transform: translateY(-50%);
    }

    .slide-down-enter, .slide-down-leave-to {
        transform: translateY(100%);
    }
    .slide-left-enter, .slide-left-leave-to {
        transform: translateX(100%);
    }

    .slide-right-enter, .slide-right-leave-to {
        transform: translateX(-100%);
    }

    .chat-color {
        color: #aae;
    }

    .chat-bubble {
        position: fixed;
        bottom: 25px;
        right: 25px;
        cursor: pointer;
    }
</style>
