<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table" v-if="contacts.length > 0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in contacts">
                            <td> {{ contact.name }} </td>
                            <td> {{ contact.phone }} </td>
                            <td><button @click="editContact(contact.id)" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Edit</button></td>
                            <td><button @click="deleteContact(contact.id)" class="btn btn-danger">Delete</button></td>
                            <td v-if="contact.confirmed == 1"><button class="btn btn-success">Confirmed</button></td>
                            <td v-else><button @click="confirm(contact.id)" class="btn btn-info">Confirm</button></td>
                        </tr>
                    </tbody>
                </table>

                <p v-else>No Contacts available yet</p>

                <!--
                    This is the edit container/modal that gets triggered
                    when the Edit button is click on 
                 -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Update Contact Information</h4>
                            </div>
                            <div class="modal-body">
                                <div id="update-container">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" v-model="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" v-model="phone" class="phone-number form-control">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close btn btn-default" data-dismiss="modal">Cancel</button>
                                <button @click="update(id)" class="btn btn-warning">Update</button>
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
                contacts: [],
                id: '',
                name: '',
                phone: ''
            }
        },
        mounted() {

            // load all contacts when the component is mounted
            axios.get('/api/auth/contacts')
            .then(res => {
                this.contacts.push(...res.data);
            })
            .catch(err => console.log(err));
        },

        methods: {
            /**
             * id is the the equivalent id of the contact in question
             * This functino is used to confirm a contact information
             */
            confirm(id){
                axios.get('/api/confirmuser/' + id, {
                    'confirmed': true
                })
                .then(res => {
                    for(var i = 0; i < this.contacts.length; i++) {
                        if(this.contacts[i].id == id) {
                            this.contacts[i].confirmed = 1;
                        }
                    }
                })
                .catch(err => console.log(err));
            },
            /**
             * id is the the equivalent id of the contact in question
             * This function is used to update the contact information
             */
            update(id){
                console.log(this.name);
                if(this.name == '' || this.phone == ''){
                    return;
                } else {
                    axios.put('/api/updateContact/' + id, {
                        'name': this.name,
                        'phone': this.phone
                    })
                    .then(res => {
                        $(".close").click();
                        for(var i = 0; i < this.contacts.length; i++) {
                            if(this.contacts[i].id == id) {
                                this.contacts[i].name = this.name;
                                this.contacts[i].phone = this.phone;
                            }
                        }
                    })
                    .catch(err => console.log(err));                   
                }


            },

            /**
             * id is the the equivalent id of the contact in question
             * This is the function called by the edit modal before updating a contact
             * The values this.id,name and phone are binded to the form
             */
            editContact(id){
                for(var i = 0; i < this.contacts.length; i++) {
                    if(this.contacts[i].id == id) {
                        this.id = this.contacts[i].id;
                        this.name = this.contacts[i].name;
                        this.phone = this.contacts[i].phone;
                    }
                }
            },
            /**
             * id is the the equivalent id of the contact in question
             * This is the mehotd to delete a contact
             */
            deleteContact(id){
                axios.delete('/api/deleteContact/' + id)
                .then(res => {
                    for(var i = 0; i < this.contacts.length; i++) {
                        if(this.contacts[i].id == id) {
                            this.contacts.splice(i, 1);
                        }
                    }
                })
                .catch(err => console.log(err));
            }
        }
    }
</script>
