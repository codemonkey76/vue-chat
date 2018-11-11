<template>
    <div>
        <button class="btn btn-secondary" @click="prevPage()">Prev</button>
        <button class="btn btn-secondary" @click="nextPage()">Next</button>

        <transition name="spin">
            <div v-if="!visible" class="chat-bubble" @click="visible=!visible">
                <span class="fa-stack fa-2x fa-lg">
                    <i class="fa fa-circle fa-stack-2x chat-color"></i>
                    <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        </transition>

        <transition name="spin">
            <div v-if="visible" class="chat-bubble" @click="visible=!visible">
                <span class="fa-stack fa-2x fa-lg">
                    <i class="fa fa-circle fa-stack-2x chat-color"></i>
                    <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        </transition>

        <transition name="slide">
            <template v-if="visible">
                <div class="wrapper">
                    <div class="chat-window" :class="getClass">
                        <div class="new-conversation">
                            <div class="new-conversation-header">Header</div>
                            <div class="new-conversation-body">Body</div>
                            <div class="new-conversation-footer">Footer</div>
                        </div>
                        <div class="conversation-window">
                            <div class="conversation-header">Header</div>
                            <div class="conversation-body">
                                <template v-for="conversation in conversations">
                                    <div class="d-flex">
                                        <div class="col-1 d-flex align-items-center justify-content-center ellipsis"
                                             @click="clickEllipsis(conversation.id)">
                                            <i class="fas fa-ellipsis-h fa-lg"></i>
                                        </div>
                                        <div class="col conversation"
                                             @click="selectConversation(conversation.id)">
                                            {{conversation.number}}
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div class="conversation-footer">Footer</div>
                        </div>
                        <div class="message-window">
                            <div class="message-header">Header</div>
                            <div class="message-body" id="message-body">
                                <div v-for="message in messages" class="message"
                                     :class="{sent: message.sent, received: !message.sent}">{{message.text}}
                                </div>
                            </div>
                            <div class="message-footer">Footer</div>
                        </div>
                    </div>
                </div>
            </template>
        </transition>
        <div class="menu-bubble" id="menu-bubble">
            <div class="position-relative">
                <div class="arrow-down"></div>
                <div class="ellipsis-menu">Archive</div>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                page: 2,
                visible: false,
                messages: [],
                conversations: [],
                conversationId: null,
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
            clickEllipsis(id) {
                let elem = $(event.target);
                console.log(elem);
                if (! elem.hasClass('ellipsis')) {
                    console.log('Selecting parent');
                    elem = elem.parent();
                }
                console.log(elem.offset());
                $('#menu-bubble').css({'top':elem.offset().top+16,'left':elem.offset().left+15, opacity:1});
            },
            prevPage() {
                if (this.page > 1) this.page--;
            },
            nextPage() {
                if (this.page < 3) this.page++;
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
                this.page = 3;
            },
            scrollDown() {
                let msgWindow = $('#message-body');
                msgWindow.scrollTop(1000000);
                console.log('scrolling down');
            }
        },

        computed: {
            getClass() {
                if (this.page === 1) {
                    return 'left';
                } else if (this.page === 2) {
                    return 'middle';
                } else {
                    return 'right';
                }
            }
        }
    }

</script>
<style>
    .message.sent {
        margin-left: 70px;
        color: white;
        background: rgb(0, 132, 255);
    }

    .message.received {
        margin-right: 70px;
        color: black;
        background: rgb(241, 240, 240);
    }

    .ellipsis {
        cursor: pointer;
        margin:10px;
    }

    .menu-bubble {
        position:absolute;
        opacity:0;
        transition: opacity .4s ease-in-out;
    }

    .ellipsis-menu {
        left: -31px;
        position: absolute;
        background: black;
        color: white;
        border-radius: 1em;
        padding: 5px 10px 5px 10px;
        top: -47px;
    }

    .arrow-down {
        left: -10px;
        position: absolute;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #000;
        top: -15px;
    }

    .conversation-body {

    }

    .conversation-footer, .message-footer, .new-conversation-footer {
        padding: 20px;
        background: #ccc;
    }

    .conversation-header, .message-header, .new-conversation-header {
        padding: 20px;
        background: #ccc;
    }

    .conversation {
        background: #cca;
        margin: 10px;
        border-radius: 1em;
        cursor: pointer;
        padding: 5px 20px;
    }

    .message-body, .conversation-body, .new-conversation-body {
        overflow-y: auto;
        height: calc(100vh - 307px);
        overflow-x: hidden;
    }

    .message {
        background: #cca;
        margin: 10px;
        border-radius: 1em;
        cursor: pointer;
        padding: 5px 20px;
    }

    .chat-bubble {
        position: fixed;
        bottom: 25px;
        right: 25px;
        cursor: pointer;
    }

    .chat-window {
        transition: all .5s ease-in-out;
        border-radius: 2em;
        background: #f5f;
        width: 900px;
        height: 100%;
    }

    .wrapper {
        position: fixed;
        right: 25px;
        bottom: 100px;
        width: 300px;
        height: calc(100vh - 125px);
        max-height: 600px;
        min-height: 300px;
        overflow: hidden;
        border-radius: 2em;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.15);
        background: #aea;
    }

    .new-conversation, .conversation-window, .message-window {
        width: 300px;
        height: 100%;
        position: absolute;
        /*border-radius: 2em;*/
    }

    .new-conversation {
        background: #eaa;
        left: 0;
    }

    .conversation-window {
        background: #aae;
        left: 300px;
    }

    .message-window {
        background: #eea;
        left: 600px;
    }

    .middle {
        transform: translateX(-300px);
    }

    .right {
        transform: translateX(-600px);
    }

    .slide-enter-active, .slide-leave-active,
    .spin-enter-active, .spin-leave-active {
        transition: all .5s ease-in-out;
    }

    .slide-enter, .slide-leave-to {
        transform: translateX(100%);
    }

    .spin-enter, .spin-leave-to {
        transform: rotate(360deg);
    }


</style>