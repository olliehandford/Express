<template>
    <div class="discord" v-if="loaded">

        <h1>Welcome, Conor</h1>

        <div class="activated" v-if="user.activation_key">
            <div class="item">
                <h2>{{ user.activation_key }}</h2>
                <span>{{ user.expires_on }}</span>
            </div>

           
        </div>

        <div class="active">
            <p v-if="!user.expired">You have an active subscription which is due to automatically renew on the {{ user.expires_on }}. You have full access to our features and software</p>
            <div class="buttons">
                <button class="btn primary">Manage payments</button>
            </div>
        </div>
         



        <div class="expired" v-if="user.expired">
            <p>You have previously had an active subscription but it expired on the {{ user.expires_on }}. You will have to renew in order to rejoin the discord server and regain access to our features.</p>
            <div class="buttons">
                <button class="btn primary">Renew key</button>
            </div>
        </div>

        <div class="not-activated" v-if="!user.activation_key">
            <p >It doesn't seem like you have an express membership linked to your account. You will be unable to access our features, use our tools and join our discord until you have activated a key.</p>
            <div class="buttons">
                <button class="btn primary">Activate key</button>
            </div>
        </div>
        
    
    </div>

</template>

<script>
export default {
    data() {
        return {
            loaded: false,
            user: {},
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
        this.instance.get('api/user').then((res) => {
            console.log(res.data);

            this.user.id = res.data.id,
            this.user.activation_key = res.data.activation_key,
            this.user.expires_on = res.data.expires_on

            this.loaded = true;

        }).catch((err) => {
            console.log("Error!");
            console.log(err);
        })
    }
}
</script>

<style scoped>
    h2 {
        letter-spacing: 1.2px;
    }
</style>
