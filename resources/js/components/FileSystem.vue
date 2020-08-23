<template>
    <div class="row w-100 mx-auto overflow-hidden border-0 modal-content shadow-md rounded-lg">
        <div class="col-12 bg-primary py-2">
            <h3 class="text-white m-0 d-inline font-weight-normal">Chose a File</h3>
            <button class="bg-white modelToggler py-0 close-modal float-right d-inline btn btn-sm shadow-sm rounded-lg text-dark">
                <span class="p-0 m-0" aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- right content section -->
        <div class="col-12 bg-light pt-3">
            <div class="container-fluid">
                <div class="container mb-4 my-2">
                    <div v-show="images.length">
                        <div class="d-flex p-0 flex-row justify-content-end mb-3">
                            <label for="fileUpload" class="btn btn-sm shadow-sm btn-outline-primary">
                                Select a File from PC
                            </label>
                            <button @click="upload" class="btn border-0 ml-3 btn-primary btn-sm shadow-sm-primary">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width=".6rem" class="h-auto mb-1 mx-auto" focusable="false" role="img"
                                    viewBox="0 0 384 512"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm65.18 216.01H224v80c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16v-80H94.82c-14.28 0-21.41-17.29-11.27-27.36l96.42-95.7c6.65-6.61 17.39-6.61 24.04 0l96.42 95.7c10.15 10.07 3.03 27.36-11.25 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z"></path>
                                </svg>
                                Upload
                            </button>
                        </div>
                    </div>
                    <div v-show="!images.length" class="mx-auto cursor-pointer">
                        <label class="file-upload w-100 rounded-lg p-3 cursor-pointer"
                               for="fileUpload"
                               @dragenter="OnDragEnter"
                               @dragleave="OnDragLeave"
                               @drop="OnDrop"
                               @dragover.prevent
                               :class="{ dragging : isDragging }"
                        >
                            <div style="pointer-events: none" class="w-auto text-white d-flex flex-column justify-content-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="1.5rem" class="h-auto mx-auto mb-3" focusable="false" role="img"
                                    viewBox="0 0 384 512"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm65.18 216.01H224v80c0 8.84-7.16 16-16 16h-32c-8.84 0-16-7.16-16-16v-80H94.82c-14.28 0-21.41-17.29-11.27-27.36l96.42-95.7c6.65-6.61 17.39-6.61 24.04 0l96.42 95.7c10.15 10.07 3.03 27.36-11.25 27.36zM377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z"></path>
                                </svg>
                                <h4 class="m-0 text-center">
                                    Select or Drag in From Computer
                                </h4>
                            </div>
                        </label>
                        <input type="file" @change="onInputChange" multiple name="file" id="fileUpload" hidden>
                    </div>
                    <div v-show="images.length" class="row bg-primary rounded-lg pt-2">
                        <div class="col-4 mb-3" v-for="(image, index) in images" :key="index">
                            <div class="p-2 bg-white rounded-lg shadow-md">
                                <div style="max-height: 5rem" class="overflow-hidden">
                                    <img class="img-fluid w-100" :src="image" :alt="`image uploader ${index}`">
                                </div>
                                <div class="text-dark">
                                    <p class="m-0 small text-truncate" v-text="files[index].name"></p>
                                    <p class="m-0 small overflow-hidden" v-text="files[index].size"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container" style="max-height: 25rem;overflow-y: scroll;">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12 mb-3" v-for="(image, index) in dbfiles" :key="index">
                            <div class="p-2 bg-white rounded-lg shadow-md">
                                <div style="max-height: 10rem" class="overflow-hidden">
                                    <img class="img-fluid w-100" :src="`${asset}/${image}`" :alt="`image uploader ${index}`">
                                </div>
                                <div class="row mt-2 g-0">
                                    <div class="col px-1">
                                        <button @click="push(image)" type="text" class="btn useIt hovered btn-block btn-sm btn-primary shadow-sm">
                                            use
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button @click="deleteImg(image)" type="text" class="btn btn-sm btn-danger shadow-sm">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width=".7rem" class="mx-auto" focusable="false" role="img"
                                                viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                                            </svg>
                                        </button>
                                    </div>
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
    export default {
        props: ['id','asset'],
        data: () => ({
            isDragging: false,
            files: [],
            dbfiles: [],
            images: [],
            pathToUpload: 'Media',
            errors: [],
            imgSrc: 'asdf'
        }),
        async mounted() {
            this.findFolders();
        },
        methods: {
            push(src){
                Event.$emit('theSrc', src)
            },
            findFolders() {
                axios.post('/findFolders/' + this.id)
                    .then(response => {
                        this.foundFiles(response.data);
                    });
            },
            foundFiles(data){
                this.dbfiles = data;
            },
           OnDragEnter(e){
               e.preventDefault();
               this.isDragging = true;
           },
           OnDragLeave(e){
               e.preventDefault();
               this.isDragging = false;
           },
           OnDrop(e){
               e.preventDefault();
               e.stopPropagation();
               this.isDragging = false;

               const files = e.dataTransfer.files;
               Array.from(files).forEach(file => this.addImage(file));
           },
           onInputChange(e) {
               const files = e.target.files;
               Array.from(files).forEach(file => this.addImage(file));
           },
           addImage(file){
               if (!file.type.match('image.*')){
                   console.log(`${file.name} is not an Image`);
                   return;
               }
               this.files.push(file);
               const img = new Image();
               const reader = new FileReader();

               reader.onload = (e) => this.images.push(e.target.result);
               reader.readAsDataURL(file);

           },
            upload: function () {
                const formUpload = new FormData();

                this.files.forEach(file => {
                    formUpload.append('images[]', file, file.name);
                });
                axios.post('/fileUpload/'+this.id, formUpload)
                    .then(response => {
                        this.$toastr.s(response.data.message);
                        this.images = [];
                        this.files = [];
                        this.findFolders();
                    });
            },
            deleteImg: function (img) {
                axios.post('/deleteFile/'+this.id+'/'+img)
                    .then(response => {
                        this.$toastr.s(response.data.message);
                        this.findFolders();
                    });
            }
        }
    }
</script>

<style lang="sass">
@import '~vue-toastr/src/vue-toastr.scss'
</style>
