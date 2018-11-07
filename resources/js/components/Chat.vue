<template>
    <div>
        <transition name="spin">
            <div v-if="!open" class="chat-bubble bubble-shadow" @click="open=!open">
                <span class="fa-stack fa-2x fa-lg">
                    <i class="fa fa-circle fa-stack-2x chat-color"></i>
                    <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        </transition>
        <transition name="spin">
            <div v-if="open" class="chat-bubble" @click="open=!open">
                <span class="fa-stack fa-2x fa-lg">
                    <i class="fa fa-circle fa-stack-2x chat-color"></i>
                    <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        </transition>
        <transition name="slide-left">
            <div v-if="open" class="chat-window chat-shadow">
                <transition name="slide-right">
                    <div v-if="conversationView">
                        <div class="conversation-window">
                            <div class="conversation-header">
                                Conversations
                            </div>
                            <div class="conversation-body">
                                <p class="conversation-item" v-for="conversation in conversations"
                                @click="selectConversation(conversation.id)">{{ conversation.number }}</p>
                            </div>
                        </div>
                    </div>
                </transition>
                <transition name="slide-left">
                    <div v-if="! conversationView">
                        <div class="message-window">
                            <div class="message-header">
                                <i @click="conversationView=!conversationView"
                                   class="fas fa-lg fa-angle-left mr-2 back-arrow"></i>
                                Conversation with: {{getConversationTitle()}}
                            </div>
                            <div id="message-window" class="message-body">
                                <p v-for="message in messages"
                                   :class="{sent: message.sent}">{{ message.text }}</p>
                            </div>
                            <div class="message-footer">
                                <input @click="scrollDown" type="text" class="form-control chat-message"
                                       placeholder="Enter message...">
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
                conversationId: null,
                conversations: [],
                messages: []
            }
        },
        mounted() {
            this.conversationId = this.selectedConversation;
            this.getConversations();
            if (this.conversationId)
                this.getMessages();
        },
        methods: {
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
            getConversationTitle() {
                if (this.conversationId) {
                    return this.conversations.filter(c => {
                       return c.id === this.conversationId;
                    })[0].number;
                }
                return "";
            },
            scrollDown() {
                let msgWindow = $('#message-window');
                msgWindow.scrollTop(1000000);
                console.log('scrolling down');
            }
        }
    }
</script>
<style>
    .chat-message {
        border-radius: 0 0 1em 1em;
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
        padding:20px;
        overflow-y:auto;
        overflow-x:hidden;
        height: calc(100vh - 225px);
    }

    .message-window {
        /*padding: 20px;*/
        left: 0;
        background: rgba(255, 255, 255, 1);
        width: 100%;
        /*height: 501px;*/
        /*overflow-y: auto;*/
        border-radius:1em;
    }

    .conversation-window {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 100%;
        border-radius: 1em;
        padding: 20px;
        background: rgba(255, 255, 255, 1);

    }
    .conversation-body {

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
        min-height: calc(100vh - 125px);
        max-width: 400px;
        max-height: 600px;
        background: #ddd;
        border-radius: 1em;
        overflow:hidden;
    }

    .slide-right-enter-active, .slide-right-leave-active,
    .slide-left-enter-active, .slide-left-leave-active,
    .fade-enter-active, .fade-leave-active,
    .spin-enter-active, .spin-leave-active,
    .rollup-enter-active, .rollup-leave-active {
        transition: all 750ms ease-in-out;
    }

    .spin-enter, .spin-leave-to {
        transform: rotate(720deg);
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .rollup-enter, .rollup-leave-to {
        transform: translateX(100%);
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
