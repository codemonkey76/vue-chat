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
                        <div class="new-conversation">Page 1</div>
                        <div class="conversation-window">Page 2</div>
                        <div class="message-window">Page 3</div>
                    </div>
                </div>
            </template>
        </transition>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                page: 2,
                visible: false
            }
        },
        methods: {
          prevPage() {
              if (this.page>1) this.page--;
          } ,
          nextPage() {
              if (this.page<3) this.page++;
          }
        },
        computed: {
            getClass() {
                if (this.page===1) {
                    return 'left';
                } else if (this.page===2) {
                    return 'middle';
                } else {
                    return 'right';
                }
            }
        }
    }

</script>
<style>
    .chat-bubble {
        position: fixed;
        bottom: 25px;
        right: 25px;
    }
    .chat-window {
        transition: all .5s ease-in-out;
        border-radius:2em;
        background:#f5f;
        width:900px;
    }
    .wrapper {
        position: fixed;
        right: 25px;
        bottom: 100px;
        width: 300px;
        height: 600px;
        overflow:hidden;
        border-radius:2em;
        box-shadow: 0 0 1rem rgba(0,0,0,0.15);
        background: #aea;
    }
    .new-conversation, .conversation-window, .message-window {
        width:300px;
        height:600px;
        position:absolute;
        border-radius:2em;
        padding:20px;
    }
    .new-conversation {
        background: #eaa;
        left:0;
    }
    .conversation-window {
        background: #aae;
        left:300px;
    }
    .message-window {
        background: #eea;
        left:600px;
    }
    .middle {
        transform:translateX(-300px);
    }
    .right {
        transform:translateX(-600px);
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