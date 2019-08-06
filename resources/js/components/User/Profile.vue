<template>
    <div id="profile">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Profile Information</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input v-model="user.name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Surname</label>
                                <input v-model="user.surname" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input v-model="user.email" type="email" class="form-control">
                            </div>          
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input v-model="password" type="password" class="form-control">
                            </div>                                              
                            <h5>Address Information</h5>
                            <div id="address_box">
                                <div class="form-group">
                                    <label for="name">Street</label>
                                    <input v-model="user.street_address" type="text" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Suburb</label>
                                            <input v-model="user.suburb" type="text" class="form-control">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Town</label>
                                            <input v-model="user.city" type="text" class="form-control">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Postal Code</label>
                                            <input v-model="user.postal_code" type="text" class="form-control">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Type <strong>(Specify or select)</strong></label>
                                            <input type="text" v-model="user.address_type">
                                            <select v-model="user.address_type" class="form-control">
                                                <option value="residential">Residential</option>
                                                <option value="business">Business</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button @click="update_user" class="btn btn-primary">Save</button>
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
            user: '',
            password: ''
        }
    },
    methods: {
        update_user(){
            axios.post('api/user/update', {
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                password: this.password,
                street_address: this.street_address,
                address_type: this.user.address_type,
                suburb: this.user.suburb,
                city: this.user.city,
                postal_code: this.user.postal_code,
            })
            .then(res => console.log(res.data))
            .catch(err => console.log(err));
        }
    },
    mounted(){
        axios.get('api/isLogged')
            .then(res => {
                this.user = res.data.user;
                    setTimeout(function(){
                        alert("Details updated");
                    },500);                
            })
            .catch((err) => {

                alert("Something went wrong");
                console.log(err)
            });
    }
}
</script>

<style scoped>
input, select{
    text-transform: capitalize;
}
</style>
