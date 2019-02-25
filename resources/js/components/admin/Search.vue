<template>
    <div class="users">
        <h1>Admin Search</h1>

        <form class="search">
            <input type="text" v-model="query" v-on:keyup="search()" placeholder="Search anything">
        </form>

        <div class="results">

            <p v-if="results.keys.length == 0 && !loading">Search for users, payments, keys, discords and subscriptions</p>
            <p v-if="loading">Please wait. We are currently searching for relevant results.</p>

            <div class="type" v-for="(value, key) in results.keys" v-bind:key="key">
                <h3 v-if="results.data[value].length > 0">{{ value }}</h3>
                <div class="item" v-for="(v, k) in results.data[value]" v-bind:key="k">
                    <div class="info">
                        <h2>{{ v[Object.keys(v)[0]] }}</h2>
                        <span>{{ v[Object.keys(v)[1]] }}</span>
                    </div>
                    <span>{{ v[Object.keys(v)[2]] }}</span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            query: '',
            results: {
                keys: [],
                data: []
            },
            timer: {
                done: 300,
                interval: ''
            },
            loading: false,
            instance: axios.create({
                headers: {
                    'Authorization': `Bearer ${api_token}`,
                    'Content-type': 'Application/json',
                    'Accept': 'Application/json'
                }
            })
        }
    },
    methods: {
        search() {
            // Make load and empty data

            clearTimeout(this.timer.interval);

            this.results.keys = []
            this.results.data = []
            this.loading = true


            // Create timeout
            this.timer.interval = setTimeout(() => {
                this.makeRequest();
            }, this.timer.done)
            
        },
        makeRequest() {
            this.instance.get(`../api/admin/search/${this.query}`).then((res) => {
                this.results.keys = Object.keys(res.data)
                this.results.data = res.data;
                this.loading = false;
            }).catch((err) => {
                this.loading = false;
                this.results.keys = []
                this.results.data = []
            })
        }
    }
}
</script>


<style scoped>
    .item {
        display: flex;
        justify-content: space-between;
    }

    .item h2 {
        min-width: 200px;
    }

    .type h3 {
        font-size: 18px;
    }

    .info {
        display: flex;

    }
</style>
