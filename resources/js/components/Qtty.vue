<template>
    <div>
        <p class="m-0">
            <strong>QTTY:
                <span class="text-info">{{ quantity }}</span>
            </strong>
            Add Qtty
        </p>
        <div class="form-group">
            <fieldset class="w-100 position-relative">
                <input v-on:change="changeQuantity" v-model="newQuantity" :id="subproductid"
                       type="numeric" class="form-control border-primary border"
                       placeholder="auto" required>
                <label class="small" :for="subproductid" style="pointer-events: none">
                    {{quantity}}
                </label>
            </fieldset>
        </div>
    </div>
</template>

<script>
export default {
    props: ['productid', 'subproductid'],
    data: () => ({
        quantity: '',
        newQuantity: '',
    }),
    created(){
        axios.post('/getQuantity/'+this.productid+'/'+this.subproductid)
            .then(response => {
                this.quantity = response.data
            });
    },
    methods: {
        changeQuantity(){
            axios.post('/changeQuantity/'+this.productid+'/'+this.subproductid+'/'+this.newQuantity)
                .then(response => {
                    this.quantity = response.data;
                    Event.$emit('fromProduct');
                    this.$toastr.s("Quantity Updated Successfully to " + response.data);
                });
        }
    }
}
</script>
