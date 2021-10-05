<template>
    <main class="message-container">
        <div class="title">
            <button type="button" class="btn" v-on:click="up">up</button>
            <button type="button" class="btn" v-on:click="down">down</button>
            <!-- <button ref="customButton" type="button" class="container custom-button" v-on:click="increase">Click me</button> -->
        </div>
        <div class="message-area">
            <div class="message-list" ref="messageList">
                <transition-group name="message-list" tag="div">
                    <div class="message" v-for="(counter, address, index) in otherUsers" :key="address">
                        <div>{{ address }}</div>
                        <div>{{ otherUsers[address] }}</div>
                    </div>
                </transition-group>
            </div>
            <div class="message-list">
                <div class="message">
                    Test
                </div>
            </div>
            <div class="message-list">
                <div class="message">
                    Test
                </div>
            </div>
        </div>
        <!-- <div class="container rank-table">
            <div class="d-flex justify-content-center mb-4">
                <div class="p-2 w-100">
                    <h1>클릭 클릭</h1>
                </div>
                <div class="p-2 flex-shrink-0">
                    <h1>{{ this.counter }}</h1>
                </div>
            </div>
            <button ref="customButton" type="button" class="container custom-button" v-on:click="increase">Click me</button>
            <div class="p-5"></div>
            <transition-group name="message-list" tag="div">
                <tr v-for="(counter, address, index) in otherUsers" :key="address">
                    <td>{{ index + 1 }}</td>
                    <td>{{ address }}</td>
                    <td>{{ otherUsers[address] }}</td>
                </tr>
            </transition-group>
        </div>
        <div style="height: 10%;">
            <button type="button" class="btn" v-on:click="up">up</button>
            <button type="button" class="btn" v-on:click="down">down</button>
        </div>
        <div ref="refMessageContainer" class="message-container">
            <div ref="refTitle" class="title">
            </div>
            <div ref="refMessageList" class="message-list">
                <transition-group name="message-list" tag="tbody">

                <div v-for="(item, key, index) in items" :key="key" ref="message">
                    <div class="message">
                        <div>{{ item }}</div>
                    </div>
                </div>
                </transition-group>

            </div>
        </div> -->
    </main>
</template>

<script>
import Vue from 'vue';
import { 
    addChannel,
    addIncreaseChannel
} from '@/utils/broadcast';
import { counterIncrease } from '@/api/index';

export default {
    props: {
        users: {
            type: Object,
            required: true
        }
    },
    methods: {
        // https://stackoverflow.com/questions/44072750/how-to-send-basic-auth-with-axios
        increase: async function()
        {
            // try {
            //     // 비즈니스 로직
            //     const userData = {
            //         username: this.username,
            //         password: this.password,
            //         nickname: this.nickname
            //     }
            //     const { data } = await registerUser(userData);
            // } catch (error) {
            //      // 에러 핸들링
            //     console.log(error.message);
            // } finally {

            // }
            try {
                // https://stackoverflow.com/questions/32349838/lodash-sorting-object-by-values-without-losing-the-key
                const { data } = await counterIncrease();
            } catch (error) {
                console.log(error.message);
            }
        },

        up: async function()
        {
            const refMessage = this.$refs.messageList;
            this.position -= 100;
            refMessage.style.transform = "translate(0px, " + this.position + "px)";
            // // this.items = _.orderBy(this.items, 'value', 'asc');
            // this.items = _.chain(this.items).map((val, key) => {
            //     return {name: key, count: val}
            // }).orderBy('count', 'asc').keyBy('name').mapValues('count').value()
        },

        down: async function()
        {
            const refMessage = this.$refs.messageList;
            console.log(refMessage);
            this.position += 100;
            refMessage.style.transform = "translate(0px, " + this.position + "px)";
            // // his.items = _.orderBy(this.items, 'value', 'desc');  
            // this.items = _.chain(this.items).map((val, key) => {
            //     return {name: key, count: val}
            // }).orderBy('count', 'desc').keyBy('name').mapValues('count').value()
        }
    },
    data: function() {
        return {
            counter: this.users.counter,
            otherUsers: {},
            position: 0
        }
    },
    mounted: function() {
        addChannel('connected', 'ConnectMessage', element => {
            Vue.set(this.otherUsers, element.user.username, element.user.counter);
            addChannel('increase_' + element.user.username, 'IncreaseMessage', e => {
                this.otherUsers[element.user.username] += 1;

                this.otherUsers = _.chain(this.otherUsers).map((val, key) => {
                    return {name: key, count: val}
                }).orderBy('count', 'desc').keyBy('name').mapValues('count').value()
            });
        });
        addChannel('increase_' + this.users.username, 'IncreaseMessage', e => {
            this.counter += 1;
        });
        this.users.other.forEach(element => {
            Vue.set(this.otherUsers, element.username, element.counter);
            addChannel('increase_' + element.username, 'IncreaseMessage', e => {
                this.otherUsers[element.username] += 1;

                this.otherUsers = _.chain(this.otherUsers).map((val, key) => {
                    return {name: key, count: val}
                }).orderBy('count', 'desc').keyBy('name').mapValues('count').value()
            });
        });

        const refMessage = this.$refs.messageList;
        refMessage.style.transition = "1s";
        // var position = 0;
        // setInterval(function() {
        //     this.position += 100;
        // }, 10000);
    },
}
</script>