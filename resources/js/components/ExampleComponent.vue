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
        <transition name="fade">
            <div v-if="open" class="chat-bubble" @click="open=!open">
                <span class="fa-stack fa-2x fa-lg">
                    <i class="fa fa-circle fa-stack-2x chat-color"></i>
                    <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        </transition>
        <transition name="rollup">
            <div v-if="open" class="chat-window chat-shadow">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eum iusto laudantium modi sequi tenetur vero? Adipisci aliquid cum distinctio dolorum facilis, magni maiores necessitatibus nisi quaerat rem vel velit</p>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                open: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
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
