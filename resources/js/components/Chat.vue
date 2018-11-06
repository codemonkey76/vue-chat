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
        <transition name="rollup">
            <div v-if="open" class="chat-window chat-shadow">
                <transition name="slide-right">
                <div v-if="conversation" class="conversation-window" @click="conversation=!conversation">
                    <p v-for="message in messages" :class="{sent: message.sent}">{{ message.text }}</p>
                </div>
                </transition>
                <transition name="slide-left">
                <div v-if="! conversation" class="message-window" @click="conversation=!conversation">
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                    <p>message window message window message window message window message window message window message window message window message window message window message window message window message window message window</p>
                </div>
                </transition>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                open: false,
                conversation: true,
                messages: []
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getMessages();
        },
        methods: {
            getMessages() {
                axios.get('/api/messages').then(response => {
                    this.messages = response.data;
                })
            }
        }
    }
</script>
<style>
    .message-window {
        position:absolute;
        padding:20px;
        top:0;
        left:0;
    }
    .conversation-window {
        position:absolute;
        padding:20px;
        top:0;
        left:0;
    }
    .conversation-window > p.sent {
        color:red;
    }
    .conversation-window {
        background: rgba(255, 255, 200, 0.5)
    }
    .message-window {
        background: rgba(255, 200, 255, 0.5)
    }
    .chat-shadow {
        box-shadow: 5px 5px 10px #aaa;
    }
    .chat-window {
        position:fixed;
        bottom:100px;
        right: 25px;
        min-width: 400px;
        min-height:700px;
        max-width:400px;
        max-height:700px;
        background:#ddd;
        border-radius: 1em;
        padding:20px;
        overflow-y:scroll;
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
        transform:translateX(100%);
    }
    .slide-right-enter, .slide-right-leave-to {
        transform:translateX(-100%);
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
