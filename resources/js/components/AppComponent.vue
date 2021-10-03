<template>
    <main>
        <div class="container">
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
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Counter</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(counter, address, index) in otherUsers" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ address }}</td>
                        <td>{{ counter }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>

<script>
import axios from 'axios';
import Vue from 'vue';
import { addChannel } from '@/utils/broadcast';
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
                const { data } = await counterIncrease();
            } catch (error) {
                console.log(error.message);
            }
        }
    },
    data: function() {
        return {
            counter: this.users.counter,
            otherUsers: {}
        }
    },
    mounted: function() {
        addChannel('connected', 'ConnectMessage', e => {
            Vue.set(this.otherUsers, e.user.username, e.user.counter);
            Echo.channel('laravel_database_increase_' + e.user.username).listen('IncreaseMessage', e => {
                this.otherUsers[e.user.username] += 1;
            });
        });
        addChannel('increase_' + this.users.username, 'IncreaseMessage', e => {
            this.counter += 1;
        });
        this.users.other.forEach(element => {
            Vue.set(this.otherUsers, element.username, element.counter);
            addChannel('increase_' + element.username, 'IncreaseMessage', e => {
                this.otherUsers[element.username] += 1;
            });
        });
    }
}
</script>