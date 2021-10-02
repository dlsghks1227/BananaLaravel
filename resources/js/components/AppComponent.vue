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
                        <th>ID</th>
                        <th>Counter</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(counter, address) in otherPlayers" :key="address">
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
        playersData: {
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
            counter: this.playersData.counter,
            otherPlayers: {}
        }
    },
    mounted: function() {
        addChannel('connected', 'ConnectMessage', e => {
            Vue.set(this.otherPlayers, e.player.address, e.player.counter);
            Echo.channel('laravel_database_increase_' + e.player.address).listen('IncreaseMessage', e => {
                this.otherPlayers[e.player.address] += 1;
            });
        });
        addChannel('increase_' + this.playersData.address, 'IncreaseMessage', e => {
            this.counter += 1;
        });
        this.playersData.players.forEach(element => {
            Vue.set(this.otherPlayers, element.address, element.counter);
            addChannel('increase_' + element.address, 'IncreaseMessage', e => {
                this.otherPlayers[element.address] += 1;
            });
        });
    }
}
</script>