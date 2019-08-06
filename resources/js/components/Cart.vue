<template>
    <div>
        <a href="/login" class="nav-link cart-icon" v-if="this.$store.state.orders.logged == 'false'">
            <span v-if="order_count != 0">{{ order_count }}</span>
        </a>
        <a @click="view_order" data-toggle="modal" data-target="#myModal" class="nav-link cart-icon" v-else>
            <span v-if="order_count != 0">{{ order_count }}</span>
            
        </a>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- CART DETAIL HERE-->
                <div class="modal-content">
                           
                    <div class="modal-header justify-content-center">
                        <h3 class="text-center">Order Information</h3>
                    </div>
                    <div class="modal-body">
                        <p v-if="order.length > 0"><strong>Total: </strong>R {{ total }}</p>
                        <div class="text-center" v-if="order_confirmed">See confirmed orders here</div>
                        <div class="text-center" v-if="!order_confirmed && order.length < 1">Nothing added</div>
                        <table v-if="order.length > 0">
                            
                            <tbody>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Description</th>
                                <th>Price</th>
                            </tbody>
                            <tr v-for="o in order">
                                <td>{{ o.title }}</td>
                                <td><img :src="o.image" :alt="o.title"></td>
                                <td>{{ o.description | description_filter }}</td>
                                <td><strong>R {{ o.price }}</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer" v-if="order.length > 0">
                        <button v-if="is_logged" class="btn btn-success" @click="confirm_order">Confirm Order</button>
                        <a class="btn btn-info" href="/login" v-else-if="!is_logged && order.length > 0">Login/Register to confirm Order</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-footer" v-else>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                 <!-- END OF CART DETAILS -->

            </div>
        </div>
    </div>

</template>
<script>
export default {
    data(){
        return{
            order: [],
            products: [],
            is_logged: false,
            has_order: true,
            order_confirmed: false,
            confirm_login: false,
            total: 0
        }
    },
    methods: {
        calc_order(){
            this.order.forEach(element => {
                this.total = parseFloat(this.total) + parseFloat(element.price);
            });
            return this.total;

            localStorage.removeItem('order');
            localStorage.setItem('order', JSON.stringify(this.order));
        },
        view_order(){
            if (localStorage.getItem('order')) {
                try {
                    this.order = JSON.parse(localStorage.getItem('order'));
                    this.$store.dispatch('list_orders', this.order);
                    this.order.forEach(element => {
                    this.total = parseFloat(this.total) + parseFloat(element.price);
                });

               // localStorage.removeItem('order');
                //localStorage.setItem('order', JSON.stringify(this.order));
                } catch(e) {
                    localStorage.removeItem('order');
                }
            }

        },
        confirm_order(){
            this.order.forEach(element => {
                axios.post('api/order/confirm', {
                    product_id: element.id
                })
                .then(res => {
                    localStorage.removeItem('order');
                    this.order = [];                
                    this.$store.dispatch('list_order_length', this.order.length);
                    this.$store.dispatch('list_orders', this.order);
                    this.order_confirmed = true;
                })
                .then(()=> {
                    setTimeout(function(){
                        window.location.href = '/my-order/products';
                    },500);
                })
                .catch(err => console.log(err));
            });
        }
    },
    mounted(){
        /**
         * Fetch data from storage if it exists
         * If the storage has data, then assign all the data to the store value
         *****and dispatch to list_orders action
         */
        if (localStorage.getItem('order')) {
            try {
                this.order = JSON.parse(localStorage.getItem('order'));
                this.$store.dispatch('list_order_length', this.order.length);
                this.$store.dispatch('list_orders', this.order);
            } catch(e) {
                localStorage.removeItem('order');
            }
        }
        /**
         * Validate if the user is logged in
         * If so, update the is_logged data attribute to true
         * The is_logged will determine when the user is able to confirm an order or not
         */
        axios.get('api/isLogged')
            .then(res => {
                console.log(res.data);
                const logged = res.data;
               if(logged == 'not_logged'){
                    this.is_logged = false;
                    console.log(this.is_logged);
                } 
                if(logged.is_logged == 'is_logged'){
                    this.is_logged = true; 
                    console.log(this.is_logged);
                }
            })
            .catch(err => console.log(err));
    },
    computed: {
        my_orders(){
            return this.$store.getters.order;
        },
        order_count(){
            return this.$store.state.orders.order_length;
        }
    }
}
</script>

<style scoped>
    .modal-dialog{
        max-width: 1000px;
    }
    img{
        width: 140px;
    }
    h3{
        display: block;
    }


</style>
