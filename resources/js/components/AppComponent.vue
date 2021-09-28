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
            <div class="d-grid gap-2 mb-4">
                <button type="button" class="btn btn-primary btn-lg" v-on:click="increase">Click me</button>
            </div>
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
export default {
    
    mounted() {
        Echo.channel('laravel_database_connected').listen('ConnectMessage', e => {
            Vue.set(this.otherPlayers, e.player.address, e.player.counter);
            Echo.channel('laravel_database_increase_' + e.player.address).listen('IncreaseMessage', e => {
                this.otherPlayers[e.player.address] += 1;
            });
        });
        Echo.channel('laravel_database_increase_' + this.playersData.address).listen('IncreaseMessage', e => {
            this.counter += 1;
        });
        this.playersData.players.forEach(element => {
            Vue.set(this.otherPlayers, element.address, element.counter);
            Echo.channel('laravel_database_increase_' + element.address).listen('IncreaseMessage', e => {
                this.otherPlayers[element.address] += 1;
            });
        });
    },
    props: {
        playersData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            counter: this.playersData.counter,
            otherPlayers: {}
        }
    },
    methods: {
        increase: function(event)
        {
            axios.post('http://125.134.138.184/increase')
                .then(function(response) {
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
}
</script>