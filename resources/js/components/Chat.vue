<template>
    <div>
        <button class="btn btn-primary" @click="prevPage()">Left</button>
        <button class="btn btn-primary" @click="nextPage()">Right</button>
        <button class="btn btn-primary" @click="visible = !visible">Toggle</button>
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
            <div v-show="visible">
                <div class="wrapper shadow">
                    <div class="chat-window" :class="getClass">
                        <div class="new-conversation">
                        </div>

                        <div class="conversation-window">
                        </div>

                        <div class="message-window">
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                visible: false,
                page: 2
            }
        },
        methods: {
            nextPage() {
                if (this.page < 3) {
                    this.page++;
                }
            },
            prevPage() {
                if (this.page > 1) {
                    this.page--;
                }
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
    .wrapper {
        left:auto;
        position: fixed;
        right: 25px;
        bottom: 100px;
        width: 300px;
        height: 600px;
        overflow: hidden;
        border-radius: 2em;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .chat-window {
        position: absolute;
        width: 900px;
        height: 600px;
        background: #aee;
        transition: all .3s;
        border-radius: 2em;
    }

    .right {
        transform: translateX(-600px);
    }

    .middle {
        transform: translateX(-300px);
    }

    .new-conversation, .conversation-window, .message-window {
        position: absolute;
        top: 0;
        width: 300px;
        height: 600px;
        border-radius: 2em;
    }

    .new-conversation {
        background: #eaa;
        left: 0;
    }

    .conversation-window {
        background: #aea;
        left: 300px;
    }

    .message-window {
        background: #aae;
        left: 600px;
    }

    .chat-bubble {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }

    .spin-enter-active, .spin-leave-active,
    .slide-enter-active, .slide-leave-active {
        transition: all .5s ease-in-out;
    }

    .spin-enter, .spin-leave-to {
        transform: rotate(720deg);
    }

    .slide-enter, .slide-leave-to {
        transform: translateX(100%);
        opacity:0;
    }

</style>