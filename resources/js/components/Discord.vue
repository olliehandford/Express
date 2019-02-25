<template>
    <div class="discord" v-if="loaded">

        <h1>Your discord account</h1>

        <validation :errors="errors" :success="success"></validation>

        <div class="item" v-if="discord.id" >
            <img :src="discord.avatar" alt="Profile picture">
            <h2>{{ discord.username }}</h2>
            <span>{{ discord.id }}</span>
        </div>
        
        <span v-if="!discord.id">You do not yet have a discord account connected to Express Notify. Please click the button below to join the Discord</span>
        <div class="buttons">
            <a v-if="discord.id" v-on:click="unlinkDiscord()" class="btn">Unlink Discord</a>
            <a v-else href="discord/join" class="btn">Link Discord</a>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            discord: {},
            errors: [],
            success: '',
            loaded: false,
            instance: axios.create({
                headers: {
                    'Authorization': `Bearer ${api_token}`,
                    'Content-type': 'Application/json',
                    'Accept': 'Application/json'
                }
            })
        }
    },
    mounted() {
        this.getDiscord()
    },
    methods: {
        getDiscord() {
            this.instance.get('api/discord').then((res) => {
                this.discord = res.data;
                this.loaded = true;
            }).catch((err) => {
                console.log(err)
            })

        },
        unlinkDiscord() {
            var opts = {
                url: 'api/discord',
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${api_token}`,
                    'Content-type': 'Application/json',
                    'Accept': 'Application/json'
                }
            }

            axios(opts).then((res) => {
                this.errors  = [],
                this.success = res.data.success;
                this.discord = {}
            }).catch((err) => {
                if (err.response.status == "422") {
                    this.success = '',
                    this.errors = err.response.data.errors;
                }
            })
        }
    }
}
</script>