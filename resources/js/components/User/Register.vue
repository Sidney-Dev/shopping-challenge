<template>
    <div id="registration">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">New Registration</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Surname</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <p v-if="reg_error" class="text-danger">This email has already been taken</p>
                                <input type="email" class="form-control" :class="{error: reg_error}">
                            </div>          
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" class="form-control">
                            </div>                                              
                            <h5>Address Information</h5>
                            <div id="address_box">
                                <div class="form-group">
                                    <label for="name">Street</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Suburb</label>
                                            <input type="text" class="form-control">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Town</label>
                                            <input type="text" class="form-control">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Postal Code</label>
                                            <input type="text" class="form-control">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Type</label>
                                            <select class="form-control">
                                                <option value="Residential">Residential</option>
                                                <option value="Residential">Business</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button @click="register" class="btn btn-primary">Save</button>
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
            reg_user: {
                name: 'Sidney',
                email: 'email@gmail.com'
            }
        }
    },
    methods: {
        register(){
            this.$store.dispatch('register', this.reg_user);
        }
    },
    mounted(){
       // console.log(this.users);
    },
    computed: {
        users(){
            return this.$store.getters.users;
        },
        reg_error(){
            return this.$store.getters.reg_error;
        }
    }
}
</script>

