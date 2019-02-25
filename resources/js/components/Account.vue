<template>
    <form v-on:submit.prevent="save()" spellcheck="false" class="main-form">
        <h1>Your account</h1>

        <validation :errors="errors" :success="success"></validation>

        <input type="text" name="name" v-model="user.name" placeholder="Full name">
        <input type="text" name="email" v-model="user.email" value="2" placeholder="Email address">
        <input type="password" name="password" v-model="user.password" placeholder="Password">

        <div class="buttons">
            <button class="btn" :disabled="checkDifference()">Save changes</button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            userLoaded: [],
            user: [],
            errors: [],
            success: ''
        }
    },
    created() {
        this.getUser();
    },
    methods: {
        getUser() {
            var opts = {
                url: 'api/user',
                method: 'get',
                headers: {
                    'Authorization': `Bearer ${api_token}`,
                    'Content-type': 'Application/json',
                    'Accept': 'Application/json'
                }
            }

            axios(opts).then((res) => {
                this.user = res.data.data;
                this.userLoaded = JSON.parse(JSON.stringify(res.data.data));
            }).catch((err) => {
                console.log(err);
            })
        },
        checkDifference() {
            if (this.user.email != this.userLoaded.email || this.user.name != this.userLoaded.name) {
                return false;
            }
            
            return true;
        },
        save() {
            var opts = {
                url: 'api/user',
                method: 'post',
                headers: {
                    'Authorization': `Bearer ${api_token}`,
                    'Content-type': 'Application/json',
                    'Accept': 'Application/json'
                },
                data: {
                    _method: 'PUT',
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password
                }
            }

            axios(opts).then((res) => {
                this.errors  = []
                this.success = 'Successfully updated your account'
                this.userLoaded = JSON.parse(JSON.stringify(res.data.data));
            }).catch((err) => {
                if (err.response.status == "422") {
                    this.errors = err.response.data.errors;
                    this.success = ''
                }
            })
        }
    }
}
</script>
