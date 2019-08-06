<template>
    <div id="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">Enter details</div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input v-model="user.email" type="email" class="form-control">
                            </div>                            
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input v-model="user.password" type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button @click="login" class="btn btn-primary">Save</button>
                            </div>                          
                        </div> 
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login(){
             /*   this.$store.dispatch('login', this.user);

                if(this.$store.state.users.is_logged){
                    this.$router.push('/');
                }
            */
            
                axios.get('/api/login')
                .then(res => {
                    console.log(res.data);
                })
                .catch(err => console.log(err));
            }
        }
    }
</script>

