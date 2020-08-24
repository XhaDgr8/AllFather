<template>
    <button type="button"
                class="btn btn-sm btn-outline-primary ml-50
                mb-50 mb-sm-0 cursor-pointer modelToggler">Select new photo</button>
</template>

<script>
export default {
    props: ['id'],
    data: () => ({
        imgSrc: ''
    }),
    created() {
        Event.$on('theSrc', (src)=>{
            this.imgSrc = src;
            axios.get('/avatar/'+this.id+'/'+ this.imgSrc)
                .then(response => {
                    this.$toastr.s('Image Updated SuccessFully');
                    window.location.reload();
                });
        });
    }
}
</script>
