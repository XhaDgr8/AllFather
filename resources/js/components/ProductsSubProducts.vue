<template>
    <div style="max-height: 25rem; overflow-y: scroll" class="row px-2 w-100 mx-auto">
        <div v-for="(subProduct, index) in subProducts" :key="index"
             class="col-12 rounded-lg my-3 p-2 shadow-sm-primary">
            <div class="row ">
                <div class="col-3 p-2">
                    <img v-if="subProduct['image'] != null" :src="`${assets}/${subProduct['image']}`"
                         class="m-0 p-0 rounded-lg" style="vertical-align: middle;width: 8rem;height: 8rem;">
                    <img v-else-if="subProduct['image'] === null"
                         :src="assetselse"
                         class="m-0 p-0 rounded-lg" style="vertical-align: middle;width: 8rem;height: 8rem;">
                </div>
                <div class="col-9">
                    <div class="row ml-2">
                        <div class="col-12">
                            <h4>{{ subProduct['name'] }}</h4>
                        </div>
                        <div class="col-6">
                            <p>
                                <strong>Cat No: </strong>
                                <span class="text-muted">{{ subProduct['cat_number']}}</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <strong>Category: </strong>
                                <span class="text-muted">{{ subProduct['category']}}</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <strong>In Stock:
                                    <span class="text-success">{{ subProduct['stock_quantity']}}</span>
                                </strong>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <strong>Price Per Unit:
                                    <span class="text-success">$ {{ subProduct['price_per_unit']}}</span>
                                </strong>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <strong>Buying Unit:
                                    <span class="text-info">{{ subProduct['buying_unit']}}</span>
                                </strong>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <strong>Production Unit:
                                    <span class="text-info">{{ subProduct['production_unit']}}</span>
                                </strong>
                            </p>
                        </div>
                        <div class="col-6">
                            <Qtty :productid="productid" :subproductid="subProduct['id']"/>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-auto">
                                    <button type="button" @click="detachFromProduct(subProduct['id'])"
                                       class="btn btn-link text-decoration-none btn-outline-danger rounded-lg shadow-sm">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" class="color-danger"
                                            width="1.5rem" height="1.5rem" focusable="false" role="img"
                                            viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a :href="`/sub-product/${subProduct['id']}/edit`"
                                       class="btn btn-link text-decoration-none btn-outline-primary rounded-lg shadow-sm-primary">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="1.5rem" height="1.5rem" focusable="false" role="img"
                                            viewBox="0 0 576 512"><path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Qtty from "./Qtty";
export default {
    props: ['url', 'assets','assetselse', 'productid'],
    components: {
        Qtty
    },
    data: () => ({
        subProducts: [],
    }),
    created() {
        axios.post(this.url)
            .then(response => {
                this.subProducts = response.data;
            });
        Event.$on('fromProduct', ()=>{
            axios.post(this.url)
                .then(response => {
                    this.subProducts = response.data;
                });
        });
    },
    methods: {
        changeQuantity(){
            console.log(this.quantity)
        },
        detachFromProduct(subproductid){
            axios.post('/detachFromProduct/'+this.productid+'/'+subproductid)
                .then(response => {
                    this.$toastr.s(response.data);
                    Event.$emit('fromProduct');
                });
        }
    }
}
</script>
