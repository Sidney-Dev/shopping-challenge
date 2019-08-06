<template>
    <div class="container">
        <div class="row">
            <div v-for="product in products" class="col-12 cold-lg-4 col-md-4 col-xs-6">
                
                <div class="card mb-2">
                    <div class="card-he">
                        <img :src="product.image" alt="product image">
                    </div>
                    <div class="card-body">
                        <div><span class="title">{{ product.title }}</span> | <span class="price"><strong>R {{ product.price }}</strong></span> </div>
                        <p><strong>Short Description: </strong>{{ product.description | description_filter }}</p>
                    </div>
                    <div class="card-footer d-flex">
                        <button @click="make_order(product)" class="add-cart btn btn-primary mr-2">Add To Cart</button>
                        <button class="btn btn-info" data-toggle="modal" data-target="#singleProductModal">View Full</button>
                    </div>
                </div>

                <div id="singleProductModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col col-md-4">
                                        <img :src="product.image" alt="product image">
                                    </div>
                                    <div class="col col-md-8">
                                        <div>
                                            <h2 class="title">{{ product.title }}</h2>
                                            <p class="price"><strong>Price:</strong> R {{ product.price }}</p> 
                                        </div>
                                        <div>
                                            <strong>Description:</strong>
                                            {{ product.description }}
                                        </div>
                                        <button @click="make_order(product)" class="add-cart btn btn-primary mt-2">Add To Cart</button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            
            order: []
        }
    },
    mounted(){
        /**
         * This action fires an axios request used to list all products
         * On success, it commits a mutation which saves a new state with product values
         * The state value is access via the getters and used here as a computed property(products)
         */
        this.$store.dispatch('products');     
    },
    methods: {
       make_order(product){            

            if (localStorage.getItem('order')) {
                if (this.order.find(o => o.id === product.id)) {
                    console.log("Add a new property that will identify that this product exists in the cart already");
                    console.log("Maybe we can loop through the storage products and check which one has already been added");
                    alert("Product selected");
                } else {
                    this.order.push(product);
                    localStorage.setItem('order', JSON.stringify(this.order));
                    this.$store.dispatch('list_orders', this.order);
                    this.$store.dispatch('list_order_length', this.order.length);
                }

            } else {
                this.order.push(product);
                localStorage.setItem('order', JSON.stringify(this.order));
                this.$store.dispatch('list_orders', this.order);
                this.$store.dispatch('list_order_length', this.order.length);

            }
            
        }
    },
    computed: {
        products(){
            return this.$store.getters.products;
        }
    }
}
</script>
<style>
    img{
        width: 100%;
    }
    .modal-dialog{
        max-width: 1000px;
    }
</style>

